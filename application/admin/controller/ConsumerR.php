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
       $list = db('grab_red')->paginate('15')->each(function($item,$key){
           if(is_array($item) && !empty($item)){
               $page = db('user_data')->where('ud_id',$item['partner_id'])->find();
               $item['partner_id'] = $page['ud_name'];
              return $item;

           }


       });


      $this->assign('page',$list);
        return view();
    }
}