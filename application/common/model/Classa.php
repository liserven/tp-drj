<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/16
 * Time: 16:39
 */

namespace app\common\model;


class Classa extends BaseModel
{
    public static function getPage($where=[], $rows=10)
    {
        return self::paginate($rows);
    }
}