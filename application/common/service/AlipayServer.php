<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/27
 * Time: 10:04
 */

namespace app\common\service;

include_once ROOT_PATH.'extend/Aop/aop/AopClient.php' ;
include_once ROOT_PATH.'extend/Aop/aop/request/AlipayTradeAppPayRequest.php' ;
include_once ROOT_PATH.'extend/Aop/aop/request/AlipayTradeQueryRequest.php' ;
class AlipayServer
{

    public $userId;
    public $orderId;
    public $conf;
    private $aop;  //支付宝链接实例
    private $request;
    public function __construct()
    {
        $this->conf=config('zfb');
        $this->aop = new \AopClient();
        $this->aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $this->aop->appId =  $this->conf['appId'];
        $this->aop->rsaPrivateKey = $this->conf['rsaPrivateKey'];
        $this->aop->alipayrsaPublicKey=$this->conf['alipayrsaPublicKey'];
        $this->aop->apiVersion = '1.0';
        $this->aop->signType = 'RSA2';
        $this->aop->postCharset='UTF-8';
        $this->aop->format='json';
    }


    public function get($orderInfo)
    {
        $aop = new \AopClient;
        $aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $aop->appId = $this->conf['appId'];
        $aop->rsaPrivateKey = $this->conf['rsaPrivateKey'] ;
        $aop->format = "json";
        $aop->charset = "UTF-8";
        $aop->signType = "RSA2";
        $aop->alipayrsaPublicKey = $this->conf['alipayrsaPublicKey'];//对应填写
        //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
        $request = new \AlipayTradeAppPayRequest();
        //SDK已经封装掉了公共参数，这里只需要传入业务参数
        $bizcontent = json_encode(array(
            'body'=>$orderInfo['order_name'],
            'subject' => $orderInfo['order_name'],//支付的标题，
            'out_trade_no' => $orderInfo['order_no'],
            'timeout_express' => '1d',//過期時間（分钟）
            'total_amount' => $orderInfo['order_money'],//金額最好能要保留小数点后两位数
            'product_code' => 'QUICK_MSECURITY_PAY'
        ),JSON_UNESCAPED_UNICODE);
        $request->setNotifyUrl($orderInfo['NotifyUrl']);//你在应用那里设置的异步回调地址
        $request->setBizContent($bizcontent);
        //这里和普通的接口调用不同，使用的是sdkExecute
        $response = $aop->sdkExecute($request);
        return $response;
    }



    //查询订单信息
    public function tradeQuery($trade_no)
    {
        $this->request = new \AlipayTradeQueryRequest;
        $bizcontent = json_encode(array(
            'trade_no' => $trade_no
        ),JSON_UNESCAPED_UNICODE);
        $this->request->setBizContent($bizcontent);
        $result = $this->aop->execute ( $this->request);
        $responseNode = str_replace(".", "_", $this->request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){
            return $result->alipay_trade_query_response;
        } else {
            return false;
        }
    }

    //退款

    public function refund($trade_no)
    {
        include_once ROOT_PATH.'extend/Aop/aop/request/AlipayTradeRefundRequest.php' ;
        $this->request = new \AlipayTradeRefundRequest ;
        $bizcontent = json_encode(array(
            'trade_no' => $trade_no,
            'refund_amount' => 0.01,
        ),JSON_UNESCAPED_UNICODE);
        $this->request->setBizContent($bizcontent);
        $result = $this->aop->execute ( $this->request);

        $responseNode = str_replace(".", "_", $this->request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){
            return $result->alipay_trade_refund_response;
        } else {
            return false;
        }
    }



}