<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/9
 * Time: 11:52
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 200;
    public $bol = false;
    public $msg = '账号或密码错误';
    public $errorCode = 40004;
}