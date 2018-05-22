<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\VillaData;
use app\common\model\VillaCustomer;
use app\common\model\VillaImg;
use app\common\validate\IDMustBePositiveInt;
use custom\CusLog;
use think\Db;

class villa extends Base
{

    public function tolist(){
        //别墅列表
        $page = Db::table('villa_data')->where('status','1')->order('id','DESC')->paginate('15');

        $this->assign('page',$page);

        return $this->fetch();
    }
    public function doadd(){
        if($this->request->isPost())
        { if (!$this->_checkAction()) {
            return $this->ajaxShow(false, '无权此操作');
        }

            $data['vd_name']            = input('vd_name');//别墅名称
            $data['vd_price']           = input('vd_price');//别墅价格
            $data['vd_unit_price']      = input('vd_unit_price');//单位价格
            $data['vd_covers_area']     = input('vd_covers_area');//占地面积
            $data['vd_building_area']   = input('vd_building_area');//建筑面积
            $data['vd_height']          = input('vd_height');//层高
            $data['vd_door']            = input('vd_door');//门
            $data['vd_wq']              = input('vd_wq');//外墙
            $data['vd_wmw']             = input('vd_wmw');//外墙
            $data['room']               = input('room');//室
            $data['wei']                = input('wei');//卫
            $data['office']             = input('office');//厅
            $data['vd_class']           = input('vd_class');//一级分类
            $data['vd_class_r']         = input('vd_class_r');//二级分类
            $data['vd_logo']            = input('vd_logo');//缩略图
            $data['vd_windows']         = input('vd_windows');//窗户
            $data['is_index']           = input('is_index');//是否推荐首页
            $data['is_banner']          = input('is_banner');//是否推荐首页
            $Deploy                     = input('like/a');
            $lb                         = input('lb-input/a');
            $wg                         = input('wg-input/a');

            $jg                         = input('jg-input/a');
            $mj                         = input('mj-input/a');
            $xj                         = input('xj-input/a');
            $sn                         = input('sn-input/a');
            $page['img']                = input('banner');
            //开启事物
            try{
                $reuslt = VillaData::create($data);
                if(!empty($page['img'])){
                    $page['gid'] = $reuslt['id'];
                    $page['type'] = 3;
                    $res = Db::table('banner')->insert($page);
                }

                 $deplData = [];
                 $imgData = [];
                 $imgDatab = [];
                 $imgDatac = [];
                 $imgDatad = [];
                 $imgDataa = [];
                 $imgDatae = [];
                //遍历别墅外观图
                if(is_array($wg) && !empty($wg)) {
                    foreach ($wg as $k => $v) {

                        $imgData[$k]['vi_villa_id'] = $reuslt['id'];
                        $imgData[$k]['img'] = $v;
                        $imgData[$k]['type'] = 1;


                    }
                }
               //遍历别墅景观图
                if(is_array($jg) && !empty($jg)) {
                    foreach ($jg as $k => $v) {
                        $imgDataa[$k]['vi_villa_id'] = $reuslt['id'];
                        $imgDataa[$k]['img'] = $v;
                        $imgDataa[$k]['type'] = 4;

                    }
                }
                //遍历别墅面积图
                if(is_array($mj) && !empty($jg)) {
                    foreach ($mj as $k => $val) {
                        $imgDatab[$k]['vi_villa_id'] = $reuslt['id'];
                        $imgDatab[$k]['img'] = $val;
                        $imgDatab[$k]['type'] = 5;

                    }
                }

                //遍历别墅细节图
                if(is_array($xj) && !empty($jg)) {
                    foreach ($xj as $k => $val) {
                        $imgDatac[$k]['vi_villa_id'] = $reuslt['id'];
                        $imgDatac[$k]['img'] = $val;
                        $imgDatac[$k]['type'] = 3;

                    }
                }
                //遍历别墅室内图
                if(is_array($sn) && !empty($jg)) {
                    foreach ($sn as $k => $val) {
                        $imgDatad[$k]['vi_villa_id'] = $reuslt['id'];
                        $imgDatad[$k]['img'] = $val;
                        $imgDatad[$k]['type'] = 2;

                    }
                }
                //遍历别墅轮播图
                if(is_array($lb) && !empty($jg)) {
                    foreach ($lb as $k => $val) {
                        $imgDatae[$k]['vi_villa_id'] = $reuslt['id'];
                        $imgDatae[$k]['img'] = $val;
                        $imgDatae[$k]['type'] = 6;

                    }
                }

                //合并别墅图片数组
                $imgData=array_merge_recursive($imgData,$imgDataa,$imgDatab,$imgDatac,$imgDatad,$imgDatae);
                //遍历别墅售后服务
                if(is_array($Deploy) && !empty($Deploy)) {
                    foreach ($Deploy as $k => $val) {
                        $deplData[$k]['vid']           = $reuslt['id'];
                        $list = db('deploy')->where('id',$val)->find();
                        $deplData[$k]['cus_name']         = $list['name'];

                        $deplData[$k]['img']           = $list['img'];
                    }
                }


                (new VillaCustomer())->saveAll($deplData);

                (new VillaImg())->saveAll($imgData);


                return $this->resultHandle($reuslt);


            }catch (\Exception $e){
                Db::rollback();
                return show(false, $e->getMessage() );
            }
        }else{
            $data  = db('deploy')->where('type','1')->select();
            $this->assign('data',$data);
            return view();
        }
    }

