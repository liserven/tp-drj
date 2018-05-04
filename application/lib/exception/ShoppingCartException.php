<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14
 * Time: 18:24
 */

namespace app\lib\exception;


class ShoppingCartException extends BaseException
{
    public $code = 200;
    public $bol = false;
    public $msg = '并没有找到购物车的商品';
    public $errorCode = 70005;
}