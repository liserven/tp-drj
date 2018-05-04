<?php
namespace app\common\model;

/**
 * Class ShoppingTrolley
 * @package app\common\model
 * 商品购物车model
 */
class ShoppingTrolley extends BaseModel{


    public static function getCommon($where=[])
    {
        return self::alias('st');
    }


    public static function getShoppingCartList($userId, $buildingId, $typeId)
    {
        return self::where();
    }
}