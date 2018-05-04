<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 11:42
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 200;
    public $msg = '订单不存在';
    public $bol = false;
    public $errorCode = 90004;
}