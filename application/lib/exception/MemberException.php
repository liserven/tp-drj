<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/16
 * Time: 10:23
 */

namespace app\lib\exception;


class MemberException extends BaseException
{
    public $code = 404;
    public $errorCode = 90004;
    public $bol = false;
    public $msg = "管理员不存在";
}