<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/9
 * Time: 9:48
 */

namespace app\common\service;


use app\common\model\UserData;
use app\lib\exception\ParameterException;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use enum\ScopeEnum;

class UserToken extends Token
{
    protected $account;
    protected $password;
    //入口方法,对外唯一提供的方法
    public function get()
    {
        //实例化该类 初始化账号密码
        $account = input('post.account');
        $password = input('post.password');
        if( empty( $account ) || empty( $password ))
        {
            throw new ParameterException([
                'msg' => '账号或密码不能为空',
                'errorCode' => 403
            ]);
        }
        $this->password = $password;
        $this->account = $account;
        $checkUser = $this->checkUser();

        return $checkUser;
    }
    //验证用户token 是否存在
    private function checkUser()
    {
        $user = UserData::get([
            'ud_phone' => $this->account,
        ]);
        if( empty( $user ) )
        {
            throw new UserException([
                'msg' => '账号不存在'
            ]);
        }
        if( md5($this->password) != $user['ud_password'])
        {
            throw new UserException([
                'msg' => '密码错误'
            ]);
        }

        $cachedValue = $this->prepareCachedValue($user->toArray());

        $token = $this->saveToCache($cachedValue);
        $data = [
            'is_partner' => $cachedValue['type']==2? true: false,
            'token' => $token
        ];
        return $data;

    }


    //将用户权限写入到数组当中
    private function prepareCachedValue($user)
    {
        $cachedValue = $user;
        //判断用户是普通用户还是合伙人
        $scope = $user['type'] == 1? ScopeEnum::User : ScopeEnum::Super;
        $cachedValue['scope'] = $scope;
        return $cachedValue;
    }

    //对外提供接口，可将用户信息写入缓存
    public function pubPrepareCachedValue($user)
    {

        $cacheValue = $this->prepareCachedValue($user);
        $token = $this->saveToCache($cacheValue);
        return $token;
    }

    // 写入缓存
    private function saveToCache($cachedValue)
    {

        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = config('setting.token_expire_in');
        $result = cache($key, $value, $expire_in);
        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }
}