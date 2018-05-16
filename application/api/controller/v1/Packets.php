<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/27
 * Time: 14:33
 */

namespace app\api\controller\v1;

use app\common\model\GiveRed;
use app\common\model\GrabRed;
use app\common\model\PacketsGive;
use app\common\model\UserData;
use app\common\service\PacketsServer;
use app\lib\exception\PacketsException;
use app\lib\exception\ParameterException;
use app\lib\exception\PartnerException;
use think\Db;

/**
 * Class Packets
 * @package app\api\controller\v1
 * 发布红包控制器
 *
 */
class Packets extends Base
{
    protected $beforeActionList = [
        //前置操作，验证用户权限，必须是合伙才有权限访问
        'checkPartner' => ['only' => 'launchPackets,partnerConfirmRed,findPartner'],
        //用户
        'checkUserScope' => ['only' => 'givePackets,getMyGiveRed,getMyReceiveRed,getUserPackets,redUse']
    ];

    //查看我领取的红包
    public function getUserPackets()
    {
        $data = GrabRed::getPage(['phone' => $this->user['ud_phone']]);
        foreach ($data as &$value) {
            $value['reds'] = GrabRed::where(['rid' => $value['id']])->count();
        }
        if ($data->isEmpty()) {
            throw new ParameterException([
                'msg' => '暂时没有数据了'
            ]);
        }
        return show(true, 'ok', $data);

    }

    //查询红包详情
    public function getPacketsDetailById($id)
    {
        $data = GrabRed::getPacketsByFind(['gr.id' => $id]);
        $data['reds'] = GrabRed::where(['rid' => $id])->count();
        $grab_reds = GrabRed::all(['rid' => $id]);
        $grabUsers = [];
        foreach ($grab_reds as $key => $val) {
            $user = Db::table('user_data')->where(['ud_phone' => $val['phone']])->field('ud_phone,ud_name, ud_sex, ud_logo')->find();
            if ($user) {
                $grabUsers[$key]['user_name'] = $user['ud_name'];
                $grabUsers[$key]['user_logo'] = $user['ud_logo'];
                $grabUsers[$key]['user_sex'] = $user['ud_sex'];
                $grabUsers[$key]['create_at'] = $val['create_at'];
                $grabUsers[$key]['solo'] = $data['solo'];
            } else {
                $grabUsers[$key]['user_name'] = '用户' . $val['phone'];
                $grabUsers[$key]['user_logo'] = "http://ozi65v7vu.bkt.clouddn.com/2018/04/da0a2201804181541372663.jpg";
                $grabUsers[$key]['user_sex'] = 1;
                $grabUsers[$key]['create_at'] = $val['create_at'];
                $grabUsers[$key]['solo'] = $data['solo'];
            }
        }
        $data['reds_users'] = $grabUsers;
        return show(true, 'ok', $data);
    }

    //发起红包
    public function launchPackets()
    {
        $packetServer = new PacketsServer();
        return $this->resultHandle($packetServer->launchPacket($this->user['ud_id']));
    }

    //领取红包
    public function receivePackets()
    {
        $packetsServer = new PacketsServer();
        $phone = input('phone');
        if(!$phone)
        {
            $this->checkLogins();
            if( empty($this->user) )
            {
                throw new ParameterException([
                    'msg'=> '领取条件缺失'
                ]);
            }
            $phone = $this->user['ud_phone'];
        }
        $packetId = input('packet_id');
        return $this->resultHandle($packetsServer->receivePacket($phone, $packetId));
    }

    //赠送红包
    public function givePackets()
    {
        $packetsServer = new PacketsServer();
        $phone = input('phone');
        $packetID = input('packet_id');
        return $this->resultHandle($packetsServer->givePackets($phone, $packetID, $this->user['ud_phone']));
    }


    //查看我赠送出去的红包
    public function getMyGiveRed()
    {
        $reds = PacketsGive::all(['give_phone' => $this->user['ud_phone']]);
        if (empty($reds)) {
            throw new PacketsException();
        }
        return show(true, 'ok', $reds);
    }


    //查看我接受的红包
    public function getMyReceiveRed()
    {
        $reds = PacketsGive::all(['receive_phone' => $this->user['ud_phone']]);
        if (empty($reds)) {
            throw new PacketsException();
        }
        return show(true, 'ok', $reds);
    }

