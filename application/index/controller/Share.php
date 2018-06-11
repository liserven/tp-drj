<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 17:30
 */

namespace app\index\controller;

use app\common\model\BuildingDetails;
use app\common\model\VillaData;
use app\common\model\VillaImg;
use app\common\validate\IDMustBePositiveInt;
use enum\VillaImageType;
use app\common\service\PartnerService;
use enum\PartnerUserStatus;
use think\Db;

class Share extends BaseController
{


    public function index($id)
    {
        $data = BuildingDetails::getBuildingDetailById([ 'id'=> $id]);
        $this->assign('data', $data);
        return $this->fetch();
    }


    public function card($id)
    {
        $userId = !empty($id) ? $id : $this->user['ud_id'];
        $partner_data = (new PartnerService($userId))->getPartnerInfo($userId);
        $star = db('partner_star')->where([ 'pid'=> $userId])->avg('star');
        $partner_data['star'] = $star <= 0 ? 5 : $star;
        $partner_data['deal'] = db('partner_user')->where([ 'pu_partner_id'=>$userId, 'status'=> PartnerUserStatus::SIGN])->count();
        $partner_data['comm'] = 999;
        $this->assign('data', $partner_data);
        return $this->fetch();
    }

    public function home($id)
    {
        $data = VillaData::getFind($id);
        $wg = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::WG]);
        $sn = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::SN]);
        $xj = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::XJ]);
        $jg = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::JG]);
        $mj = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::MJ]);
        $data['wg'] = !empty($wg) ? $wg : [];
        $data['sn'] = !empty($sn) ? $sn : [];
        $data['xj'] = !empty($xj) ? $xj : [];
        $data['jg'] = !empty($jg) ? $jg : [];
        $data['mj'] = !empty($mj) ? $mj : [];
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function redpacket($id){
        (new IDMustBePositiveInt())->goCheck();
        $data = Db::table('give_red')->where(['id'=> $id])
            ->alias('gr')
            ->join('__USER_DATA__ ud', 'ud.ud_id=gr.user_id', 'left')
            ->field('ud.ud_sex, ud.ud_name,gr.total,ud.ud_logo,gr.id, ud.ud_phone, gr.create_at, gr.word,gr.num')
            ->find();
        $grab = Db::table('grab_red')->where([ 'rid'=> $data['id']])->order('id desc')->select();
        if( !empty($grab) )
        {
            foreach ($grab as &$val)
            {
                $user = Db::table('user_data')->where([ 'ud_phone'=> $val['phone'] ])->find();
                if( !empty($user) )
                {
                    $val['ud_name'] = $user['ud_name'];
                    $val['ud_logo'] = $user['ud_logo'];
                }
                else{
                    $val['ud_name'] = '定荣'.rand(1000,9999);
                    $val['ud_logo'] = '/Js/index/src/image/default_logo.png';
                }
            }
        }
        $this->assign('grab', $grab);
        $this->assign('data', $data);
        return $this->fetch();
    }
    public function swoole()
    {
        return $this->fetch();
    }


}