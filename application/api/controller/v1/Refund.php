<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 16:34
 */

namespace app\api\controller\v1;


use app\common\service\PayService;

class Refund extends Base
{




    //微信退款
    public function wxRefund(){
        $server = New PayService();
        if($server->payRefund()){
            dd('成功');
        }
    }
}