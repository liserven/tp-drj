<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/24
 * Time: 18:50
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 200;
    public $msg = '该用户不是合伙人';
    public $bol = false;
    public $errorCode = 90004;
}