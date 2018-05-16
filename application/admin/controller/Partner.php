<?php


namespace app\admin\controller;


use app\common\model\Parther;

use app\common\model\PartnerAudit;
use app\common\service\AlipayServer;
use app\common\validate\IDMustBePositiveInt;
use think\Db;
use think\Exception;

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

        $page = db('partner_audit')->where('user_id',$id)->find();
        //更改状态

        try{
            $res = db('partner_audit')->where('user_id',$id)->setField('examine_status','1');
            $data = array(
                'type'=>'2',
                'ud_phone'=>$page['phone'],
                'ud_sex'=>$page['sex'],
                'province'=>$page['province'],
                'county'=>$page['county'],
                'town'=>$page['town'],
                'ud_address' => $page['address'],
                'ud_id_photo'=> $page['id_code_just'],
                'ud_id_photo_r'=> $page['id_code_back'],
                'ud_photo'=> $page['id_photo'],
                'wx_openid' => $page['prepay_id'],
                'referee'   => $page['referee'],
                'ud_status' => $page['type'],
                'ud_examine_status' => 1,
            );
            $list = db('user_data')->where('ud_id',$id)->setField($data);
            $messagelist['user_id'] = $id;
            $messagelist['topic']    = '审核通知';
            $messagelist['type']   = 1;
            $messagelist['content'] = '恭喜您审核通过';
            $page = Db::table('user_notices')->insert($messagelist);

            return $this->resultHandle($list);
        }catch (\Exception $e){
            return show( false, $e->getMessage());
        }


    }
    public function unaggry($id){
        $res = db('partner_audit')->where('user_id',$id)->setField('examine_status','2');

        $messagelist['user_id'] =   $id;
        $messagelist['topic']    = '审核通知';
        $messagelist['type']   = 1;
        $messagelist['content'] = '很遗憾，您的审核未通过，请核实个人资料';
        $page = Db::table('user_notices')->insert($messagelist);

        return $this->resultHandle($res);
    }

}


