<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 8:56
 */

namespace app\admin\controller;

use app\common\validate\Find;


class Omgdp extends Base{
    public function tolist(){
        $omgdplist  = db('omit_gdp')->order('gdp','desc')->select();
        $this->assign('page',$omgdplist);
        return $this->fetch();
    }
}

