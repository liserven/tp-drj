<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 11:34
 */

namespace custom;


use app\common\model\Member;
use app\common\model\MemberLog;
use think\Request;

class CusLog
{
    //当前请求url
    protected $url;

    //记录名称
    protected $topic;

    //管理员id
    protected $uid;

    //请求IP
    protected $ip;


    public static function writeLog ($uid, $topic){
        $require = Request::instance();
        $data['ml_member_id']   = $uid;
        $data['ml_name']        = $topic;
        $data['ml_url']         = $require->path();
        $data['ml_ip']          = $require->ip();

        $result = MemberLog::create($data);

        return $result?true:false;


    }
}