    public function order(){
        $buildinglist = db('building_order')->select();
        $this->assign('page', $buildinglist);
        return $this->fetch();
    }
    //别墅删除
    public function doDel( $id )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $data = VillaData::get([ 'id'=>$id ]);
        if( !$data )
        {
            throw new ParameterException();
        }
        Db::startTrans();
        try{
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">'.$data->id.'</a>Banner');
            Db::commit();
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            Db::rollback();
            return show( false, $e->getMessage() );
        }
    }
    //别墅修改
    public function doEdit(){

        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $data['id']                 = input('post.id');

            $data['vd_name']            = input('vd_name');//别墅名称
            $data['vd_price']           = input('vd_price');//别墅价格
            $data['vd_unit_price']      = input('vd_unit_price');//单位价格
            $data['vd_covers_area']     = input('vd_covers_area');//占地面积
            $data['vd_building_area']   = input('vd_building_area');//建筑面积
            $data['vd_height']          = input('vd_height');//层高
            $data['vd_door']            = input('vd_door');//门
            $data['vd_wq']              = input('vd_wq');//外墙
            $data['vd_wmw']             = input('vd_wmw');//外墙
            $data['room']               = input('room');//室
            $data['wei']                = input('wei');//卫
            $data['office']             = input('office');//厅
            $data['vd_class']           = input('vd_class');//一级分类
            $data['vd_class_r']         = input('vd_class_r');//二级分类
            $data['vd_logo']            = input('post.logo');
            $data['vd_windows']         = input('vd_windows'); //窗户
            $Deploy                     = input('like/a');//售后
            $lb                         = input('lb-input/a');//列表图
            $wg                         = input('wg-input/a');//外观图

            $jg                         = input('jg-input/a');//景观图
            $mj                         = input('mj-input/a');//面积图
            $xj                         = input('xj-input/a');//细节图
            $sn                         = input('sn-input/a');//室内图

            try{
                $data = VillaData::update($data);

                Db::table('villa_img')->where(['vi_villa_id'=> $data['id']])->delete();//删除商品之前所存图片


                Db::table('villa_customer')->where(['vid'=> $data['id']])->delete();//删除商品之前所存售后
                $deplData = [];
                $imgData = [];
                $imgDatab = [];
                $imgDatac = [];
                $imgDatad = [];
                $imgDataa = [];
                $imgDatae = [];
                //遍历别墅外观图
                if(is_array($wg) && !empty($wg)) {
                    foreach ($wg as $k => $v) {

                        $imgData[$k]['vi_villa_id'] = $data['id'];
                        $imgData[$k]['img'] = $v;
                        $imgData[$k]['type'] = 1;


                    }
                }
                //遍历别墅景观图
                if(is_array($jg) && !empty($jg)) {
                    foreach ($jg as $k => $v) {
                        $imgDataa[$k]['vi_villa_id'] = $data['id'];
                        $imgDataa[$k]['img'] = $v;
                        $imgDataa[$k]['type'] = 4;

                    }
                }
                //遍历别墅面积图
                if(is_array($mj) && !empty($jg)) {
                    foreach ($mj as $k => $val) {
                        $imgDatab[$k]['vi_villa_id'] = $data['id'];
                        $imgDatab[$k]['img'] = $val;
                        $imgDatab[$k]['type'] = 5;

                    }
                }

                //遍历别墅细节图
                if(is_array($xj) && !empty($jg)) {
                    foreach ($xj as $k => $val) {
                        $imgDatac[$k]['vi_villa_id'] = $data['id'];
                        $imgDatac[$k]['img'] = $val;
                        $imgDatac[$k]['type'] = 3;

                    }
                }
                //遍历别墅室内图
                if(is_array($sn) && !empty($jg)) {
                    foreach ($sn as $k => $val) {
                        $imgDatad[$k]['vi_villa_id'] = $data['id'];
                        $imgDatad[$k]['img'] = $val;
                        $imgDatad[$k]['type'] = 2;

                    }
                }
                //遍历别墅轮播图
                if(is_array($lb) && !empty($jg)) {
                    foreach ($lb as $k => $val) {
                        $imgDatae[$k]['vi_villa_id'] = $data['id'];
                        $imgDatae[$k]['img'] = $val;
                        $imgDatae[$k]['type'] = 6;

                    }
                }

                //合并别墅图片数组
                $imgData=array_merge_recursive($imgData,$imgDataa,$imgDatab,$imgDatac,$imgDatad,$imgDatae);
                //遍历别墅售后服务
                if(is_array($Deploy) && !empty($Deploy)) {
                    foreach ($Deploy as $k => $val) {
                        $deplData[$k]['vid']           = $data['id'];
                        $list = db('deploy')->where('id',$val)->find();
                        $deplData[$k]['cus_name']         = $list['name'];

                        $deplData[$k]['img']           = $list['img'];
                    }
                }


                (new VillaCustomer())->saveAll($deplData);

                (new VillaImg())->saveAll($imgData);


                return $this->resultHandle($data);


            }catch (\Exception $e)
            {
                return show( false, $e->getMessage() );
            }
        } else {
            (new IDMustBePositiveInt())->goCheck();
            $id = input('id/d');

            $data = VillaData::get([ 'id'=> $id]);
            $img = Db::table('villa_img')->where(['vi_villa_id' => $id])->select(); //商品图片
            $depl = Db::table('deploy')->select(); //商品售后
            $depla = Db::table('villa_customer')->where('vid',$id)->select();



            $this->assign([
                'arr' => $data,
                'img' => $img,
                'data'=> $depl,
                'res' => $depla
            ]);
            return $this->fetch();
        }
    }

    public function doImgDel($id)
    {
        (new IDMustBePositiveInt())->goCheck();


        return $this->resultHandle(Db::table('villa_img')->where(['vi_villa_id' => $id])->delete());


    }
    public function lookup(){
        $name = input('name');
        $list = db('villa_data')->where('vd_name',$name)->find();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //别墅下架
    public function unvilla(){
        $page = Db('villa_data')->where('status','2')->paginate('15');

        $this->assign('page',$page);
        return $this->fetch();
    }

    //下架
    public function changes($id){
        (new IDMustBePositiveInt())->goCheck();


        $page = db('villa_data')->where('id',$id)->setField('status','2');
        return $this->resultHandle($page);
    }


    //上架
    public function regain($id){
        (new IDMustBePositiveInt())->goCheck();


        $page = db('villa_data')->where('id',$id)->setField('status','1');
        return $this->resultHandle($page);
    }



}
