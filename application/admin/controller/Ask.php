<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use think\Db;

class Ask extends Base{
    public function tolist(){
        $asklist = Db::table('opinion_back')->order('id','desc')->paginate('15');
        $this->assign('page', $asklist);
        return $this->fetch();
    }

}