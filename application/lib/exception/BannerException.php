<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 12:27
 */

namespace app\lib\exception;


class BannerException extends BaseException
{
    public $code = 400;
    public $bol = false;
    public $msg = 'Banner目前不存在了...';
    public $errorCode = 90004;
}