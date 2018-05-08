<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;


class UserR extends Base{
    public function tolist(){

        $list = db('give_red')->paginate('15')->each(function($item, $key){

            if(is_array($item) && !empty($item)) {


                    $page = db('user_data')->where('ud_id', $item['user_id'])->find();
                    $item['user_id'] = $page['ud_name'];
                    return $item;


            }
        });




        $this->assign('page',$list);
        return view();
    }
}