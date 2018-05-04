<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 11:29
 */

namespace app\index\controller;


class Zfb extends BaseController
{


    public function index(){
        return $this->fetch();
    }
}