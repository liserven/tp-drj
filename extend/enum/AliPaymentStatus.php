<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 10:54
 */

namespace enum;


class AliPaymentStatus
{
    //支付宝查询返回类型 该字段名称 trade_status

    //交易创建 等待付款
    const WaitBuyerPay = 'WAIT_BUYER_PAY';
    //未付款交易超时关闭，或支付完成后全额退款
    const TradeClosed = 'TRADE_CLOSED';
    //交易支付成功
    const TradeSuccess = 'TRADE_SUCCESS';
    //交易结束不可退款
    const TradeFinished = 'TRADE_FINISHED';
}