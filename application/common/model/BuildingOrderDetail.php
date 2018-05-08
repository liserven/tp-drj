<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 13:59
 */

namespace app\common\model;


class BuildingOrderDetail extends BaseModel
{
   public static function getBuildPage($where=[],$rows=10){
       return self::with([])
           ->where($where)

           ->find()
           ->order('id desc')
           ->paginate($rows);
   }

    public static function getBuildOrdersByOrderId($where=[]){
        return self::alias('bod')
            ->where($where)
            ->order('bod.id desc')
            ->join('__BUILDING_SCREEN__ bs', 'bs.id=bod.g_type', 'left' )
            ->field('bod.g_name, bod.id, bod.g_money_solo, bod.g_money_all, bod.g_number, bod.order_no,
             bod.order_status, bod.status,bod.logistics, bod.express_code,bod.g_img, bs.size as typename')
            ->select();
    }

    public static function getBuildingOrdersByUid($uid)
    {
        return self::where()
            ->order('id desc')
            ->field('g_name, id, g_money_solo, g_money_all, g_number, order_no, order_status')
            ->select();
    }



}