<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 15:00
 */

namespace app\common\model;


class DutyAction extends BaseModel
{
    protected $autoWriteTimestamp = true; //开启时间自动写入
    protected $createTime = 'da_ctime';      //设置写入字段
    protected $updateTime = 'da_utime';

    protected $hidden = []; //隐藏的字段

    public function actions(){
        return $this->belongsTo('ActionData','da_action_id','ad_id');
    }
    //根据角色id查询所有行为
    public static function getDutyActionList($dutyId){
        return self::where(['da_duty_id'=>$dutyId])->select();
    }
}