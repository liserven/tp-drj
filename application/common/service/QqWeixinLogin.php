<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/23
 * Time: 14:59
 */

namespace app\common\service;


use app\common\model\PhoneCode;
use app\common\model\User;
use app\common\model\UserData;
use app\common\validate\PhoneValidate;
use app\common\validate\UserValidate;
use app\lib\exception\OpenException;
use app\lib\exception\ParameterException;
use app\lib\exception\UserException;

class QqWeixinLogin
{
    public $open_id = '';
    public $nickname = '';
    public $logo = '';
    public $sex = '';
    public $phone;
    public $password;


    function __construct( )
    {
        $this->open_id = input('openid');
        $this->nickname = input('nickname');
        $this->logo = input('logo');
        $this->sex = input('sex');
        $this->phone = input('phone');
        $this->password = input('password');
    }

    private function checkConfig()
    {
        if(empty($this->open_id))
        {
            throw new OpenException();
        }
        if( strlen($this->password) < 6 || strlen($this->password) > 20)
        {
            throw new OpenException([
                'msg' => '密码6-20之间'
            ]);
        }
    }


    public function getQQ()
    {
        (new PhoneValidate())->goCheck();
        $this->checkConfig();
        $this->checkPhone();
        $user_data = UserData::get(['qq_openid'=> $this->open_id]);
        if( !$user_data )
        {
            $code = input('code');
            if( empty($code) )
            {
                throw new ParameterException([
                    'msg' => '验证码不能为空'
                ]);
            }
            $phone_code = PhoneCode::get([ 'phone'=> $this->phone, 'code'=> $code]);
            if( empty($phone_code) )
            {
                throw new ParameterException([
                    'msg' => '验证码有误'
                ]);
            }
            $data['qq_openid'] = $this->open_id;
            $data['ud_nickname'] = $this->nickname;
            $data['ud_logo'] = $this->logo;
            $data['ud_sex'] = $this->sex;
            $data['ud_phone'] = $this->phone;
            $data['ud_password'] = md5($this->password);
            (new UserValidate())->goCheck($data);
            $cacheUserData = db('user_data')->insert($data);
        }
        else{
            $cacheUserData = $user_data;
        }
        $userTokenServer = new UserToken();
        $resultData = $userTokenServer->pubPrepareCachedValue($cacheUserData);
        return $resultData;
    }

    public function getWeixin()
    {
        (new PhoneValidate())->goCheck();
        $this->checkConfig();
        $this->checkPhone();
        $user_data = UserData::get(['wx_openid'=> $this->open_id]);
        if( !$user_data )
        {
            $code = input('code');
            if( empty($code) )
            {
                throw new ParameterException([
                    'msg' => '验证码不能为空'
                ]);
            }
            $phone_code = PhoneCode::get([ 'phone'=> $this->phone, 'code'=> $code]);
            if( empty($phone_code) )
            {
                throw new ParameterException([
                    'msg' => '验证码有误'
                ]);
            }
            $data['wx_openid'] = $this->open_id;
            $data['ud_name'] = $this->nickname;
            $data['ud_logo'] = $this->logo;
            $data['ud_sex'] = $this->sex;
            $data['ud_phone'] = $this->phone;
            $data['ud_password'] = md5($this->password);
            (new UserValidate())->goCheck($data);
            $cacheUserData = db('user_data')->insert($data);
        }
        else{
            $cacheUserData = $user_data;
        }
        $userTokenServer = new UserToken();
        $resultData = $userTokenServer->pubPrepareCachedValue($cacheUserData);
        return $resultData;
    }


    public function checkPhone()
    {
        $user = db('user_data')->where(['ud_phone'=> $this->phone])->find();
        if( $user )
        {
            throw new UserException([
                'msg'=> '该手机已经绑定'
            ]);
        }
    }
}