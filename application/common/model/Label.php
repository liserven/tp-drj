<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/3
 * Time: 15:35
 */

namespace app\common\model;


class Label extends BaseModel
{


    //获取最热标签
    public static function getHotLabel(){
        return self::alias('l')
                ->field('COUNT(DISTINCT id) as hots ,id,name')
                ->group('name')
                ->order('hots DESC')
                ->select();
    }


    //分页
    public static function getPage($where=[], $rows=10)
    {
        return self::alias('l')
                    ->where($where)
                    ->paginate($rows);
    }
}