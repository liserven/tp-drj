<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/4
 * Time: 14:27
 */

namespace app\lib\exception;


class NoticeException extends BaseException
{
    public $code = 200;
    public $msg = '没有消息';
    public $bol = false;
    public $errorCode = 90004;
}