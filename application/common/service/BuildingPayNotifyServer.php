<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 17:25
 */

namespace app\common\service;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class BuildingPayNotifyServer extends \WxPayNotify
{




    public function NotifyProcess($data, &$msg)
    {
        if ($data['result_code'] == 'SUCCESS' ) {
            //如果支付结果为success 说明支付成功了
            $orderNo = $data['out_trade_no']; //设置的订单号
            try{
                    /**
                     * 购买建材成功后的回调。
                     * 查询库存是否充足。修改订单状态，减少库存量。
                     * 如果都成功，
                     */

            }catch (\Exception $e)
            {

            }
        }
        return true;
    }
}