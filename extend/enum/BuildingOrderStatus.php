<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/16
 * Time: 18:24
 */

namespace enum;


class BuildingOrderStatus
{
    // 待支付
    const UNPAID = 1;

    // 已支付
    const PAID = 2;

    //已发货
    const  TRANSLATE = 3;

    //已签收
    const SIGN = 4;

    //已取消
    const CANCEL = 5;

    //已支付 没库存
    const PAIDSTOCKNO = 6;
}