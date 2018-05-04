<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 8:56
 */

namespace app\admin\controller;

use app\common\validate\Find;


class Cigdp extends Base{
    public function tolist(){
          $omlist = db('city_gdp')->select();
          $this->assign('page',$omlist);
          return $this->fetch();
    }

}

