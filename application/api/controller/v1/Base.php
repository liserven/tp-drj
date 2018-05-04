<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 18:48
 */

namespace app\api\controller\v1;


use app\common\service\Token;
use app\common\validate\IDMustBePositiveInt;
use think\Controller;

class Base extends Controller
{
    protected $user = []; //当前用户信息

    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    //不限制身份，只需要登录即可验证
    protected function checkLogin()
    {
        $this->user = Token::getCurrentIdentity();
    }

    //验证用户权限
    protected function checkUserScope()
    {
        Token::needExclusiveScope();
        $this->user = Token::getCurrentIdentity();
    }
    //验证合伙人权限
    protected function checkPartner()
    {
        Token::needSuperScope();
        $this->user = Token::getCurrentIdentity();
    }

    //验证id参数必须
    protected function checkIDMustBePositiveInt()
    {
        (new IDMustBePositiveInt())->goCheck();
    }

//是否登录
    protected function checkLogins()
    {
        if( $this->request->header('token'))
        {
            $this->user = Token::getCurrentIdentity();
        }
    }

    protected function resultHandle($result, $errCode = 90004)
    {
        if( !empty($result) ){
            return show(true, 'ok');
        }
        else{
            return show(false, 'err', [], $errCode);
        }
    }


    protected function getLimit()
    {
        $limit = input('limit') ? input('limit') : 10;
        return $limit;
    }
}