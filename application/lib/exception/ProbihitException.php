<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/16
 * Time: 15:25
 */

namespace app\lib\exception;


class ProbihitException extends BaseException
{
    public $code = 400;
    public $errorCode = 10000;
    public $bol = false;
    public $msg = "存在敏感字符...";
}