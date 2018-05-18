<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9
 * Time: 9:31
 */

namespace app\common\controller;


use app\lib\exception\ContentException;
use app\lib\exception\ProbihitException;
use think\Controller;

/**
 * 所有控制公共继承基类
 * Class CommonController
 * @package app\common\controller
 */

class CommonController extends Controller
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->assign('mName',$this->request->module());
        $this->assign('cName',$this->request->controller());
        $this->assign('aName',$this->request->action());
        $this->assign('menu', config('menu'));
    }


    //验证敏感字符
    public function checkProbihit( $str = '' )
    {
        if( strlen($str) <= 0 )
        {
            throw new ContentException();
        }
        $str = checkProhibit($str);
        if( isset($str['bol']) )
        {
            throw new ProbihitException([ 'msg'=>$str['msg'], 'code'=>200 ]);
        }
        return $str;
    }





}