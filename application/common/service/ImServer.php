<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/5/23
 * Time: 10:05
 */

namespace app\common\service;

use JMessage\IM\User;
use JMessage\JMessage;

include_once ROOT_PATH.'extend/jmessage/autoload.php' ;
class ImServer
{

    private $client;
    public function __construct()
    {
        $appKey = 'a7268c5210a5f6d69a06beda';
        $masterSecret = 'ed4d2305c12a4b9165fdd281';

        $this->client = new JMessage($appKey, $masterSecret);
    }


    /**
     * @return \think\response\Json
     * 用户注册
     */
    public function register($userName, $password)
    {
        $user = new User($this->client);
        return json($user->register($userName, $password));
    }

    /**
     * 用户登陆
     */
    public function login($userName , $password)
    {
        $user = new User($this->client);
        return json($user->($userName, $password));
    }
}