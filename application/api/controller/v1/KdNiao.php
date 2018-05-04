<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 12:22
 */

namespace app\api\controller\v1;


use app\common\model\BuildingOrderDetail;
use app\common\service\KdniaoService;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\OrderException;
use enum\BuildingOrderStatus;
use think\Db;

class KdNiao extends Base
{


    public function findKd($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $order = BuildingOrderDetail::get($id);
        $kdService = new KdniaoService();
        $result =  $kdService->getOrderTracesByJson($order['express_code'],$order['logistics']);
        return show(true, 'ok', $result);
    }


}