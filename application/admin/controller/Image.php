<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 18:33
 */

namespace app\admin\controller;


use app\common\lib\Upload;

class Image extends Base
{
    public function uploadImg()
    {
        $str = Upload::image();
        return json(['str'=>$str]);
    }
}