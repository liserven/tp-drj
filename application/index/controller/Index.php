<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 16:07
 */

namespace app\index\controller;


use app\common\model\BuildingOrder;
use app\common\service\OrderService;
use app\common\service\PayService;
use app\common\service\WxPayServer;
use think\Controller;
use think\Log;


class Index extends Controller
{


    public function index()
    {
echo phpinfo();
        return $this->fetch();

    }

    public function getImg ()
    {
        require_once ROOT_PATH.'extend/phpqrcode/phpqrcode.php';
//        $products = [
//            [
//                'id' => 11,
//                'count' => 1,
//                'type' => 1,
//            ]
//        ];
//        $payService = new OrderService( );
//        $orderResult = $payService->directPurchase(4, $products);
        $payServer = new PayService();
        $result = $payServer->pay(86);
        $value = $result['code_url'];                  //二维码内容
        $errorCorrectionLevel = 'L';    //容错级别
        $matrixPointSize = 5;           //生成图片大小
        header('Content-Type: image/png');
        \QRcode::png($value,false,$errorCorrectionLevel, $matrixPointSize, 2);die;
    }


    public function zhifu()
    {
    require_once ROOT_PATH.'extend/apowy/config.php';
    require_once ROOT_PATH.'extend/apowy/pagepay/service/AlipayTradeService.php';
    require_once ROOT_PATH.'extend/apowy/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = trim($_POST['WIDout_trade_no']);

    //订单名称，必填
    $subject = trim($_POST['WIDsubject']);

    //付款金额，必填
    $total_amount = trim($_POST['WIDtotal_amount']);

    //商品描述，可空
    $body = trim($_POST['WIDbody']);

	//构造参数
	$payRequestBuilder = new \AlipayTradePagePayContentBuilder();
	$payRequestBuilder->setBody($body);
	$payRequestBuilder->setSubject($subject);
	$payRequestBuilder->setTotalAmount($total_amount);
	$payRequestBuilder->setOutTradeNo($out_trade_no);
	$config = config('zfb');
	$aop = new \AlipayTradeService($config);

	/**
	 * pagePay 电脑网站支付请求
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @param $return_url 同步跳转地址，公网可以访问
	 * @param $notify_url 异步通知地址，公网可以访问
	 * @return $response 支付宝返回的信息
 	*/
	$response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

	//输出表单
	var_dump($response);
    }
}