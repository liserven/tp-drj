<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 10:00
 */

namespace app\common\service;


use app\common\model\Bargain;
use app\common\model\BargainMinute;
use app\common\model\BargainSte;
use app\common\model\PhoneCode;
use app\lib\exception\ParameterException;

class BargainServer
{

    public $user;
    public $count;
    public $total;


    /**
     * 发起砍价：
     * 每个用户只能发起一次砍价，
     * 已经砍完的也不能发起砍价，
     * 砍价的金额和个数由我们后台固定
     */
    function __construct()
    {
        $config = BargainSte::find();
        $this->count = $config['bargain_num'];
        $this->total = $config['bargain_set'];
    }

    public function set($userId)
    {
        $this->user = $userId;
        $content = input('content');
        //查询我的砍价
        $bargainResult = Bargain::get([ 'user_id'=> $this->user]);
        if( !empty($bargainResult) )
        {
            throw new ParameterException([
                'msg' => '砍价只能发起一次'
            ]);
        }

        $bargainData = [
            'user_id' => $this->user,
            'b_money' => $this->total,
            'b_number' => $this->count,
            'b_content' => !empty($content) ? $content : '帮忙砍价',
        ];

        $result = Bargain::create($bargainData);
        return $result;

    }


    public function helps($bargainArr)
    {
        $bargainResult = BargainMinute::get([ 'phone'=> $bargainArr['phone'], 'b_id'=> $bargainArr['bargainId']]);
        if(!empty($bargainResult))
        {
            throw new ParameterException([
                'msg' => '您已经为他砍过价'
            ]);
        }
        $bargainData = Bargain::get($bargainArr['bargainId']);
        $bargainCount = BargainMinute::where([ 'b_id'=> $bargainArr['bargainId']])->count();
        if( $bargainData['b_number'] <= $bargainCount )
        {
            throw new ParameterException([
                'msg' => '砍价已经结束'
            ]);
        }
        $bargainMiuteData = [
            'phone' => $bargainArr['phone'],
            'b_id' => $bargainArr['bargainId'],
            'nickname' => $bargainArr['nickname'],
            'b_img' => $bargainArr['logo'],
            'open_id' => $bargainArr['openId'],
        ];
        PhoneCode::destroy([ 'phone'=> $bargainArr['phone']]);
        return BargainMinute::create($bargainMiuteData);
    }



}