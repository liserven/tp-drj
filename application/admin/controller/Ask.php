<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

class Ask extends Base{
    public function tolist(){
        $asklist = db('opinion_back')->order('id','desc')->select();
        $this->assign('page', $asklist);
        return $this->fetch();
    }

}