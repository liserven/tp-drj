<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21
 * Time: 17:11
 */

namespace app\api\controller\v1;


use app\common\model\BuildingOrder;
use app\common\service\AlipayServer;
use app\common\service\BuildingAliPayNotifyService;
use app\common\service\BuildingWxPayNotifyService;
use app\common\service\OrderService;
use app\common\service\PayService;
use app\common\service\WxPayServer;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\OrderException;
use enum\BuildingOrderStatus;
use think\Log;

include_once ROOT_PATH.'extend/Aop/aop/AopClient.php' ;

class Pay extends Base
{

    protected $beforeActionList = [
        'checkLogin' => [ 'only'=> 'payBuildingByWx,aliPay'],
    ];


    //建材微信支付
    public function payBuildingByWx($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $orderData = BuildingOrder::get($id);
        if($orderData['status'] > BuildingOrderStatus::UNPAID || !$orderData)
        {
            throw new OrderException([
                'msg' => '该订单已经支付或已取消'
            ]);
        }
//        $payServer = new PayService();
//        return json($payServer->pay($id));


        $payServer = new WxPayServer();
        $payServer->total_fee = $orderData['total_price']*100;
        $payServer->out_trade_no = $orderData['order_no'];
        $payServer->notify_url = 'http://www.61drhome.cn/api/v1/wx_notify';
        $payServer->body = $orderData['snap_name'];
        return json($payServer->doPay());
     }

    //建材微信支付回调
    public function payBuildingByWxNotify(){
        $notify = new BuildingWxPayNotifyService();
        $notify->handle();
    }



    //建材支付宝支付
    public function aliPay($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $orderData = BuildingOrder::get($id);
        if($orderData['status'] > BuildingOrderStatus::UNPAID || !$orderData)
        {
            throw new OrderException([
                'msg' => '该订单已经支付或已取消'
            ]);
        }
        $aliPayService = new AlipayServer();
        return $aliPayService->get([
            'order_name' => $orderData->snap_name,
            'order_money' => $orderData->total_price,
            'order_no' => $orderData->order_no,
            'notify_url' => 'http://www.61drhome.cn/ali_pay_building_notify'
        ]);
    }


    //支付宝支付回调  异步通知
    public function buildingAliPayNotify()
    {
        $service = new BuildingAliPayNotifyService();
        $service->buildingPayNotify();
    }


    //微信查询
    public function reFind($transaction_id)
    {
        $payServer = new PayService();
        return json($payServer->payFind($transaction_id));
    }

}