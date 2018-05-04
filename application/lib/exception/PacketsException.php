<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 9:35
 */

namespace app\lib\exception;


class PacketsException extends BaseException
{
    public $code = 200;
    public $msg = '暂时没有红包';
    public $bol = false;
    public $errorCode = 90004;
}