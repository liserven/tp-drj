<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 9:59
 */

namespace app\common\service;


use app\common\model\PartnerAudit;
use app\common\model\UserNotices;
use enum\AliPaymentStatus;
use enum\PartnerUserStatus;
use think\Db;
use think\Log;

include_once ROOT_PATH.'extend/Aop/aop/AopClient.php' ;
include_once ROOT_PATH.'extend/Aop/aop/request/AlipayTradeAppPayRequest.php' ;
class PartnerAliPayNotifyService
{
        public function partnerNotify()
        {
            $config = config('zfb');
            $aliPayNotify = new \AopClient;
            $aliPayNotify->alipayrsaPublicKey = $config['zfb_gy'];
            $verifyResult = $aliPayNotify->rsaCheckV1($_POST, NULL, "RSA2");
            if( $verifyResult )
            {
                //商户订单号
                $out_trade_no = isset($_REQUEST['out_trade_no']) ? $_REQUEST['out_trade_no'] : '';
                //支付宝交易号
                $trade_no     = isset($_REQUEST['trade_no']) ? $_REQUEST['trade_no'] : '';
                //交易状态
                $trade_status = isset($_REQUEST['trade_status']) ? $_REQUEST['trade_status'] : '';
                //支付金额
                $total_fee 	  = isset($_REQUEST['receipt_amount']) ? $_REQUEST['receipt_amount'] : '';
                //支付时间
                $pay_date 	  = isset($_REQUEST['gmt_payment']) ? $_REQUEST['gmt_payment'] : '';

                //app_id
                $app_id 	  = isset($_REQUEST['app_id']) ? $_REQUEST['app_id'] : '';
                //支付卖家商号
                $seller_id	  = isset($_REQUEST['seller_id']) ? $_REQUEST['seller_id'] : '';


                $orderData = PartnerAudit::get([ 'order_no'=> $out_trade_no]);

                if( $app_id != $config['appId'] || $seller_id != $config['seller_id'] || empty($orderData) )
                {
                    //如果appid不对， 商户号不对 订单也不存在
                    exit('fail');
                }

                if( $trade_status == AliPaymentStatus::TradeSuccess )
                {

                    $NoticeData = [
                        'user_id' => $orderData['user_id'],
                        'topic' => '支付成功',
                        'content' => '合伙人审核款支付成功,定容家正在快马加鞭帮您审核，请耐心等候',
                    ];
                    Db::startTrans();
                    try{
                        //如果订单号也存在 支付结果也成功修改订单状态
                        $orderData->examine_status = PartnerUserStatus::WAIT;
                        $orderData->payment_type = 'zfb';
                        $orderData->trade_no = $trade_no;
                        $orderData->parment_money = $total_fee;
                        $orderData->pay_time = $pay_date;
                        $orderData->save();
                        UserNotices::create($NoticeData);
                        Db::commit();
                        exit('success');
                    }catch (\Exception $e){
                        Db::rollback();
                        Log::write($e);
                    }
                }
                else{
//                    $orderData->examine_status = PartnerUserStatus::NO_PAID;
                    exit('fail');
                }
            }
            Log::write('签名验证失败了。');
            exit('fail');
        }
}