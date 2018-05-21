<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 17:27
 */

namespace app\api\controller\v1;


use app\common\model\BuildingOrder;
use app\common\model\BuildingOrderDetail;
use app\common\model\UserDelivery;
use app\common\model\UserNotices;
use app\common\model\VillaOrder;
use app\common\service\KdniaoService;
use app\common\service\OrderService;
use app\common\service\PayService;
use app\common\service\WxPayServer;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\BuildingException;
use app\lib\exception\OrderException;
use app\lib\exception\ParameterException;
use enum\BuildingOrderStatus;
use think\Db;

class Order extends Base
{
    protected $beforeActionList = [
        'checkLogin' => ['only' => 'confirmReceive,getOrderByBuilding,getOrderByVilla,reportOrder,cancelBuildingOrder,delBuildingOrder
        ,getOrderDetailBuilding,AnOorder']
    ];


    //建材订单
    public function getOrderByBuilding()
    {
        $status = input('status');
        if (!$status) {
            throw new ParameterException([
                'msg' => '状态不可为空'
            ]);
        }
        $limit = $this->getLimit();
        $oBuildings = Db::table('building_order')->where(['user_id' => $this->user['ud_id'], 'status' => $status])

            ->field('id, order_no, total_count, snap_img, snap_name, total_price')->paginate($limit);
//        $oBuildings = Db::table('building_order_detail')->where(['uid' => $this->user['ud_id'], 'status' => $status])
//
//            ->field('order_id as id, u_address_id as snap_address,gid,g_name as snap_name,g_money_all as total_price,order_no
//            ,g_money_solo,g_number as total_count, g_img as snap_img,create_at,status,message,g_type')->paginate($limit);

        if ($oBuildings->isEmpty()) {
            throw new BuildingException([
                'msg' => '当前没有订单'
            ]);
        }
        return show(true, 'ok', $oBuildings);
    }


    //获取建材订单详情
    public function getOrderDetailBuilding($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $oBuilding = BuildingOrder::getOrderDetailsBuWhereFind(['id' => $id]); //获取订单
        if( !$oBuilding )
        {
            return show( false, '订单不存在', [], 90004);
        }
        $oBuilding['address'] = UserDelivery::get($oBuilding['snap_address']);
        if (!$oBuilding) {
            throw new OrderException();
        }
        if ($oBuilding['user_id'] != $this->user['ud_id']) {
            throw new OrderException([
                'msg' => '该订单不是你的'
            ]);
        }
        $details = BuildingOrderDetail::getBuildOrdersByOrderId(['order_id' => $oBuilding['id']]); //获取订单详情
        foreach ($details as &$detail) {
            if ($detail['status'] == BuildingOrderStatus::TRANSLATE) {
                //如果已经支付 有物流信息
                $wl = (new KdniaoService())->getOrderTracesByJson($detail['express_code'], $detail['logistics'], $oBuilding['pay_time']);
                $detail['wl_name'] = $wl['kd_name'];
                $detail['pay_time'] = $oBuilding['pay_time'];
            }
        }
        $oBuilding['details'] = $details;
        $oBuilding['g_receipt'] = $details[0]['g_receipt'] ? $details[0]['g_receipt'] : '';
        $oBuilding['g_rise'] = $details[0]['g_rise'] ? $details[0]['g_rise'] : '';
        $oBuilding['g_content'] = $details[0]['g_content'] ? $details[0]['g_content'] : '';
        $oBuilding['taxpayer_number'] = $details[0]['taxpayer_number'] ? $details[0]['taxpayer_number'] : '';
        $oBuilding['g_type'] = $details[0]['g_type'] ? $details[0]['g_type'] : '';
        $oBuilding['message'] = $details[0]['message'] ? $details[0]['message'] : '';
        return show(true, 'ok', $oBuilding);

    }


    //别墅订单
    public function getOrderByVilla()
    {
        $oBuildings = Db::table('villa_order')->where(['user_id' => $this->user['ud_id']])->
        field('order_id, partner_id, user_id, create_at, villa_type, villa_name, villa_img, status')->limit(10)->select();
        foreach ($oBuildings as &$villa) {
            if ($villa['status'] == 1) {
                $villa['status'] = '已签约';
            }
            if ($villa['status'] == 2) {
                $villa['status'] = '施工中';
            }
            if ($villa['status'] == 3) {
                $villa['status'] = '项目已完成';
            }
        }
        if (empty($oBuildings)) {
            throw new BuildingException();
        }
        return show(true, 'ok', $oBuildings);
    }


    public function AnOorder()
    {
        $ids = input('id/a');
        $counts = input('count/a');
        $types = input('type/a');
        $products = [];
        foreach ($ids as $key => $id) {
            $products[$key]['id'] = $id;
            $products[$key]['count'] = $counts[$key];
            $products[$key]['type'] = $types[$key];
        }
        $payService = new OrderService();
        $orderResult = $payService->directPurchase($this->user['ud_id'], $products);
        if ($orderResult['pass']) {
            return show(true, 'ok', $orderResult);
        } else {
            return show(false, 'error', []);
        }
    }

    //提交订单
    public function reportOrder()
    {
        $products = input('products/a');
        if( !empty($products))
        {
        }
        $payService = new OrderService();
        $orderResult = $payService->directPurchase($this->user['ud_id'], $products);
        if ($orderResult['pass']) {
            return show(true, 'ok', $orderResult);
        } else {
            return show(false, 'error', []);
        }
    }


    //取消订单
    public function cancelBuildingOrder($id, $content = '拍错了,抱歉!')
    {
        (new IDMustBePositiveInt())->goCheck();
        //取消订单 已经支付过的订单无法取消
        $orderDetail = BuildingOrder::get($id);
        if ($orderDetail->status >= BuildingOrderStatus::PAID || empty($orderDetail)) {
            //订单已支付 或已取消
            throw new OrderException([
                'msg' => '订单已经支付或已取消，无法取消',
                'errorCode' => 90009
            ]);
        }

        try {
            $orderDetail->status = BuildingOrderStatus::CANCEL; //修改状态为取消
            $orderDetail->cancel_reason = $content;
            $orderDetail->save();

            return show(true, 'ok', ['is_cancel' => true]);
        } catch (\Exception $e) {
            return show(false, 'error', ['is_cancel' => false]);
        }


    }


    //删除订单
    public function delBuildingOrder($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        //取消订单 已经支付过的订单无法取消
        $orderDetail = BuildingOrder::get($id);
        if (empty($orderDetail)) {
            throw new OrderException([
                'msg' => '订单不存在，无法删除',
                'errorCode' => 90010
            ]);
        }

        if ($orderDetail->status != BuildingOrderStatus::CANCEL && $orderDetail->status != BuildingOrderStatus::UNPAID) {
            throw new OrderException([
                'msg' => '订单正在支付，无法删除',
                'errorCode' => 90011
            ]);
        }
        Db::startTrans();
        try {
            $orderDetail->delete();
            BuildingOrderDetail::destroy(['order_id' => $id]);
            Db::commit();
            return show(true, 'ok', ['is_del' => true]);

        } catch (\Exception $e) {
            Db::rollback();
            return show(false, 'ok', ['is_del' => false]);
        }
    }



    public function outOrder($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        //取消订单 已经支付过的订单无法取消
        $orderDetail = BuildingOrderDetail::get($id);
        if( $orderDetail['user_id'] != $this->user['ud_id'])
        {
            return show( false, '无法修改别人订单');
        }
        $orderDetail->status=BuildingOrderStatus::SIGN;
        $result = $orderDetail->save();
        return $this->resultHandle($result);
    }

    //确认收货
    public function confirmReceive($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $order = BuildingOrder::get($id);
        if( !$order || $order['user_id'] != $this->user['ud_id'])
        {
            return show( false , '该订单不存在或不属于你');

        }
        if( $order['status'] != BuildingOrderStatus::TRANSLATE )
        {
            return show( false, '该订单还未发货,无法确认收货');
        }
        Db::startTrans();
        try{
            $order->status = BuildingOrderStatus::SIGN;
            $order->save();
            Db::table('building_order_detail')->where([ 'order_id'=> $id])->update([ 'status'=> BuildingOrderStatus::SIGN, 'is_receive'=> 2]);
            UserNotices::create([
                'user_id'=> $this->user['ud_id'],
                'topic'=> '收货通知',
                'content'=> '您所购买的'.$order['snap_name'].'已经已经确认收货, 欢迎选择定容家,祝您购物愉快!',
                'type'=> 2,
                'img'=> $order['snap_img']
            ]);
            Db::commit();
            return show( true, '确认收货成功');
        }catch (\Exception $e){
            Db::rollback();
            return show( false, $e->getMessage());
        }
    }
}