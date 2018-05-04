<?php

/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;


class Bargain extends Base{


    public function tolist(){
         $bargainlist = db('bargain')->order('id','desc')->select();
         $this->assign('page',$bargainlist);
         return $this->fetch();
    }

}
