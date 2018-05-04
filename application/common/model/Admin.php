<?php
/**
 * Created by PhpStorm.
 * User: lishenyang
 * Date: 2017/12/14
 * Time: 22:01
 */

namespace app\common\model;


class Admin extends BaseModel
{


    public static function getUserByPhone($phone)
    {
        return self::where([ 'phone'=>$phone])->find();
    }
}