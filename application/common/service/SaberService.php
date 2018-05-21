<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/5/17
 * Time: 17:37
 */

namespace app\common\service;



class SaberService
{


    public function sendWebSocket()
    {
        $client = new \swoole_client(SWOOLE_SOCK_TCP);
        if (!$client->connect('127.0.0.1', 8888, -1))
        {
            exit("connect failed. Error: {$client->errCode}\n");
        }
        $client->send("hello world\n");
        echo $client->recv();
        $client->close();
    }
}