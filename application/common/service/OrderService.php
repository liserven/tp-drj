<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21
 * Time: 17:32
 */

namespace app\common\service;
use app\common\model\BuildingDetails;
use app\common\model\BuildingOrder;
use app\common\model\BuildingOrderDetail;
use app\common\model\BuildingScreen;
use app\common\model\UserDelivery;
use app\lib\exception\BuildingException;
use app\lib\exception\OrderException;
use app\lib\exception\ParameterException;
use app\lib\exception\UserException;
use think\Db;

/**
 * Class OrderService
 * @package app\common\service
 * 订单处理
 */
class OrderService
{
    /**
     * 订单处理分为三大类
     * 第一类：直接从建材提交过来的订单。
     * 直接提交过来的订单，一定为单个，适量可能是多个，颜色规格确定为一个。
     * 生成订单也为一条记录。
     * 第二类：从购物车提交过来的类
     * 购物车过来的商品可能是多条,可能在购物车中一次购买多条商品，都为多个，所以每次商品是从购物车中过的来的情况下，
     * 都要以多条商品来处理结果，所以不能为一个方法，
     *
     *
     * 总体： 订单的支付流程: 先查询订单是否存在，是否和当前登陆的用户是否一致，
     * 后组合数据发起预支付订单请求，返回结果后更新订单内容，返回客户端需要支付的请求的内容，以便前端唤起微信支付所用的数据。
     * 根据微信支付成功与否的结果修改对应订单的内容，将微信返回的微信订单号保存，以便以后做订单查询。
     */

    private $userId; //用户id
    private $buildings=[]; //商品数组
    private $oBuilding=[];
    private $orderNo;
    private $address;


    public function __construct()
    {

    }

    public function directPurchase($userId, $buildings=[])
    {
        if(empty($userId) || empty($buildings))
        {
            throw new BuildingException([
                'msg' => '提交数据为误'
            ]);
        }
        $this->userId = $userId;
        $this->orderNo = $this->makeOrderNo();
        $this->address = input('address');
        if( empty($this->address) )
        {
            throw new UserException(
                [
                    'msg' => '用户收货地址不存在，下单失败',
                    'errorCode' => 60001,
                ]);
        }
        //查询所有商品信息
        $this->buildings = $this->getProductsByOrder($buildings);
        $status = $this->getOrderStatus();
        if (!$status['pass']) {
            $status['order_id'] = -1;
            return $status;
        }
        $orderSnap = $this->snapOrder();
        $status = self::createOrderByTrans($orderSnap);
        $status['pass'] = true;
        return $status;
    }
// 根据订单查找真实商品
    private function getProductsByOrder($buildings)
    {
        //商品id
        $oPIDs = [];
        foreach ($buildings as $item) {
            array_push($oPIDs, $item['type']);
            Db::table('shopping_trolley')->where([ 'g_bs_id'=> $item['type']])->delete();
        }
        // 为了避免循环查询数据库

        /*
         * 所有查询的数据都是从规格表中查询出来的。
         */

        $products = BuildingScreen::all($oPIDs)->toArray();
        $orderDetailData = [];
        //发票信息
        $invoiceType = input('invoice_type'); //发票类型
        $invoiceRise = input('invoice_rise'); //发票抬头
        $invoiceContent = input('invoice_content'); //发票内容
        $invoiceNumber = input('taxpayer_number'); //纳税人识别号

        if(!empty($invoiceType))
        {
            if($invoiceRise == '单位')
            {
                if( $invoiceNumber == '' || strlen($invoiceNumber) < 15 )
                {
                    throw new ParameterException([
                        'msg' => '纳税人识别号格式错误'
                    ]);
                }
            }
        }
        foreach ( $products as $key=>$product)
        {
            $products[$key]['count'] = $buildings[$key]['count'];
            $orderDetailData[$key]['uid'] = $this->userId;
            $orderDetailData[$key]['gid'] = $buildings[$key]['id'];
            $orderDetailData[$key]['g_name'] = $product['g_name'];
            $orderDetailData[$key]['g_money_all'] = $product['price']*$buildings[$key]['count'];
            $orderDetailData[$key]['g_money_solo'] = $product['price'];
            $orderDetailData[$key]['g_number'] = $buildings[$key]['count'];
            $orderDetailData[$key]['g_type'] = $buildings[$key]['type'];
            $orderDetailData[$key]['g_img'] = $product['img'];
            $orderDetailData[$key]['money_r'] = $product['price'];
            $orderDetailData[$key]['order_no'] = $this->orderNo;
            if(!empty($invoiceType))
            {
                $orderDetailData[$key]['g_receipt'] = $invoiceType;
                $orderDetailData[$key]['g_rise']    = $invoiceRise;
                $orderDetailData[$key]['g_content'] = $invoiceContent;
                $orderDetailData[$key]['taxpayer_number'] = $invoiceNumber;

            }
        }
        $this->oBuilding = $orderDetailData;
        return $products;
    }


