<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/5/17
 * Time: 16:39
 */

namespace app\index\controller;


use app\common\service\SaberService;
use think\Controller;

class Swoole extends Controller
{
    public function index(){
        return (new SaberService())->sendWebSocket();
    }
}