<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 10:51
 */

namespace enum;


class WxPaymentStatus
{
    //微信支付状态

    //成功
    const Success = "SUCCESS" ;

    //未支付
    const Refund = "REFUND";

    //已关闭
    const Closed = "CLOSED";

    //刷卡已撤销
    const Revoked = "REVOKED";

    //支付中
    const UserPaying = "USERPAYING";
}