<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/13
 * Time: 10:11
 */

namespace app\common\service;


use app\common\model\Member;
use app\common\model\User;
use app\lib\exception\ParameterException;

class UserResetPass
{
    protected $uid; //管理员身份

    protected $data=[]; //组合完成的数据

    public function __construct($uid, $data=[] )
    {
        if( empty($uid) || empty($data) )
        {
            throw new ParameterException(['msg'=>'数据不能为空']);
        }
        $this->uid = $uid;
        $this->data = $data;
    }

    public function reset()
    {
        /**
         * 修改用户密码思路
         * 首先我我们要确定,是否选择了强制重置 选择了强制重置 就是说要是超级管理员才可以
         * 如果管理员选择了强制重置用户密码
         * 就要判断当前登录的管理员是否是超级管理员 如果不是抛出异常
         *
         * 如果用户没有选择强制修改
         * 那么就比对 原密码是否和数据库的密码是否匹配
         * 如果匹配修改密码 如果不匹配 返回错误
         */

        $result = $this->resetPass();
        return $result;
    }

    private function resetPass()
    {
        if( $this->data['isQiang'] == 2 ){
            //查看管理员是否强制
            //1 为强制 2为普通
            //如果是普通 比对密码
            $result = $this->getUserPass();
        }
        else{
            $result = $this->qiangUserPass();
        }
        return $result;
    }

    private function getUserPass()
    {
        $userData = User::get($this->data['id']);  //获取用户资料
        if( empty($userData) )
        {
            return show(false,'用户已经失踪了。。');
        }
        if( $userData['password'] != md5( $this->data['pass'] ) ){
            return show(false,'用户密码不正确。。');
        }
        $getResult = $this->updatePass();

        return $getResult;
    }

    private function updatePass()
    {
        $updateResult = User::update( [ 'au_id'=>$this->data['id'], 'au_password'=>md5($this->data['newpass']) ] );

        if( $updateResult )
        {
            return show(true,'修改成功');
        }
        else{
            return show(true,'修改失败');
        }
    }


    private function qiangUserPass()
    {
        //如果是强制  验证当前管理员是否是超级管理员
        $member = Member::get($this->uid);

        if( $member['am_issupre'] != 1 )
        {
            return show(false,'只有超级管理员才可进行此操作');
        }

        $result =  $this->updatePass();
        return $result;
    }

    private function checkQiang(){}
}