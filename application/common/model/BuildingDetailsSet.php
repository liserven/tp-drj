<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/3/7
 * Time: 10:24
 */

namespace app\common\model;


class BuildingDetailsSet extends BaseModel{
    private static function getCommon($where=[])
    {
        return self::alias("bd")
            ->where($where)

            ->order("id DESC");
    }

    public static function getBuildingPage($where = [], $rows = 15)
    {
        return self::getCommon($where)->paginate($rows);
    }
}