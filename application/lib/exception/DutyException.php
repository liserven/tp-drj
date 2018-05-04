<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/11
 * Time: 18:25
 */

namespace app\lib\exception;


class DutyException extends BaseException
{
    public $code = 403;
    public $bol = false;
    public $msg = '你无权此操作';
    public $errorCode = 90004;
}