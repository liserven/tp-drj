<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\GrabRed;
use think\Db;

class ConsumerR extends Base{
    public function tolist(){
       $list = db('grab_red')->select();

       foreach ($list as $k=>$val){
           $page = db('user_data')->where('ud_id',$val['partner_id'])->find();
           $list[$k]['partner_id'] = $page['ud_name'];
       }
      $this->assign('page',$list);
        return view();
    }
}