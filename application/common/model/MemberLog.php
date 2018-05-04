<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 11:42
 */

namespace app\common\model;


class MemberLog extends BaseModel
{
    protected $updateTime = false;
    protected $hidden = []; //隐藏的字段


    public function users(){
        return $this->belongsTo('Member','ml_member_id','am_id');
    }

    //条件查询分页
    public static function getLogPageList($where=[],$rows=10){
        return self::with('users')
                    ->where($where)
                    ->order('ml_id DESC')
                    ->paginate($rows);
    }
}