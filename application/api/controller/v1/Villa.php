<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 18:53
 */

namespace app\api\controller\v1;

use app\common\model\VillaData as VillaModel;
use app\common\model\VillaData;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use app\common\model\VillaImg;
use app\lib\exception\VillaException;
use enum\VillaImageType;
use enum\PartnerUserStatus;
use app\common\model\VillaCollection;

/**
 * Class Villa
 * @package app\api\controller\v1
 * 别墅控制器
 */
class Villa extends Base
{

    protected $beforeActionList = [
        'checkLogin' => [ 'only' => 'villaCollection' ],
    ];

    //获取别墅列表
    // url：  /api/v1/villas
    public function getVillas(){
        //组织查询条件
        $where=[];  //查找条件
        $wei = input('get.wei'); //卫生间个数
        $office = input('get.office'); //厅的个数
        $room = input('get.room'); //室的个数
        $layer  = input('get.layer'); // 层数
        $order = input('order');
        $class = input('class_b');
        $class_r = input('class_r');
        $order = $order ? $order : 'zh';
        if( !empty($wei) ) $where['wei'] = $wei;
        if( !empty($class) ) $where['vd_class'] = $class;
        if( !empty($class_r) ) $where['vd_class_r'] = $class_r;
        if( !empty($office) ) $where['office'] = $office;
        if( !empty($room) ) $where['room'] = $room;
        if( !empty($layer) ) $where['vd_height'] = $layer;

        $limit = input('limit');
        $limit = $limit ? $limit : 20;
        $villas = VillaModel::getVillaPage($where, $limit, $order);

        if( $villas->isEmpty() ){
            throw new ParameterException([
                'msg' => '暂无别墅数据'
            ]);
        };
        return show( true, 'ok', $villas);
    }

    //获取别墅详情
    /**
     * @param $id  别墅id
     * @throws ParameterException 无数据异常抛出
     * @url api/v1/villa_detail
     */
    public function getVillaData($id)
    {
        //验证数据  id参数必须
        (new IDMustBePositiveInt())->goCheck();
        $data = VillaModel::getFind($id);
        $wg = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::WG]);
        $sn = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::SN]);
        $xj = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::XJ]);
        $jg = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::JG]);
        $mj = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> VillaImageType::MJ]);
        $lb = VillaImg::all([ 'vi_villa_id'=>$id,'type'=> 6]);
        $this->checkLogins();
        $have_partner = false;
        if( empty($this->user))
        {
            //如果为空说明未登录
            $is_collection = 2;
        }
        else{
            //说明登录
            $partner_user = db('partner_user')->where(['pu_user_id'=> $this->user['ud_id'], 'status'=>PartnerUserStatus::BINDING ])->find();
            if( $partner_user )
            {
                $have_partner = true;
                $partner_phone = db('user_data')->where(['ud_id'=> $partner_user['pu_partner_id'], 'type'=> 2 ])->field('ud_phone')->find();
                $data['partner_phone'] = $partner_phone['ud_phone'];
            }
            $collection = db('villa_collection')->where([ 'vc_user_id'=> $this->user['ud_id'], 'vc_villa_id'=> $data['id']])->find();
            $is_collection = empty($collection) ? 2 : 1;
        }
        $data['have_partner'] = $have_partner;
        $data['is_collection'] = $is_collection;
        $data['deploy'] = db('villa_customer')->where(['vid'=> $data['id']])
            ->field('id, cus_name, img')->select();
        $data['share_url'] = config('app.root_url').'/share/home?id='.$data['id'];
        $data['wg'] = !empty($wg) ? $wg : [];
        $data['sn'] = !empty($sn) ? $sn : [];
        $data['xj'] = !empty($xj) ? $xj : [];
        $data['jg'] = !empty($jg) ? $jg : [];
        $data['mj'] = !empty($mj) ? $mj : [];
        $data['lb'] = !empty($lb) ? $lb : [];
        return show(true , '' , $data);

    }



    public function villaCollection($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $where = [ 'vc_villa_id'=> $id, 'vc_user_id'=> $this->user['ud_id']];
        if( !VillaData::get($id))
        {
            throw new VillaException();
        }


        $isCheckCollection = VillaCollection::get($where);
        if($isCheckCollection )
        {
            //如果已经收藏 选择删除该收藏
            $isCheckCollection->delete();
            $resultData['isCollection'] = 1; //如果返回是1 说明是取消收藏
        }
        else{
            $resultData = VillaCollection::create($where);
            $resultData['isCollection'] = 2; //如果是2，说明是添加收藏成功
        }
        return show(true, 'ok', $resultData);

    }
}