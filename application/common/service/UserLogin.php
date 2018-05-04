<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/12/7
 * Time: 10:13
 */

namespace app\common\server;


use app\common\model\PhoneCode;
use app\common\model\User;
use app\lib\exception\ParameterException;
use app\lib\exception\UserException;

class UserLogin
{
    protected $phone;
    protected $password;
    protected $code;  //验证码
    //验证登录
    public function checkLogin()
    {
        $this->phone = input('phone');
        $this->password = input('password');

        if( !$this->phone || !$this->password )
        {
            throw new ParameterException([
                'msg' => '手机或者密码不能为空',
                'code' => 200
            ]);
        }
        $userData = User::getByAuIphone( $this->phone );
        if( !$userData )
        {
            throw new UserException([
                'msg' => '该用户不存在'
            ]);
        }
        if( md5($this->password) != $userData['au_password'] )
        {
            return show( false, '密码错误');
        }
        //组合用户数据 保存session
        $result = $this->updateSession($userData);
        if( $result )
        {
            return show( true, '登录成功');
        }
        else{
            return show( fasle, '登录失败');
        }
    }
    public function resiter()
    {
        $phoneCode = PhoneCode::getPhoneByCode( $this->phone, $this->code );
        if( !$phoneCode )
        {
            return show( false, '验证码错误');
        }

        if( $this->code != $phoneCode['code'] )
        {
            return show( false, '验证码错误');
        }
        $this->deleteCode();

    }

    //将所用验证码删除
    public function deleteCode( )
    {
        $data['phone'] = $this->phone;
        $data['code'] = $this->code;
        $result = PhoneCode::destroy($data);
        return $result;

    }


    public function addSessionUser($userData)
    {
        return $this->updateSession($userData);
    }
    //
    protected function updateSession( $userData )
    {
        session('UserData', $userData);
        $data['au_ssid'] = session_id();
        $data['au_pre_time'] = time();
        $data['au_id'] = $userData->au_id;
        if( User::update( $data ) )
        {
            return true;
        }
        return false;
    }


    //获取登录用户标识
    public static function getUserValUid()
    {
        return self::getUserValKey('au_id');
    }

    //获取全部信息
    public static function getUserValKey( $key = '' )
    {
        $result['bol'] = 1;
        $userData = session('UserData');
        //获取最新信息
        $userData = User::get($userData['au_id']);
        if( empty($userData) )
        {
            $result['bol'] = 3;
            $result['msg'] = '用户不存在';
        }
        if( $key == '' )
        {
            $result['data'] = $userData;
        }
        else{
            if( isset( $userData[$key] ))
            {
                $result[$key] = $userData[$key];
            }else{
                $result['bol'] = 2;
                $result['msg'] = '没有该值';
            }
        }
        return $result;
    }
}