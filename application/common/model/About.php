<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/10
 * Time: 14:23
 */

namespace app\common\model;


class About extends BaseModel
{
    public static function getFindData()
    {
        return self::find();
    }
}