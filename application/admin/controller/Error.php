<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/3/16
 * Time: 17:21
 */

namespace app\admin\controller;


use think\Controller;

class Error extends Controller
{

    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

    }


    public function invalid()
    {
        return $this->fetch();
    }
}