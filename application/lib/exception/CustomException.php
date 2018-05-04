<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27
 * Time: 18:36
 */

namespace app\lib\exception;


class CustomException extends BaseException
{
    /**
     * @var int
     * 客户异常状态码
     * 6开头为客户异常
     * 60004                客户不存在
     *
     */

    public $code = 403;
    public $msg = '客户列表为空...';
    public $bol = false;
    public $errorCode = 90004;
}