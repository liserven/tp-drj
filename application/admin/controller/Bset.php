<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\BuildingDetailsSet;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use custom\CusLog;
use think\Db;


class Bset extends Base{


    public function doAdd()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $gid = input('province');

            $data = input('name/a');
            try {
                if (is_array($data) && !empty($data)) {
                    $resData = [];
                    foreach ($data as $k => $val) {
                       $resData[$k]['name'] = $val;
                       $resData[$k]['clumr_id'] = $gid;


                    }


                }
                (new BuildingDetailsSet())->saveAll($resData);
                return $this->resultHandle($resData);
            }catch(\Exception $e){
                return show( false, $e->getMessage() );
            }

        }else{

            $province = db('building_column')->where('pid','>','0')->select();
            $this->assign([
                'province' => $province,
            ]);
            return view();
        }
    }

    public function tolist(){
        $page = BuildingDetailsSet::getBuildingPage();
        $this->assign('page',$page);
        return $this->fetch();
    }

    public function doDel( $id )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $data = BuildingDetailsSet::get([ 'id'=>$id ]);
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


    public function doedit(){
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $data['id']      = input('id');
            $data['clum_id'] = input('province');
            $data['name']    = input('name');



            try{
                $result = BuildingDetailsSet::create($data);
                return $this->resultHandle($result);

            }catch (\Exception $e)
            {
                return show( false, $e->getMessage() );
            }
        } else {
            (new IDMustBePositiveInt())->goCheck();
            $province = db('building_column')->where('pid', 0)->select();
            $this->assign([
                'province' => $province,
            ]);
            $data = BuildingDetailsSet::find([ 'id'=> input('id/d')]);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }
}