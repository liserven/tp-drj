<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/3/1
 * Time: 10:09
 */

namespace app\common\model;


class Propeling  extends BaseModel
{
    public static function getPropelPage($where = [], $rows = 15)
    {
        return self::getCommon($where)->paginate($rows);
    }


    private static function getCommon($where=[])
    {
        return self::alias("bd")
            ->where($where)

            ->order("id DESC");
    }


}