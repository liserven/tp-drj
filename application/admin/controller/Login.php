<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 9:56
 */

namespace app\admin\controller;

use app\common\model\Member as MemberModel;
use custom\CusLog;
use think\Session;

/**
 * Class Login
 * @package app\admin\controller
 * 登录控制器
 */
class Login extends Base
{

    protected $beforeActionList = [];

    protected function _initialize()
    {
        $this->assign('mName', $this->request->module());
        $this->assign('cName', $this->request->controller());
        $this->assign('aName', $this->request->action());
    }

    //登录页面
    public function index()
    {

        //返回模板
        return $this->fetch();
    }


    //登录方法
    public function login()
    {
        $phone = input('phone');
        $am_password = input('password');
        $captcha = input('captcha');
        if (captcha_check($captcha)) {
            $memberRs = MemberModel::getMemberByPhone($phone);
            if ($memberRs) {
                if ($memberRs->am_status == 2) {
                    return $this->ajaxShow(false, '该用户已经被禁用。');
                }
                if ($memberRs['am_password'] == md5($am_password)) {
                    CusLog::writeLog($memberRs->am_id, '登录后台');
                    session('User', $memberRs);
                    $data['am_ssid'] = session_id();
                    $data['am_pre_time'] = time();
                    $data['am_id'] = $memberRs->am_id;
                    MemberModel::update($data);
                    session('User.ssid', session_id());

                    return $this->ajaxShow(true, '登录成功', [ 'url'=> url('admin/Index/index')]);
                } else {
                    return $this->ajaxShow(false, '密码错误');
                }
            } else {
                return $this->ajaxShow(false, '管理员不存在');
            }

        } else {
            return $this->ajaxShow(false, '验证码错误');
        }
    }


    public function loginOut()
    {
        $User = $this->_checkLogin();
        if (!empty($User)) {
            Session::delete('User');
            session_destroy();
            CusLog::writeLog($User['am_id'], '退出后台');
            $this->success('退出成功,请重新登录', 'admin/Login/sign');
        }
    }


}