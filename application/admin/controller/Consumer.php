<?php

namespace app\admin\controller;

class Consumer extends Base{
    public function tolist(){
        $list = db('user_data')->where('type',1)->select();
        $this->assign('page',$list);
        return $this->fetch();
    }
    public function lookup(){
        $phone = input('phone');
        $list = db('user_data')->where('ud_phone',$phone)->select();
        return view();


    }

    public function editstatus(){
        $id = input('id');
        $status = input('state');
        if($status == 1){
        $list = db('user_data')->where('ud_id',$id)->setField('status',1);
        }else{
        $list = db('user_data')->where('ud_id',$id)->setField('status',2);
        }
        return $this->resultHandle($list);

    }
}