<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/23
 * Time: 17:29
 */

namespace app\common\service;


class Redis
{
    protected static $host = '127.0.0.1';

    protected static $port = 6379;


    public static function init( $conf=[] ){
        $redis = new \Redis();
        $redis->connect(self::$host, self::$port);
        return $redis;
    }
}