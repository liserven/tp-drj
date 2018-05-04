<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/13
 * Time: 9:25
 */

namespace app\common\model;

class UserNotices extends BaseModel{


    public function getImgAttr($value)
    {
        if( is_null($value))
        {
            $value = false;
        }
        return $value;
    }

    public static function getPage($where=[], $rows=20)
    {
        return self::where($where)->field('id, user_id, topic, content, status, create_at, img, type')->order('id desc')->paginate($rows);
    }
}