<?php
namespace app\admin\controller;

use app\common\lib\Upload;

class Gettoken extends Base
{
    
    
    public function getQiNiuToken()
    {
        $token = Upload::getToken();
        return json([ 'uptoken'=>$token ]);
    }
}

