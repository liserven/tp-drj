<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 10:22
 */

namespace app\index\controller;

use app\common\model\Bargain as BargainModel;
use app\common\model\BargainMinute;
use think\Cache;

class Bargain extends BaseController
{



    //帮忙砍价页面
    public function helpBargainView($id)
    {
        $user = Cache::get('wxUser');
        $data = BargainModel::get($id);
        $data['helps'] = BargainMinute::all(['b_id'=> $data['id']]);
        $isHelp = BargainMinute::get(['open_id'=> $user['openid'], 'b_id'=> $data['id']]);
        $data['is_help'] = !empty($isHelp) ? 1 : 2;
        $data['is_end'] = $data['b_number'] <= count($data['helps']) ? 2 : 1;
        $this->assign('data', $data);
        if(empty($user))
        {
            $code = input('get.code');
            if( !empty($code))
            {
                $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.config('sWx.appId').'&secret='.config('sWx.appScret').'&code='.$code.'&grant_type=authorization_code';
                $tokenResult = curl_post($url);
                $jsonToArr = json_decode($tokenResult, true);
                //换取用户信息
                $getUserInfoUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$jsonToArr["access_token"].'&openid='.$jsonToArr['openid'];
                $userResult = curl_post($getUserInfoUrl);
                $userInfo = json_decode($userResult, true);
                Cache::set('wxUser', $userInfo);
                $this->assign('userInfo' , $userInfo);
                $data = BargainModel::get($id);
                $this->assign('data', $data);
                return $this->fetch();
            }
            else{
                header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.config('sWx.appId').'&redirect_uri=http://www.61drhome.cn/h_bargain_view/'.$id.'&response_type=code&scope=snsapi_userinfo&state=1');
            }
        }
        else{
            $this->assign('userInfo' , $user);
            return $this->fetch();
        }
    }
}