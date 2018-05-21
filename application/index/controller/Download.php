<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/5/18
 * Time: 18:55
 */

namespace app\index\controller;


use think\Controller;

class Download extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}