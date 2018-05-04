<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 15:56
 */

namespace app\common\model;


class DutyData extends BaseModel
{
    protected $autoWriteTimestamp = true; //开启时间自动写入
    protected $createTime = 'dd_ctime';      //设置写入字段
    protected $updateTime = 'dd_utime';

    protected $hidden = []; //隐藏的字段

    public function action(){
        return $this->hasMany('DutyAction','da_duty_id','dd_id');
    }

    //所有数据分页
    public static function findByPage($where=[], $rows=10){
        return self::alias('dd')
                    ->join('__ADMIN_DUTY__ ad','ad.ad_duty_id=dd.dd_id','left')
                    ->join('__MEMBER__ am','am.am_id=ad.ad_user_id','left')
                    ->field('dd.*,COUNT(DISTINCT am.am_id) AS members')
                    ->group('dd.dd_id')
                    ->where(self::getWhereArr($where))
                    ->paginate($rows);
    }


        //确定查询条件
    public static function getWhereArr($where=[]){
        $map = [];
        if( !empty($where['dd_name'])){
            $map['dd_name'] = $where['dd_name'];
        }
        return $map;

    }
    //根据条件查询单条
    public static function getDutyFind($where=[]){
        return self::where($where)->find();
    }

    public static function getDutyActionList($dutyId){
        return self::with(['action','action.actions'])->where(['dd_id'=>$dutyId])->find()->toArray();
    }
}