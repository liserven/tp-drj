<?php

namespace app\admin\controller;

use app\common\model\UserData;
use app\common\validate\IDMustBePositiveInt;
use custom\CusLog;
use think\Db;
use think\Exception;

class Consumer extends Base{

    //获取用户列表
    public function tolist(){
        $phone = input('get.phone');
        $name  = input('get.name');
        $where = [
            'type' => 1,
        ];
        if (!empty($phone)) {
            $where['ud_phone'] = $phone;
        }
        if (!empty($name)) {
            $where['ud_name'] = $name;
        }
        $list = db('user_data')->where($where)->paginate('15');
        $this->assign('page',$list);
        return $this->fetch();
    }

    //查找

    //用户禁用
    public function forbidden($id){
        (new IDMustBePositiveInt())->goCheck();

        try{
            $list = db('user_data')->where('ud_id',$id)->setField('status','2');
        }catch (Exception $e){
            return $e->getMessage();
        }
        return $this->resultHandle($list);

    }

    //取消禁用
    public function forbiddenr($id){
        (new IDMustBePositiveInt())->goCheck();

        try{
            $list = db('user_data')->where('ud_id',$id)->setField('status','1');
        }catch (Exception $e){
            return $e->getMessage();
        }
        return $this->resultHandle($list);

    }

    //用户删除
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

    //用户详细信息

    public function getUserAddress(){
       $id = input('get.id');
       $data = Db::table('user_delivery')->where('uid',$id)->select();
       $this->assign('data',$data);
       return $this->fetch();
    }
}