<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 10:32
 */

namespace app\lib\exception;


class PartnerException extends BaseException
{
    public $code = 200;
    public $bol = false;
    public $msg = '该区域没有合伙人！';
    public $errorCode = 90004;
}