    //查询附近红包
    public function getPacketsByDz()
    {
        $city = input('city');
        $county = input('county');
        $users = UserData::all(['county' => $county, 'type' => 2]); //获取所有合伙人
        $ids = array_column(collection($users)->toArray(), 'ud_id');
        $ids = implode(',', $ids);
        $reds = GiveRed::getGiveRedByList([
            'gr.user_id' => ['in', $ids]
        ]);


        if ($reds->isEmpty()) {
            //如果县级没有
            $users = UserData::all(['city' => $city, 'type' => 2]); //获取所有合伙人
            $ids = array_column(collection($users)->toArray(), 'ud_id');
            $ids = implode(',', $ids);
            $reds = GiveRed::getGiveRedByList([
                'gr.user_id' => ['in', $ids]
            ]);
            if ($reds->isEmpty()) {
                throw new PacketsException();
            }
        }
        $reds = $reds->toArray();
        foreach ( $reds['data'] as $key=> &$val )
        {
            $val['create_at'] = date('Y-m-d', strtotime($val['create_at']));
        }
        return show(true, 'ok', $reds);

    }


    //合伙人查询自己发出的红包列表
    public function findPartner(){
        $limit = input('limit') ? input('limit') : 10;
        $lists = Db::table('give_red')->where([ 'user_id'=> $this->user['ud_id']])->order('id desc')->paginate($limit);
        if( $lists->isEmpty())
        {
            throw new PacketsException();
        }
        $lists = $lists->toArray();
        foreach ($lists['data'] as $key=>&$list)
        {
            $list['reds'] = Db::table('grab_red')->where([ 'rid'=> $list['id']])->count();
            $list['use'] = Db::table('grab_red')->where([ 'rid'=> $list['id'], 'status'=> 2])->count();
            $list['ud_name'] = $this->user['ud_name'];
            $list['create_at'] = date('Y-m-d', $list['create_at']);
            $list['ud_logo'] = $this->user['ud_logo'];
            $list['ud_sex'] = $this->user['ud_sex'];
            $list['ud_id'] = $this->user['ud_id'];
            $list['town'] = $this->user['town'];
        }
        return show( true, 'ok', $lists);
    }


    //使用红包发送指令
    public function redUse($red_id)
    {
        /*
         *
         * 查询当前用户是否领取该红包
         * 查看红包状态
         *
         */
        $grabRed = GrabRed::get(['phone' => $this->user['ud_phone'], 'rid' => $red_id]);

        if (!$grabRed) {
            throw new PacketsException([
                'msg' => '该红包不属于您'
            ]);
        }
        if ($grabRed['status'] == 2) {
            throw new PacketsException([
                'msg' => '该红包已经使用'
            ]);
        }
        //组合数据通知合伙人
        $noticeData = [
            'user_id' => $this->user['ud_id'],
            'red_id' => $grabRed['rid'],
            'partner_id'=> $grabRed['partner_id'],
        ];
        $redResult = Db::table('red_use')->insert($noticeData);
        if ($redResult) {
            return show(true, '等待合伙人确认');
        } else {
            return show(false, '发送失败');
        }
    }




    //合伙人使用红包
    public function partnerConfirmRed($id)
    {
        /**
         * 使用红包：
         * 该红包是否是当前合伙人发起
         * 是否已经使用
         */

        //查找红包信息
        $userId = input('post.user_id/d');
        $redUse = Db::table('red_use')->where(['red_id'=> $id, 'partner_id'=> $this->user['ud_id'], 'user_id'=> $userId])->find();
        $user = Db::table('user_data')->where(['ud_id'=> $redUse['user_id']])->find();
        $reds = Db::table('grab_red')->where(['phone'=> $user['ud_phone'],'rid'=> $id])->find();
        if( !$redUse )
        {
            throw new PartnerException([
                'msg'=> '没有关于该红包的使用信息'
            ]);
        }
        if( $reds['status'] == 2 )
        {
            throw new PartnerException([
                'msg'=> '该红包不能重复使用'
            ]);
        }
        Db::startTrans();
        try{
            Db::table('red_use')->where(['red_id'=> $id, 'partner_id'=> $this->user['ud_id']])->update([ 'status'=> 2]);
            Db::table('grab_red')->where(['phone'=> $user['ud_phone'],'rid'=> $id])->update([ 'status'=> 2]);
            Db::commit();
            return show(true, '使用成功');
        }catch (\Exception $e){
            Db::rollback();
            return show(true , $e->getMessage());
        }
    }
}