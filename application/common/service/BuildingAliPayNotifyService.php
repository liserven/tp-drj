<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 10:15
 */

namespace app\common\service;


use app\admin\controller\Log;
use app\common\model\BuildingOrder;
use app\common\model\BuildingOrderDetail;
use app\common\model\BuildingScreen;
use app\common\model\UserNotices;
use enum\AliPaymentStatus;
use enum\BuildingOrderStatus;
use think\Db;

include_once ROOT_PATH.'extend/Aop/aop/AopClient.php' ;
include_once ROOT_PATH.'extend/Aop/aop/request/AlipayTradeAppPayRequest.php' ;
class BuildingAliPayNotifyService
{
    /**
     * @throws \think\exception\DbException
     * 订单支付成功回调
     * 修改库存
     *
     *
     */
    Public function buildingPayNotify()
    {
        $config = config('zfb');
        $aliPayNotify = new \AopClient();
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


            $orderData = BuildingOrder::get([ 'order_no'=> $out_trade_no]);

            if( $app_id != $config['appId'] || $seller_id != $config['seller_id'] || empty($orderData) )
            {
                //如果appid不对， 商户号不对 订单也不存在
                exit('fail');
            }

            if( $trade_status == AliPaymentStatus::TradeSuccess )
            {

                //监测库存
                $status = $this->checkStock($orderData->id);
                $NoticeData = [
                    'user_id' => $orderData['user_id'],
                    'topic' => '支付成功',
                    'content' => '您的订单名称为'.$orderData->snap_name.'已经支付成功',
                    'type'=> 2,
                    'img'=> $orderData['snap_img']
                ];
                Db::startTrans();
                try{
                    //如果订单号也存在 支付结果也成功修改订单状态
                    $orderData->status = $status;
                    $orderData->payment_type = 'zfb';
                    $orderData->trade_no = $trade_no;
                    $orderData->parment_money = $total_fee;
                    $orderData->pay_time = $pay_date;
                    $orderData->save();
                    BuildingOrderDetail::where(['order_id'=> $orderData['id']])->update(['status'=> $status]);
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


    //监测库存
    public function checkStock($id)
    {
        //找出该订单下的所有商品
        $orderDetails = BuildingOrderDetail::all([
            'order_id' => $id
        ]);

        foreach ($orderDetails as $orderDetail)
        {
            //找出该商品
            $product = BuildingScreen::get($orderDetail['g_type']);
            //监测库存，如果库存充足，修改已支付，库存不足修改状态库存不足
            if( $product['stock'] < $orderDetail['g_number'] )
            {
                $status =  BuildingOrderStatus::PAIDSTOCKNO;
            }else{
                $status = BuildingOrderStatus::PAID;
                $product->stock = $product['stock'] - $orderDetail['g_number'];
                $product->save();  //修改库存
            }
        }

        return $status;
    }


}