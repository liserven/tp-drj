<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:59
 */

namespace app\common\model;


class Member extends BaseModel
{

    protected $hidden = []; //隐藏的字段

    public function adminDutyS (){
        return $this->hasMany('AdminDuty','ad_user_id','am_id');
    }

    public function getAmPrelogTimeAttr($value){
        return date('Y-m-d H:i:s',$value );
    }

    //分页查询
    public static function findByPage($where=[], $rows=10){
        $data = self::with(['adminDutyS','adminDutyS.dutys'])->alias('am')
                    ->where(self::getWhereArr($where))
                    ->paginate($rows);

        return $data;
    }


        //根据邮箱查找管理员
    public static function getMemberByEamil($email){
        return self::alias('am')
                    ->where(['am_email'=>$email])
                    ->join('__ADMIN_DUTY__ ad','ad.ad_user_id=am.am_id','left')
                    ->join('__DUTY_DATA__ dd','dd.dd_id=ad.ad_duty_id','left')
                    ->field('am.*,dd.dd_name')
                    ->find();
    }
        //根据id查询管理员
    public static function getMemberById($id){
        return self::with('adminDutyS')->where(['am_id'=>$id])->find();
    }


    public static function getMemberByPhone($phone)
    {
        return self::where([ 'am_phone'=>$phone ])->find();
    }
}