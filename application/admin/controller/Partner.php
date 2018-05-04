<?php


namespace app\admin\controller;


use app\common\model\Parther;

use app\common\model\PartnerAudit;
use app\common\service\AlipayServer;
use app\common\validate\IDMustBePositiveInt;
class Partner extends Base
{

    public function tolist()
    {
        $page = PartnerAudit::getPartnerPage();

        $this->assign('page', $page);

        return $this->fetch();
    }

    public function aliPayFind($trade_no)
    {
        $aliService = new AlipayServer();
        $result = $aliService->tradeQuery($trade_no);

        if (!$result) {
            $data = [];
        } else {
            $data = [
                'total' => $result->total_amount,
                'phone' => $result->buyer_logon_id,
                'user_zfb_no' => $result->buyer_user_id,
                'order_no' => $result->out_trade_no,
                'pay_time' => $result->send_pay_date,
                'pay_status' => $result->trade_status,
                'zfb_order_no' => $result->trade_no,
            ];
        }
        $this->assign('data', $data);
        return $this->fetch();
    }



    public function aggry($id){
        (new IDMustBePositiveInt())->goCheck();

        $list = db('user_data')->where('ud_id',$id)->setField('type',2);

        return $this->resultHandle($list);
    }

}


