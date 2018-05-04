<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/9
 * Time: 9:58
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 200;
    public $bol = false;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 40000;
}