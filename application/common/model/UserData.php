<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/24
 * Time: 18:56
 */

namespace app\common\model;

/**
 * Class UserData
 * @package app\common\model
 * 用户模型
 */
class UserData extends BaseModel
{

    //关联别墅订单表
    public function villas()
    {
        return $this->hasMany('VillaOrder', 'user_id', 'ud_id');
    }
    //关联建材订单
    public function buildings()
    {
        return $this->hasMany('BuildingOrder', 'user_id', 'ud_id');
    }

    public function reds()
    {
        return $this->hasMany('GrabRed', 'phone', 'ud_phone');
    }
    //根据id获取用户详细信息
    public static function getUserInfoById($userId)
    {
        return self::alias('ud')
            ->join('__BUILDING_ORDER__ bo', 'bo.user_id=ud.ud_id', 'left')
            ->join('__VILLA_ORDER__ vo', 'vo.user_id=ud.ud_id', 'left')
            ->where([ 'ud_id'=> $userId])
            ->group('ud.ud_id')
            ->field('ud.ud_id,ud.ud_name,ud.ud_logo,ud.ud_phone, ud.ud_sex,ud.message
                    , count(distinct bo.id) b_orders,ud.ud_push, count(distinct vo.id) as v_orders,ud.town')
            ->find();
    }


    //合伙人数据
    public static function getPartnerDataById($userId)
    {
        return self::alias('ud')
            ->where([ 'ud.ud_id'=>$userId, 'ud.type'=>2, 'ud.status'=>1 ])
            ->join('__PARTNER_LAUD__ pl', 'pl.pid=ud.ud_id', 'left')
            ->group('ud.ud_id')
            ->field('ud.ud_name, ud.ud_phone, ud.ud_logo, ud.ud_sex, ud.city, ud.province, ud.county, ud.town,
                     count(distinct pl.id) as likes, ud.status,ud.ud_id')
            ->find();
    }



    //根据条件获取
    public static function getCityPartner($where=[], $rows=10)
    {
        $where['ud.type'] = 2;
        $where['ud.status'] = 1;
        return self::alias('ud')
            ->where($where)
            ->join('__PARTNER_LAUD__ pl', 'pl.uid=ud.ud_id', 'left')
            ->group('ud.ud_id')
            ->field('ud.ud_name, ud.ud_phone, ud.ud_logo, ud.ud_sex, ud.city, ud.province, ud.county, ud.town,
                     count(distinct pl.id) as likes, ud.status,ud.ud_id')
            ->paginate($rows);
    }
}