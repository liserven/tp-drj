<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 10:38
 */

namespace app\common\service;

use app\admin\controller\Log;
use app\common\model\BuildingOrder;
use app\common\model\UserNotices;
use enum\BuildingOrderStatus;
use think\Db;
use think\Loader;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');
class BuildingWxPayNotifyService extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg)
    {
        if ($data['result_code'] == 'SUCCESS') {
            $orderNo = $data['out_trade_no'];
            $transactionId = $data['transaction_id']; //微信支付订单号
            $timeEnd = $data['time_end'];  //成功成功时间
            $totalFell = $data['total_fee']/100;  //支付总金额
            Db::startTrans();
            try {
                $orderData = BuildingOrder::where('order_no', '=', $orderNo)->lock(true)->find();
                if ($orderData->status == 1) {
                    (new BuildingAliPayNotifyService())->checkStock($orderData->id);

                    $NoticeData = [
                        'user_id' => $orderData['user_id'],
                        'topic' => '支付成功',
                        'content' => '您的订单名称为'.$orderData->snap_name.'已经支付成功',
                        'type'=> 2,
                        'img'=> $orderData['snap_img']

                    ];

                    $orderData->status = BuildingOrderStatus::PAID;
                    $orderData->payment_type = 'wx';
                    $orderData->transaction_id = $transactionId;
                    $orderData->parment_money = $totalFell;
                    $orderData->pay_time = $timeEnd;
                    $orderData->save();
                    Db::table('building_order_detail')->where(['order_id'=> $orderData['id']])->update(['status'=>BuildingOrderStatus::PAID]);
                    UserNotices::create($NoticeData);
                }
                Db::commit();
                return true;
            } catch (Exception $ex) {
                Db::rollback();
                Log::error($ex);
                // 如果出现异常，向微信返回false，请求重新发送通知
                return false;
            }
        }
        return false;
    }
}