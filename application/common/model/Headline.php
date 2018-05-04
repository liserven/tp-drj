<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/30
 * Time: 10:37
 */

namespace app\common\model;


class Headline extends BaseModel
{


    public static function getPage( $where=[], $rows=10)
    {
        return self::where($where)->paginate($rows);
    }


    //获取前台数据
    public static function getIndexHeadLines()
    {
        return self::field('title, create_at')->limit(6)->select();
    }
}