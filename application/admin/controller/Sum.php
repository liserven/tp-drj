<?php

namespace app\admin\controller;
use app\common\model\BargainSte;
use app\common\model\DUtyModular;
use app\common\model\InformationSort;
use app\common\validate\IDMustBePositiveInt;


class Sum extends Base{
    public function tolist(){
        $sumlist  = db('bargain_ste')->find();

        $this -> assign('page',$sumlist);
        return $this->fetch();
    }
    public function doEdit(){
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $id                    = input('id');
            $data['red_set']       = input('red_set');
            $data['partner_money'] = input('partner_money');
            $data['bargain_set']   = input('bargain_set');
            $data['bargain_num']   = input('bargain_num');


            try{
                $result = db('bargain_ste')->where('id',$id)->update($data);
                return $this->resultHandle($result);




            }catch (\Exception $e)
            {
                return show( false, $e->getMessage() );
            }
        } else {
            (new IDMustBePositiveInt())->goCheck();
            $data = BargainSte::get([ 'id'=> input('id/d')]);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }
}
