<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\BuildingOrderDetail;
use think\Db;


class Orbuilding extends Base
{

    public function tolist(){
        $page  = BuildingOrderDetail::getBuildPage();


        $this->assign('page',$page);

        return $this->fetch();
    }

    public function logistics($id){

        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }

             dd($id);exit;
             $a    = input('logistics');
             $b = input('inflow');
             $result = db('building_order_detail')->where('id',$id)->update(['logistics' => $a,'express_code'=>$b]);

             return $this->resultHandle($result);

        }else{

             $id = $id;
             $id = explode('id',$id);
             var_dump($id);exit;
             $page = Db::table('express_code')->select();
             $this->assign([
                 'page' => $page,
                  'id'  => $id
             ]);

             $this->display();
        }
    }
}