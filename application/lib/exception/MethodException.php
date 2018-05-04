<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/20
 * Time: 9:31
 */

namespace app\lib\exception;


class MethodException extends BaseException
{
    public $code = 403;
    public $errorCode = 90004;
    public $bol = false;
    public $msg = "请切换请求方式...";
}