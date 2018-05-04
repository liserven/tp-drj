<?php
namespace app\common\model;
class BuildingColumn extends BaseModel{


    private static function getCommon($where=[])
    {
        return self::alias("bd")
            ->where($where)

            ->order("id DESC");
    }
    public static function getClumPage($where = [], $rows = 15)
    {
        return self::getCommon($where)->paginate($rows);
    }

}