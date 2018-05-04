<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 10:35
 */

namespace app\common\service;


class WxAuthServer
{


    public function wxAuth($url)
    {
        //获取直播信息
        $user = session('user');
//        Session::destroy();die;
        $server = new WhServer();
        if(empty($user))
        {
            if(isset($_GET['code']))
            {
                $code = $_GET['code'];
                $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.config('sWx.appid').'&secret='.config('sWx.appsrcret').'&code='.$code.'&grant_type=authorization_code';
                $tokenResult = curl_post($url);
                $jsonToArr = json_decode($tokenResult, true);
                //换取用户信息
                $getUserInfoUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$jsonToArr["access_token"].'&openid='.$jsonToArr['openid'];
                $userResult = curl_post($getUserInfoUrl);
                $userInfo = json_decode($userResult, true);
                $openId = $userInfo['openid'];
                $name = $userInfo['nickname'];
                $head = $userInfo['headimgurl'];
            }
            else{
                header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd5b1c33a802635c3&redirect_uri=http://wh.lsybk.com/wx/'.$id.'&response_type=code&scope=snsapi_userinfo&state=1');
            }
        }
        else{
            $server->setLoginSign( $id, $user);
        }
        $this->user = session('user');
        $this->assign('webinarData' , $server->getWhFetch($id));
        $this->assign('user', $this->user);
    }
}