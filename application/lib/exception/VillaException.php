<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/15
 * Time: 14:48
 */

namespace app\lib\exception;


class VillaException extends BaseException
{
    public $code = 200;
    public $bol = false;
    public $msg = '别墅不存在';
    public $errorCode = 70004;
}