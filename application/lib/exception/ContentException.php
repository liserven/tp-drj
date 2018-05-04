<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/16
 * Time: 15:23
 */

namespace app\lib\exception;


class ContentException extends BaseException
{
    public $code = 404;
    public $msg = '内容不能为空';
    public $bol = false;
    public $errorCode = 90004;
}