    public function checkOrderStock($orderID)
    {
        //        if (!$orderNo)
        //        {
        //            throw new Exception('没有找到订单号');
        //        }

        // 一定要从订单商品表中直接查询
        // 不能从商品表中查询订单商品
        // 这将导致被删除的商品无法查询出订单商品来
        $oProducts = BuildingOrderDetail::where('order_id', '=', $orderID)
            ->select();
        $this->buildings = $this->getProductsByOrder($oProducts);
        $this->oBuilding = $oProducts;
        $status = $this->getOrderStatus();
        return $status;
    }
    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'pStatusArray' => []
        ];
        foreach ($this->buildings as $oProduct) {
            $pStatus =
                $this->getProductStatus(
                    $oProduct['id'], $oProduct['count']);
            //这里返回一个监测库存量的操作。
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }
    // 预检测并生成订单快照
    private function snapOrder()
    {
        // status可以单独定义一个类
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => $this->getUserAddress(),
            'snapName' => $this->buildings[0]['g_name'],
            'snapImg' => $this->buildings[0]['img'],
        ];
        if (count($this->buildings) > 1) {
            $snap['snapName'] .= '等';
        }


        for ($i = 0; $i < count($this->buildings); $i++) {
            $product = $this->buildings[$i];
            $oProduct = $this->buildings[$i];

            $pStatus = $this->snapProduct($product, $oProduct['count']);
            $snap['orderPrice'] += $pStatus['totalPrice'];
            $snap['totalCount'] += $pStatus['count'];
            array_push($snap['pStatus'], $pStatus);
        }
        return $snap;
    }

    // 单个商品库存检测
    private function snapProduct($product, $oCount)
    {
        $pStatus = [
            'id' => null,
            'name' => null,
            'main_img_url'=>null,
            'count' => $oCount,
            'totalPrice' => 0,
            'price' => 0
        ];

        $pStatus['counts'] = $oCount;
        // 以服务器价格为准，生成订单
        $pStatus['totalPrice'] = $oCount * $product['price'];
        $pStatus['name'] = $product['g_name'];
        $pStatus['id'] = $product['id'];
        $pStatus['main_img_url'] =$product['img'];
        $pStatus['price'] = $product['price'];
        return $pStatus;
    }
    /*
     * 购买商品时需要确保用户是已经添加过收件地址的 如查没有收件地址无法购买
     */
    private function getUserAddress()
    {
        $userAddress = UserDelivery::get([ 'uid'=>$this->userId, 'id' => $this->address ]);
        if (!$userAddress) {
            throw new UserException(
                [
                    'msg' => '用户收货地址不存在，下单失败',
                    'errorCode' => 60001,
                ]);
        }
        return $userAddress->id;
    }
    private function getProductStatus($oPID, $oCount)
    {
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'count' => 0,
            'name' => '',
            'totalPrice' => 0
        ];

        for ($i = 0; $i < count($this->buildings); $i++) {
            if ($oPID == $this->buildings[$i]['id']) {
                $pIndex = $i;
            }
        }

        if ($pIndex == -1) {
            // 客户端传递的productid有可能根本不存在
            throw new OrderException(
                [
                    'msg' => 'id为' . $oPID . '的商品不存在，订单创建失败'
                ]);
        } else {
            $product = $this->buildings[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['g_name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;

            if ($product['stock'] - $oCount >= 0) {
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }

    public function checkBuildingDetails()
    {
        if( !is_array($this->buildings) )
        {
            //如果不是数组说明提交数据有误
            throw new BuildingException([
                'msg' => '提交数据有误'
            ]);
        }
        foreach ($this->buildings as $building)
        {
            if( empty($building['id']) ||  empty($building['type']) ||  empty($building['count']) )
            {
                throw new BuildingException([
                    'msg' => '提交数据有误'
                ]);
            }
        }
    }


    //创建订单
    private function createOrderByTrans($snap)
    {
        try {
            $order = new BuildingOrder();
            $order->user_id = $this->userId;
            $order->order_no = $this->orderNo;
            $order->total_price = number_format($snap['orderPrice'], 2);
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $this->address;
            $order->items = json_encode($snap['pStatus']);
            $order->topic = $snap['snapName'];
            $order->message = input('message') ? input('message') : '请尽快发货哟!!';
            $order->save();

            $orderID = $order->id;
            $create_time = $order->create_at;

            foreach ($this->buildings as &$p) {
                $p['order_id'] = $orderID;
            }

            foreach ($this->oBuilding as $key=> $val)
            {
                $this->oBuilding[$key]['order_id'] = $orderID;
                $this->oBuilding[$key]['u_address_id'] = $this->address;
            }

            $orderProduct = new BuildingOrderDetail();
            $orderProduct->saveAll($this->oBuilding);
            return [
                'order_no' => $this->orderNo,
                'order_id' => $orderID,
                'create_time' => $create_time,
                'order_name' => $snap['snapName'],
                'order_money' => number_format($snap['orderPrice'], 2),
            ];
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    //生成订单编号方法
    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }

}