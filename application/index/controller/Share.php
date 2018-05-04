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
use enum\VillaImageType;
use app\common\service\PartnerService;
use enum\PartnerUserStatus;

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
}