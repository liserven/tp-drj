<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/23
 * Time: 16:11
 */

namespace app\lib\exception;


class OpenException extends BaseException
{
    public $code = 403;
    public $msg = '不可缺失的open_id';
    public $bol = false;
    public $errorCode = 90004;
}