<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 16:37
 */

namespace Redis;


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