<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;

use app\common\lib\Upload;

/**
 * Description of Api
 *
 * @author Administrator
 */
class Api extends Base {
    //put your code here
    protected function _initialize() {
        parent::_initialize();
    }
    
    //上传图片接口
    public function uploadImg()
    {   
        $src = Upload::image();
        if($src)
        {
            $data = [
                'code' => 0,
                'msg' => '上传成功',
                'data' => [
                    'src' => $src
                ]
            ];
            return json($data);
        }
    }
}
