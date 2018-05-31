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
        $name  = input('get.name');
        $where = [];
        if(!empty($name)){
            $data = db('user_data')->where('ud_name',$name)->find();
            $where['user_id'] = $data['ud_id'];
        }

        $list = db('give_red')->where($where)->order('id','DESC')->paginate('15')->each(function($item, $key){
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