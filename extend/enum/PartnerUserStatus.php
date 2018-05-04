<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 9:55
 */

namespace enum;


class PartnerUserStatus
{
    //跟进
    const FOLLOW = 1;


    //签约
    const BINDING = 2;

    //跟进
    const SIGN = 3 ;

    //施工
    const CONSTRUCTION = 4;

    //完工
    const END = 5;




    //来源
    const WATES = '公海';
    //广告
    const ADEV = '广告';




    //合伙人审核状态

    //已支付 待审核
    const PAID = 3;

    //待审核
    const WAIT = 4;

    //成功
    const END_SUCCESS = 1;

    //失败
    const END_FAIL = 2;

    //已提交未付款
    const NO_PAID = 5;


}