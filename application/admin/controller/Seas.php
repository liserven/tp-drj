<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 8:56
 */

namespace app\admin\controller;


use app\common\model\Seas as SeasModel;
use app\common\validate\Find;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use custom\CusLog;
use think\Db;

class Seas extends Base
{


    public function toList()
    {
        $seaslist = Db::table('seas')->paginate('15')->each(function($item,$key){
            if(is_array($item) && !empty($item)){
                $list = db('user_data')->where('ud_id',$item['uid'])->find();
                $item['uid'] = $list['ud_name'];
                return $item;


            }



        });


        $this->assign('page', $seaslist);
        return $this->fetch();
    }

    public function doDel($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = SeasModel::get(['id' => $id]);
        if (!$data) {
            throw new ParameterException();
        }
        Db::startTrans();
        try {
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">' . $data->id . '</a>Banner');
            Db::commit();
            return $this->resultHandle($result);
        } catch (\Exception $e) {
            Db::rollback();
            return show(false, $e->getMessage());
        }
    }

    public function doadd(){
        if ($this->request->isPost()){
            $phone = input('phone');
            $list = db('user_data')->where('ud_phone', $phone)->find();

            if (!$list) {
                return show(false, '该用户未注册..');
            }else{
                $res = db('partner_user')->where('pu_user_id', $list['ud_id'])->find();
                if (!$res['status'] == 1) {
                    return show(false, '该用户已被绑定..');
            }else{
                    $data['uid'] = $list['ud_id'];
                    $data['phone'] = $phone;
                    $data['status'] = 0;
                    try {
                        $reuslt = Seas::create($data);
                        $this->resultHandle($reuslt);

                    } catch (\Exception $e) {
                        Db::rollback();
                        return show(false, $e->getMessage());

                    }
                }
               }

            }
        return view();
        }

}