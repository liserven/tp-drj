<?php
namespace app\common\model;

/**
 * Class County
 * @package app\common\model
 * 县级模型
 */
class County extends BaseModel{


    //根据县级获取合伙人
    public static function getPartnerByCounty($county, $rows=8)
    {
        /*
         * 查询条件必须是状态为1的， 类型必须是合伙人的。
         */
        return self::alias('c')
                    ->join('__USER_DATA__ ud', 'ud.county = c.county_name', 'left')
                    ->where([ 'c.county_name'=> $county, 'ud.status'=> 1, 'ud.type'=> 2])
                    ->field('c.county_name, ud.ud_logo, ud.ud_name, ud.ud_phone, ud.ud_sex')
                    ->group('c.id')
                    ->paginate($rows);
    }
}