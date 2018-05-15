<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/20
 * Time: 11:23
 */

namespace app\admin\controller;

use app\common\model\Propeling;
use think\Db;

class Propellin extends Base
{
    public function tolist(){
       $list = Propeling::getPropelPage();
       $this->assign('page',$list);
       return view();
    }


    public function doadd(){
        if($this->request->isPost()){

            $data['content']  =  strip_tags(input('editorValue'));
            $result =Propeling::create($data);
            return $this->resultHandle($result);
        }else{
            return view();
        }

    }
}