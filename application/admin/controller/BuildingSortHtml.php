<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/18
 * Time: 18:15
 */

namespace app\admin\controller;


class BuildingSortHtml extends Base
{


    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }




    public function getHtml($sort_name)
    {
        return view($sort_name);
    }
}