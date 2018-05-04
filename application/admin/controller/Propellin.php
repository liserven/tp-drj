<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/20
 * Time: 11:23
 */

namespace app\admin\controller;

use app\common\model\Propeling;

class Propellin extends Base
{
    public function tolist(){
       $list = Propeling::getPropelPage();
       $this->assign('page',$list);
       return view();
    }
}