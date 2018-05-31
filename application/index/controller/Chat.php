<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/5/24
 * Time: 11:03
 */

namespace app\index\controller;


class Chat extends BaseController
{


    public function index()
    {
        return $this->fetch();
    }


    public function login()
    {
        return $this->fetch();
    }

    public function register()
    {
        return $this->fetch();
    }
}