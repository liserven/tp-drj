<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 16:52
 */

namespace app\api\controller\v1;


use app\common\service\AlipayServer;
use app\lib\exception\ParameterException;

class AliPay extends Base
{



    //根据支付宝订单号查询订单详情
    public function getAliPayInfoByTradeNo($trade_no)
    {
        if(!$trade_no)
        {
            throw new ParameterException([
                'msg' => '支付宝订单号不能为空',
            ]);
        }
        $service = new AlipayServer();
        dd($service->tradeQuery($trade_no));
    }



    //支付宝退款
    public function AliPayRefundByTradeNo($trade_no, $refund_type)
    {
        if(!$trade_no)
        {
            throw new ParameterException([
                'msg' => '支付宝订单号不能为空',
            ]);
        }
        $service = new AlipayServer();
        return $service->refund($trade_no);
    }


}