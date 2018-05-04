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
          $userlist = db('give_red')->order('id','desc')->select();
          $this -> assign('page',$userlist);
          return $this -> fetch();
    }
}