<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 15:40
 */

namespace Redis;


class Nredis
{
    protected static $host = '127.0.0.1';

    protected static $port = 6379;


    public static function init( $conf=[] ){
        $redis = new \Redis();
        $redis->connect(self::$host, self::$port);
        return $redis;
    }
}