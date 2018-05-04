<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 9:58
 */

namespace app\api\controller\v1;

use app\common\model\BargainMinute;
use app\common\model\BargainSte;
use app\common\model\PhoneCode;
use app\common\service\BargainServer;
use app\lib\exception\ParameterException;
use app\common\model\Bargain as BargainModel;
/**
 * Class Bargain
 * @package app\api\controller\v1
 * 砍价控制器
 */


class Bargain extends Base
{


    protected $beforeActionList = [
        //用户
        'checkLogin'=> [ 'only'=> 'launchBargain,myBargain' ]
    ];


    //发起砍价
    public function launchBargain()
    {
        return $this->resultHandle((new BargainServer())->set($this->user['ud_id']));
    }

    //帮忙砍价
    public function helpBargain()
    {
        $code = input('post.code');
        $phone = input('post.phone');
        $nickname = input('post.nickname');
        $logo = input('post.logo');
        $openid = input('post.openid');
        $bargainId = input('post.bargainid');
        $phoneCode = PhoneCode::get([ 'phone'=> $phone, 'code'=> $code]);
        if( empty($phoneCode) )
        {
            throw new ParameterException([
                'msg' => '验证码错误'
            ]);
        }
        return $this->resultHandle((new BargainServer())->helps([
            'phone' => $phone,
            'bargainId' => $bargainId,
            'nickname' => $nickname,
            'logo'  => $logo,
            'openId' => $openid,
        ]));
    }
    //查询砍价配置
    public function getBargainConfig()
    {
        $config = BargainSte::find()->hidden([ 'id', 'red_set', 'create_at', 'update_at', 'status']);
        return show(true, 'ok', $config);
    }

    //查询砍价
    public function myBargain()
    {
        $data = BargainModel::get([ 'user_id'=> $this->user['ud_id']]);
        if( empty($data) )
        {
            return show(true, '你还没有发起过砍价', []);
        }
        $data['helps'] = BargainMinute::all(['b_id'=> $data['id']]);
        $data['is_end'] = $data['b_number'] <= count($data['helps']) ? 2 : 1;
        return show( true, 'ok', $data );
    }
}