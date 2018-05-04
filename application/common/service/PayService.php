<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 15:03
 */

namespace app\common\service;


use app\common\model\BargainSte;
use app\common\model\BuildingOrder;
use app\lib\exception\OrderException;
use app\lib\exception\ParameterException;
use app\lib\exception\TokenException;
use enum\BuildingOrderStatus;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');
class PayService
{
    private $orderNo;
    private $orderID;
//    private $orderModel;

    function __construct()
    {

    }

    public function pay($orderID)
    {
        if (!$orderID)
        {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
        $order = $this->checkOrderValid($this->orderID);
        return $this->makeWxPreOrder($order['total_price']);
        //        $this->checkProductStock();
    }

    //申请合伙人支付预订单接口
    public function applyPartnerPay($orderId, $notifyUrl='http://www.61drhome.cn/apply_partner_notify')
    {
        $this->orderNo = $orderId;
        $money = BargainSte::find();
        $total = !empty($money['partner_money']) ? $money['partner_money'] : 20000;
        $body = '定容家申请合伙人费用';
        return $this->makeWxPreOrder($total, $notifyUrl, $body);
    }
    // 构建微信支付订单信息
    private function makeWxPreOrder($totalPrice, $notifyUrl='', $body='定容家' )
    {
        $notify = !empty($notifyUrl)?$notifyUrl:'http://www.61drhome.cn/api/v1/wx_notify';
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNo);
        $wxOrderData->SetTrade_type('APP');
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        $wxOrderData->SetProduct_id($this->orderID);
        $wxOrderData->SetBody($body);
        $wxOrderData->SetNotify_url($notify);
        return $this->getPaySignature($wxOrderData);
    }

    //向微信请求订单号并生成签名
    private function getPaySignature($wxOrderData)
    {
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
            throw new ParameterException(['msg'=>$wxOrder['return_msg']]);
        }
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    private function recordPreOrder($wxOrder){
        // 必须是update，每次用户取消支付后再次对同一订单支付，prepay_id是不同的
        BuildingOrder::where('id', '=', $this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }
// 签名
    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('sWx.appId'));
        $jsApiPayData->SetTimeStamp((string)time());
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage('Sign=WXPay');
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        $rawValues['appid'] = $wxOrder['sign'];
        $rawValues['mch_id'] = $wxOrder['mch_id'];
        $rawValues['prepay_id'] = $wxOrder['prepay_id'];
        $rawValues['nonce_str'] = $wxOrder['nonce_str'];
        if(isset($wxOrder['code_url']))
        {
            $rawValues['code_url'] = $wxOrder['code_url'];
        }
        unset($rawValues['appId']);
        return $rawValues;
    }

    /**
     * @return bool
     * @throws OrderException
     * @throws TokenException
     */
    private function checkOrderValid()
    {
        $order = BuildingOrder::where('id', '=', $this->orderID)
            ->find();
        if (!$order)
        {
            throw new OrderException();
        }
//        $currentUid = Token::getCurrentUid();

        if($order->status > BuildingOrderStatus::UNPAID ){
            throw new OrderException([
                'msg' => '订单已支付过啦',
                'errorCode' => 80003,
                'code' => 200
            ]);
        }
        $this->orderNo = $order->order_no;
        return $order;
    }
    //微信订单查询
    public function payFind($transaction_id)
    {
        $wxOrderData = new \WxPayOrderQuery();
        $wxOrderData->SetTransaction_id($transaction_id);

        $refundResult = \WxPayApi::orderQuery($wxOrderData);
        if($refundResult['return_code'] != 'SUCCESS' || $refundResult['result_code'] !='SUCCESS'){
            Log::record($refundResult,'error');
            Log::record('获取预支付订单失败','error');
            throw new ParameterException(['msg'=>$refundResult['return_msg']]);
        }
        return $refundResult;
    }

    //微信退款
    public function payRefund()
    {
        $wxOrderData = new \WxPayRefund();
        $wxOrderData->SetTransaction_id('4200000061201804116537220992');
        $wxOrderData->SetRefund_fee(0.01*100);
        $wxOrderData->SetOut_refund_no(makeOrderNo());
        $wxOrderData->SetTotal_fee(0.01*100);
        $wxOrderData->SetOp_user_id(4);


        $refundResult = \WxPayApi::refund($wxOrderData);
        if($refundResult['return_code'] != 'SUCCESS' || $refundResult['result_code'] !='SUCCESS'){
            Log::record($refundResult,'error');
            Log::record('获取预支付订单失败','error');
            throw new ParameterException(['msg'=>$refundResult['return_msg']]);
        }
        return true;
    }
}