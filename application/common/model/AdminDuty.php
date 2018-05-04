<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:58
 */

namespace app\common\model;


class AdminDuty extends BaseModel
{
    protected $autoWriteTimestamp = true; //开启时间自动写入
    protected $createTime = 'ad_ctime';      //设置写入字段
    protected $updateTime = 'ad_utime';

    protected $hidden = []; //隐藏的字段\


    public function dutys(){
        return $this->belongsTo('DutyData','ad_duty_id','dd_id');
    }

    public function members(){
        return $this->belongsTo('Member','ad_user_id','am_id');
    }
    //根据用户id搜索所有行为
    public static function getDutyList($userid){
        $data = self::with(['dutys'])->where(['ad_user_id'=>$userid])->find();
        return $data;
    }

    //根据角色id查询所有的用户
    public static function getMemberListByDutyId($dutyId){
        return self::with('members')->where([ 'ad_duty_id'=>$dutyId ])->select();
    }

    //根据管理员id查询所有的所属所有角色
    public static function getDutyListByMemberId($MemberId){
        return self::where([ 'ad_user_id'=>$MemberId ])->select();
    }
}