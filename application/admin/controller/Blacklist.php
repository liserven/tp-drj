<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/28
 * Time: 16:40
 */

namespace app\admin\controller;


use app\common\validate\IDMustBePositiveInt;
use think\Db;

class Blacklist  extends Base
{
    public function tolist(){
        $page = Db::table('user_data')->where('type=2 AND status=2')->paginate('10');

        $this->assign('page',$page);
        return $this->fetch();
    }

    public function black($id){
        (new IDMustBePositiveInt())->goCheck();

        $list = db('user_data')->where('ud_id',$id)->setField('status',1);

        return $this->resultHandle($list);
    }

    public function doDel($id)
    {
        $page = Db::table('user_data')->where('ud_id',$id)->delete();
        return $this->resultHandle($page);
    }
}