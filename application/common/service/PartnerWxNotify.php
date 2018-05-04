<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 19:33
 */

namespace app\common\service;

use app\common\model\PartnerAudit;
use think\Db;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class PartnerWxNotify extends \WxPayNotify
{



    public function NotifyProcess($data, &$msg)
    {
        /**
         * 合伙人申请信息：
         * 支付成功后，返回通知，
         * 如果支付成功后，修改申请信息， 改成为已付款
         * 行者等待申核
         *
         *
         */
        if ($data['result_code'] == 'SUCCESS' ) {
            //如果支付结果为success 说明支付成功了
            $orderNo = $data['out_trade_no']; //设置的订单号

            try{
                $partnerData = PartnerAudit::get([ 'order_no' => $orderNo]); //获取合伙人申请信息
                $partnerData->examine_status = 4;
                $partnerData->payment_type = 'wx';
                $partnerData->transaction_id = $data['transaction_id'];
                $partnerData->parment_money = $data['total_fee']/100;
                $partnerData->save();

            }catch (\Exception $e)
            {

                Log::error($e);
                return false;
            }
        }
        return true;
    }
}