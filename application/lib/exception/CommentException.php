<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/25
 * Time: 17:18
 */

namespace app\lib\exception;


class CommentException extends BaseException
{
    public $code = 403;
    public $msg = '评论已经丢失...';
    public $bol = false;
    public $errorCode = 90004;
}