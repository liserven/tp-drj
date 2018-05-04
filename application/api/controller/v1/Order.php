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
use app\common\model\VillaOrder;
use app\common\service\KdniaoService;
use app\common\service\OrderService;
use app\common\service\PayService;
use app\common\service\WxPayServer;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\BuildingException;
use app\lib\exception\OrderException;
use enum\BuildingOrderStatus;
use think\Db;

class Order extends Base
{
    protected $beforeActionList = [
        'checkLogin'=> [ 'only'=> 'getOrderByBuilding,getOrderByVilla,reportOrder,cancelBuildingOrder,delBuildingOrder
        ,getOrderDetailBuilding']
    ];



    //建材订单
    public function getOrderByBuilding()
    {
        $oBuildings = BuildingOrder::getOrderDetailsBuWhere([ 'user_id'=> $this->user['ud_id']]);
        if(collection($oBuildings)->isEmpty())
        {
            throw new BuildingException([
                'msg'=>'当前没有订单'
            ]);
        }
        return show( true, 'ok', $oBuildings);
    }

    public function getOrderDetailBuilding($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $oBuilding = BuildingOrder::getOrderDetailsBuWhereFind([ 'id'=> $id]); //获取订单
        if(!$oBuilding)
        {
            throw new OrderException();
        }
        $details = BuildingOrderDetail::getBuildOrdersByOrderId([ 'order_id'=> $oBuilding['id']]); //获取订单详情
        foreach ($details as &$detail)
        {
            if( $detail['status'] == BuildingOrderStatus::PAID )
            {
                //如果已经支付 有物流信息
                $wl = (new KdniaoService())->getOrderTracesByJson($detail['express_code'],$detail['logistics'], $oBuilding['pay_time']);
                $detail['wl_name'] = $wl['kd_name'];
                $detail['pay_time'] = $oBuilding['pay_time'];
                $detail['wl_detail'] = $wl['Traces'][0];
            }
        }
        $oBuilding['details'] = $details;
        return show(true, 'ok', $oBuilding);

    }




    //别墅订单
    public function getOrderByVilla()
    {
        $oBuildings = Db::table('villa_order')->where([ 'user_id'=> $this->user['ud_id']])->
            field('order_id, partner_id, user_id, create_at, villa_type, villa_name, villa_img, status')->limit(10)->select();
        foreach ( $oBuildings as &$villa)
        {
            if( $villa['status'] == 1 )
            {
                $villa['status'] = '已签约';
            }
            if( $villa['status'] == 2 )
            {
                $villa['status'] = '施工中';
            }
            if( $villa['status'] == 3 )
            {
                $villa['status'] = '项目已完成';
            }
        }
        if(empty($oBuildings))
        {
            throw new BuildingException();
        }
        return show( true, 'ok', $oBuildings);
    }


    //提交订单
    public function reportOrder()
    {
        $products = input('products/a');
        $payService = new OrderService( );
        $orderResult = $payService->directPurchase($this->user['ud_id'], $products);
        if( $orderResult['pass'] ) {
            return show(true, 'ok', $orderResult);
        }
        else{
            return show( false , 'error', []);
        }
    }


    //取消订单
    public function cancelBuildingOrder($id, $content = '拍错了,抱歉!')
    {
        (new IDMustBePositiveInt())->goCheck();
        //取消订单 已经支付过的订单无法取消
        $orderDetail = BuildingOrder::get($id);
        if( $orderDetail->status >= BuildingOrderStatus::PAID || empty($orderDetail) )
        {
            //订单已支付 或已取消
            throw new OrderException([
                'msg' => '订单已经支付或已取消，无法取消',
                'errorCode' => 90009
            ]);
        }

        try{
            $orderDetail->status = BuildingOrderStatus::CANCEL; //修改状态为取消
            $orderDetail->cancel_reason = $content;
            $orderDetail->save();

            return show(true, 'ok', [ 'is_cancel'=> true]);
        }catch (\Exception $e)
        {
            return show( false , 'error', [ 'is_cancel'=> false]);
        }




    }


    //删除订单
    public function delBuildingOrder($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        //取消订单 已经支付过的订单无法取消
        $orderDetail = BuildingOrder::get($id);
        if( empty($orderDetail) )
        {
            throw new OrderException([
                'msg' => '订单不存在，无法删除',
                'errorCode' => 90010
            ]);
        }

        if( $orderDetail->status != BuildingOrderStatus::CANCEL && $orderDetail->status != BuildingOrderStatus::UNPAID  )
        {
            throw new OrderException([
                'msg' => '订单正在支付，无法删除',
                'errorCode' => 90011
            ]);
        }
        Db::startTrans();
        try{
            $orderDetail->delete();
            BuildingOrderDetail::destroy([ 'order_id'=> $id ]);
            Db::commit();
            return show( true, 'ok', [ 'is_del'=> true]);

        }catch (\Exception $e){
            Db::rollback();
            return show( false, 'ok', [ 'is_del'=> false]);
        }



    }

}