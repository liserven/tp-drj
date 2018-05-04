<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\BuildingOrderDetail;

class Orbuilding extends Base
{

    public function tolist(){
        $page  = BuildingOrderDetail::getBuildPage();


        $this->assign('page',$page);

        return $this->fetch();
    }

    public function logistics(){
        return view();
    }
}