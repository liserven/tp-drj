<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 12:22
 */

namespace app\api\controller\v1;


use app\common\model\BuildingOrder;
use app\common\model\BuildingOrderDetail;
use app\common\model\UserNotices;
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
        $orders = BuildingOrder::get($order['order_id']);
        $kdService = new KdniaoService();
        $result =  $kdService->getOrderTracesByJson($order['express_code'],$order['logistics'], $orders['pay_time']);
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
        $config = config('kdniao');
        $data = json_decode($_POST['RequestData'], true);
        //如果状态成功 并且快件状态为3 说明已收件 将数据修改
        if( $data['Data'][0]['Success'] === true && $data['Data'][0]['State'] == 3  )
        {
            $this->operationBuildingOrder($data['Data'][0]['LogisticCode']);
        }


        $result = [
            'EBusinessID'=> $config['EBusinessID'],
            'UpdateTime'=>  date('Y-m-d H:i:s'),
            'Success'=> true,
            'Reason'=>'',
        ];
        return json($result);
    }

//    public function Subscribe($data = [])
//    {
//        if( empty($data) )
//        {
//            return show( false, '数据不能为空');
//        }
//        $config = config('kdniao');
//        $kdService = new KdniaoService();
//        $data = [
//            'RequestType'=> 8008,
//            'DataSign'=> $kdService,
//            'EBusinessID' => $config['EBusinessID'],
//            'ShipperCode'=> 'STO',  //快递公司编码
//            'LogisticCode'=> 494285823176, //快递单号
//            'Receiver'=> [
//                'Name'=> '李沈阳', //收件人
//                'Mobile'=> 13525965579, //手机
//                'ProvinceName'=> '河南省', //收件省
//                'CityName'=> '洛阳市', //收件市
//                'ExpAreaName'=>'孟津县',  //收件区/县
//                'Address'=>'河南省洛阳市孟津县横水镇', //收件人详细地址
//            ],
//            'Sender'=> [
//                'Name'=> '李沈阳', //收件人
//                'Mobile'=> 13525965579, //手机
//                'ProvinceName'=> '河南省', //收件省
//                'CityName'=> '洛阳市', //收件市
//                'ExpAreaName'=>'孟津县',  //收件区/县
//                'Address'=>'河南省洛阳市孟津县横水镇', //收件人详细地址
//            ],
//        ];
//
//        $this->AppKey = $config['APIkey'];
//        $result =  $kdService->sendPost();
//
//
//    }




    public function subscribe($code, $shipper='', $token='')
    {
        if( !$shipper ) {
            $shippers = $this->shipper($code);
            if( !$shippers ) {
                return false;
            }
            $shipper = $shippers[0]['ShipperCode'];
        }
        $config = config('kdniao');
        $requestData= "{'CallBack':'{$token}','ShipperCode':'{$shipper}','LogisticCode':'{$code}'}";
        $datas = array(
            'EBusinessID' => $config['EBusinessID'],
            'RequestType' => '1008',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $config['APIkey']);
        $json = (new KdniaoService())->sendPost('http://api.kdniao.cc/api/dist',$datas);
        $json = json_decode($json, true);
        return $this->resultHandle($json && $json['Success']==true);
    }

    private function encrypt($data, $appkey)
    {
        return urlencode(base64_encode(md5($data.$appkey)));
    }



    //物流签收
    private function operationBuildingOrder($LogisticCode)
    {
        $data = BuildingOrderDetail::get([ 'logistics'=> $LogisticCode] );
        if( $data ){

            Db::startTrans();
            try{
                UserNotices::create([
                    'user_id'=> $data['uid'],
                    'topic'=> '签收通知',
                    'content'=> '您的宝贝'.$data['g_name'].'已经送达，祝您购物愉快！！',
                ]);
                $data->status = BuildingOrderStatus::SIGN;
                $data->save();
                Db::commit();
            }catch (\Exception $e)
            {
                Db::rollback();
                Log::log('修改状态错误 具体'.$e->getMessage());
            }

        }
        return true;
    }


}