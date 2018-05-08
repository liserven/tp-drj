<?php

namespace app\admin\controller;

use app\common\model\UserData;
use app\common\validate\IDMustBePositiveInt;
use custom\CusLog;
use think\Db;
class Consumer extends Base{
    public function tolist(){
        $list = db('user_data')->where('type',1)->paginate(15);
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
    public function doDel($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = UserData::get(['ud_id' => $id]);
        if (!$data) {
            throw new ParameterException();
        }
        Db::startTrans();
        try {
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">' . $data->ud_id . '</a>');
            Db::commit();
            return $this->resultHandle($result);
        } catch (\Exception $e) {
            Db::rollback();
            return show(false, $e->getMessage());
        }
    }

}