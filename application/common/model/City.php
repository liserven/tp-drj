<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 11:43
 */

namespace app\common\model;

/**
 * Class City
 * @package app\common\model
 * 城市的模型
 */
class City extends BaseModel
{

    //根据市级获取合伙人
    public static function getPartnerByCounty($city, $rows)
    {
        /*
         * 查询条件必须是状态为1的， 类型必须是合伙人的。
         */
        return self::alias('c')
            ->join('__USER_DATA__ ud', 'ud.county = c.city_name', 'left')
            ->where([ 'c.county_name'=> $city, 'ud.status'=> 1, 'ud.type'=> 2])
            ->field('c.city_name, ud.ud_logo, ud.ud_name, ud.ud_phone, ud.ud_sex')
            ->group('c.id')
            ->paginate($rows);
    }


    //获取该地区合伙人总数
    public static function getPartnerLimitNum($city)
    {
        return self::alias('c')
                    ->join('__USER_DATA__ ud', 'ud.city=c.city_name', 'left')
                    ->where([ 'c.city_name'=> $city, 'ud.type'=> 2])
                    ->field('COUNT(DISTINCT ud.ud_id) AS partners, c.partner_limit')
                    ->group('c.id')
                    ->find();
    }


    //随机推荐合伙人
    //根据市级获取合伙人
    public static function getPartnerByRand($limit=0, $rows=8)
    {
        /*
         * 查询条件必须是状态为1的， 类型必须是合伙人的。
         */
        return self::alias('c')
            ->join('__USER_DATA__ ud', 'ud.county = c.city_name', 'right')
            ->join('__PARTNER_USER__ pu', 'pu.pu_partner_id=ud.ud_id', 'left')
            ->where([ 'ud.status'=> 1, 'ud.type'=> 2])
            ->field('c.city_name, ud.ud_logo, ud.ud_name, ud.ud_phone, ud.ud_sex, ud.city, ud.county, count(pu.pu_partner_id) as interactions')
            ->group('ud.ud_id')
            ->limit($limit, $rows)->select();
    }



}