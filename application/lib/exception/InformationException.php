<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/16
 * Time: 15:04
 */

namespace app\lib\exception;


class InformationException extends BaseException
{
    public $code = 200;
    public $errorCode = 90004;
    public $bol = false;
    public $msg = "对应文章已经下架了...";
}