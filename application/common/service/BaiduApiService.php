<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/26
 * Time: 18:09
 */

namespace app\common\service;


class BaiduApiService
{
    private $ip;

    public function getAddress(){
        $url = 'http://api.map.baidu.com/location/ip?ip='.$this->ip.'&ak='.config('baidu.ak').'&coor = bd09ll';
        return curl_get($url);
    }


    public function setIp($ip)
    {
        $this->ip = $ip;
    }
}