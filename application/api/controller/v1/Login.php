<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 12:20
 */

namespace app\api\controller\v1;


use app\common\lib\CustomSms;
use app\common\model\PhoneCode;
use app\common\model\Seas;
use app\common\model\User;
use app\common\model\UserData;
use app\common\service\QqWeixinLogin;
use app\common\service\Token;
use app\common\service\UserToken;
use app\common\validate\PhoneValidate;
use app\lib\exception\ParameterException;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Db;

class Login extends Base
{

    public function _initialize()
    {
    }

    /**
     * @param 用户登录信息
     * @url api/Login
     * @return  返回登录信息 登录成功跳转首页 登录失败继续登录
     */
    public function login()
    {
        $userToken = new UserToken();
        $result = $userToken->get();
        if(!$result)
        {
            throw new TokenException();
        }
        return show(true, '登录成功', $result);
    }


    /**
     * @param 用户注册信息
     * @url api/register
     * @return 注册成功 跳转登录页面，失败 提示错误消息
     */
    public function register(){
        $province = input('province');
        $city = input('city');
        $county = input('county');
        $town = input('town');
        if( !$province || !$city || !$county || !$town )
        {
            throw new ParameterException([
                'msg'=> '地区参数错误'
            ]);
        }

        $data['ud_phone']    = input('post.phone');
        $data['ud_name']    = '用户'.rand(1000,9999);
        $data['ud_logo']    = 'http://ozi65v7vu.bkt.clouddn.com/%E7%94%B7.png';
        $code = input('post.code');
        if( !$code )
        {
            return show( false,'验证码不能为空');
        }
        if( !$data['ud_phone'] )
        {
            return show(false,'手机号不能为空');
        }
        if( UserData::get(['ud_phone'=>$data['ud_phone'] ]) )
        {
            throw new UserException( [
                'msg' => '手机已经存在...',
            ]);
        }
        $phone_code = PhoneCode::where([ 'phone'=>$data['ud_phone']])->order('id desc')->find();
        if( !$phone_code )
        {
            return show(false, '请发送验证码,再提交...');
        }

        if( $code != $phone_code['code'] )
        {
            return show(false,'验证码有误');
        }
        if( time() > $phone_code['over_time'] )
        {
            return show(false,'该验证码已经失效');
        }
        $password = input('post.password');
        $data['ud_password']    = md5($password);
        $type = input('type');
        if( !empty($type))
        {
            $data['ud_name'] = input('nickname');
            $data['ud_sex'] = input('sex');
            $data['ud_logo'] = input('logo');
            $data['province'] = $province;
            $data['city'] = $city;
            $data['county'] = $county;
            $data['town'] = $town;

            $openid = input('openid');
            if( $type == 'wx' )
            {
                $data['wx_openid'] = $openid;
            }

            if( $type == 'qq' )
            {
                $data['qq_openid'] = $openid;
            }
        }
        Db::startTrans();
        try{
            $result = UserData::create($data);
            $seasData = [
                'uid'=> $result['ud_id'],
                'phone'=> $result['ud_phone']
            ];
            Seas::create($seasData);
            $userData = UserData::get($result->ud_id);
            PhoneCode::destroy([ 'phone'=>$result->ud_phone ]);
            $userTokenServer = new UserToken();
            $resultData = $userTokenServer->pubPrepareCachedValue($userData);
            $data = [
                'is_partner' =>false,
                'token' => $resultData,
                'is_push' => true,
            ];
            Db::commit();
            return show(true, 'ok', $data );
        }catch (\Exception $e)
        {
            Db::rollback();
            return show(false,$e->getMessage());
        }
    }
    /**
     * 给用户手机发送验证码 并且存入数据库
     * @param $iphone 用户手机号
     * @return \think\response\Json
     */
    public function smsCode($phone)
    {
        (new PhoneValidate())->goCheck();
        if( UserData::get(['ud_phone'=> $phone]) )
        {
            return show( false, '该手机号已经注册', ['phone'=>$phone]);
        }
        $sms = new CustomSms();
        return $sms->Sms($phone);
    }
    //修改密码时候所用的手机验证码接口
    public function editPasswordPhoneCode($phone)
    {
        (new PhoneValidate())->goCheck();
        $userData =  UserData::get(['ud_phone'=> $phone]) ;
        if( !$userData )
        {
            return show( false, '该手机号未注册');
        }
        $sms = new CustomSms();
        return $sms->Sms($phone);
    }


    //申请合伙人使用
    public function helpBargainPhoneCode($phone)
    {
        $sms = new CustomSms();
        return $sms->Sms($phone);
    }

    public function echohome()
    {
        return show( true, '该手机号已经注册', ['phone'=>input('phone')]);
    }



    //qq登录
    public function QQLogin()
    {
        return $this->resultHandle( (new QqWeixinLogin())->getQQ());
    }
    //微信登录
    public function WxLogin()
    {
        return $this->resultHandle( (new QqWeixinLogin())->getWeixin());
    }



    //微信登录返回请求接口验证是否需要绑定手机号
    public function checkOpenId()
    {
        $type = input('type');
        $openId = input('openid');
        if( empty($openId) || empty($type))
        {
            throw new ParameterException([
                'msg' => '参数错误'
            ]);
        }
        if( $type == 'wx')
        {
            $user_data = UserData::get([ 'wx_openid' => $openId]);
        }
        if($type == 'qq'){
            $user_data = UserData::get([ 'qq_openid' => $openId]);
        }
        if( empty($user_data['ud_phone']) )
        {
            //如果手机不存在 说明该QQ或者微信是第一次授权登录
            $data = [
                'is_login' => true,
            ];
        }
        else{
            $token = (new UserToken())->pubPrepareCachedValue($user_data);
            $data = [
                'is_login' => false,
                'token' => $token,
                'is_partner'=> $user_data['type'] == 2 ? true : false,
                'is_push' => $user_data['ud_push'] == 1 ? true : false,
                'phone'=> $user_data['ud_phone'],
                'password' => $user_data['ud_password'],
            ];
        }
        return show( true, 'ok', $data);
    }

    public function editpass()
    {
        /*
         * 重置密码
         * 发送验证码
         * 比对验证码
         * 修改密码
         */
        $phone = input('phone');
        $password = input('password');
        $code = input('code');
        if( !$phone )
        {
            return show( false,'手机号不能为空');
        }
        if( !$code || strlen($code) < 6 )
        {
            return show( false,'验证码不正确');
        }
        if( !$password )
        {
            return show( false,'密码不能为空');
        }

        $phone_code = PhoneCode::where([ 'phone'=>$phone ])->order('id DESC')->find();
        if( !$phone_code )
        {
            return show(false,'该用户没有发送验证码');
        }
        if( $code != $phone_code->code )
        {
            return show(false, '验证码有误');
        }
        if( time() > $phone_code->over_time )
        {
            return show(false,'该验证码已经失效');
        }
        $user_model = new UserData();
        $user = $user_model->get([ 'ud_phone'=>$phone ]);
        if( !$user )
        {
            return show( false, '用户不存在');
        }
        Db::startTrans();
        try{
            $user->ud_password = md5($password);
            $user->save();
            PhoneCode::destroy([ 'phone'=>$user->ud_phone ]);
            Db::commit();

            return show(true,'修改成功', [
                'new_pass'=> $password
            ]);

        }catch (\Exception $e)
        {
            Db::rollback();
            return show(false,$e->getMessage());
        }
    }
}