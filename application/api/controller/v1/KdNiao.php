<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 12:22
 */

namespace app\api\controller\v1;


use app\common\model\BuildingOrderDetail;
use app\common\service\BuildingAliPayNotifyService;
use app\common\service\KdniaoService;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\OrderException;
use enum\BuildingOrderStatus;
use think\Db;
use think\Log;

class KdNiao extends Base
{


    public function findKd($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $order = BuildingOrderDetail::get($id);
        if( !$order['express_code'] || !$order['logistics'])
        {
            return show(false, '当前没有物流信息', [], 90004);
        }

        $kdService = new KdniaoService();
        $result =  $kdService->getOrderTracesByJson($order['express_code'],$order['logistics']);
        $phone = Db::table('express_code')->where(['code'=> $result['ShipperCode']])->find();
        $result['phone'] = $phone['phone'];
        $result['g_img'] = $order['g_img'];
        $result['order_no'] = $order['order_no'];
        $result['g_name'] = $order['g_name'];
        return show(true, 'ok', $result);
    }


    //测试检查库存
    public function checkOut()
    {
        dd((new BuildingAliPayNotifyService())->checkStock(111));
    }



    public function kdtuisong()
    {
        $json = json_decode(file_get_contents('php://input'), 1);
        $data = json_decode($json['RequestData'], true);
        if( !$data )
        {
            $result = [
                'EBusinessID'=> '1151847',
                'UpdateTime'=>  '2016-08-09 16:42:33',
                'Success'=> true,
                'Reason'=>'',
            ];

        }else{
            $result = [
                'EBusinessID'=> '1151847',
                'UpdateTime'=> '2016-08-09 16:42:22',
                'Success'=> true,
                'Reason'=>'',
            ];

        }
        return json($result);
    }

}