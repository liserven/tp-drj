<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/5/23
 * Time: 10:16
 */

namespace app\api\controller\v1;


use app\common\service\ImServer;

class Im extends Base
{

    //注册用户
    public function register()
    {
        return (new ImServer())->register();
    }
}