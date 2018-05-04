<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 9:38
 */

namespace app\admin\controller;
/**
 * 后台公用控制器
 */

use app\common\model\ChatSee;
use app\common\model\Member as MemberModel;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\MemberException;
use app\lib\exception\ParameterException;
use think\Controller;
use think\Db;
use think\Url;

class Base extends Controller
{

    protected $noChe = ['']; //不需要检查的控制器

    protected $User;

    protected function _initialize()
    {


        //初始化父类方法
        parent::_initialize(); // TODO: Change the autogenerated stub
        $User = $this->_checkLogin();  //获取登录用户
        $this->User = $User;
        $this->assign('menu',$this->getMenu());
        $this->assign('path','/'.$this->request->path());
        $this->assign('User',$User);
        $this->assign('mName',$this->request->module());
        $this->assign('cName',$this->request->controller());
        $this->assign('aName',$this->request->action());

    }


//    protected $beforeActionList = [
//
//    ];
//
//    public function before(){
//
////
////        if( in_array($Url, $actionList)){
////            //如果当前url 在该用户的行为列表内 通过
////            return true;
////        }
//
//        if( $this->request->isAjax() ){
//            throw new ParameterException([
//                'code'=> 200,
//                'msg' => '你无权此操作'
//            ]);
//        }else
//        {
//            $this->redirect('admin/Error/notDuty');
//        }
//        //比对,如果在权限内可以通过 如果不在重定向，提示不能访问
//    }



    private function getMenu()
    {
        $User = $this->_checkLogin();  //获取登录用户
        if( $User['am_issupre']==1){
            //超级管理员 直接过
            return config('menu');
        }
        //获取用户所在权限的所有行为
        $actionList = $this->getDutyAction($User['am_id']);  //一级导航
        if($actionList === false){
            $this->redirect('admin/Error/invalid');
            exit;
        }
//        $menu = config('menu');
//        $menuList = [];
//        $urls = [];
//        foreach ($actionList as $key=>$list)
//        {
//            $menuList[$key] = $menu[$list['ad_url']];
//            $urls[] =
//        }
//
//        dd($actionList);
//        foreach ($menuList as $key=>$val)
//        {
//            foreach ($val['data'] as $k=>$v)
//            {
//                if( in_array($v['url'], $actionList))
//                {
//                    $menuList[$key]['data'][$k] = $v;
//                }
//            }
//
//        }
        return $actionList;
    }



    //处理结果
    protected function resultHandle($result=true, $msg=''){
        if($result === false ){
            return $this->ajaxShow( false,!empty($msg)?$msg:'操作失败');
        }else{
            return $this->ajaxShow( true,!empty($msg)?$msg:'操作成功');
        }
    }

    //验证必须是超级管理员
    public function _checkSupre()
    {
        $member = MemberModel::get($this->User['am_id']);
        if(!$member){
            throw new MemberException();
        }
        if( $member['am_issupre'] != 1 ){
            throw new MemberException([
                'msg' => '此操作只有超级管理员才有权限',
                'code' => 403
            ]);
        }
        return true;
    }

    public function toList()
    {
        $module = $this->request->controller();
        $module = toUnderScore($module);
        $page = Db::table($module)->paginate(10);
        $this->assign('page', $page);
        return $this->fetch();
    }


    public function doAdd()
    {
        if( $this->request->isPost())
        {

            $module = toUnderScore($this->request->controller());
            $list = Db::table($module)->getTableFields();
            foreach ( $list as $value)
            {
                if( $value != 'id' )
                {
                    $data[$value]= input($value);
                }
            }
            $data = array_filter($data);
            return $this->resultHandle(Db::table($module)->insert($data));
        }
        else{
            return $this->fetch();
        }
    }


    //同意删除方法
    public function doDel($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $module = toUnderScore($this->request->controller());
        return $this->resultHandle(Db::table($module)->delete($id));
    }


    //异步返回结果
    public function ajaxShow($bol , $msg ,$data=[], $code = '200'){

        $data = [
            'bol' => $bol,
            'msg' => $msg,
            'data' =>$data
        ];

        return json($data);
    }


    public function checkEditDelStatus()
    {
        if(!$this->_checkAction()){
            throw new ParameterException([
                'msg' => '你无权此操作'
            ]);
        }
        return true;
    }


    //验证登录
    public function _checkLogin(){
        $user = session('User');
        if( !$user ){
            if( $this->request->isAjax() ){
                 return  $this->ajaxShow(false,'您还未登录请登录');
            }

            $this->error('您还未登录请登录',Url::build('admin/Login/index'));
        }
        else{
            return $user;
        }

    }


    //根据用户获取所有权限
    protected function getDutyAction($userid){
        $duty = Db::table('admin_duty')->where(['ad_user_id'=>$userid])->select(); //获取所有权限
        $actionList = [];
        foreach ($duty as $k=> $d){
            $actionList = Db::table('duty_action')->alias('da')->
            join('__ACTION_DATA__ ad', 'da.da_action_id=ad.ad_id', 'left')->
            where([ 'da_duty_id'=>$d['ad_duty_id'] ])->select();
        }

        if( empty($actionList ) ){
            return  false;
        }
        //处理数组
        $newIds = [];
        $twos = [];
        $urls = array_column($actionList, 'ad_url');
        foreach($actionList as $key=>$val){
            if( $val['ad_pid'] == 0){
                $newIds[$key] = $val;
            }
        }
        foreach ($newIds as $key=> $ids )
        {
            $newIds[$key]['two']= Db::table('action_data')->where([ 'ad_pid'=> $ids['ad_id'], 'ad_url'=> [ 'in', $urls] ])->select();
        }
        return $newIds;
    }


    public function _checkAction(){
        $Url = $this->request->path();  //获取当前Url
        if( $this->User['am_issupre']==1){
            //超级管理员 直接过
            return true;
        }
        if( in_array($Url,$this->noChe)){
            //如果在不需要验证的行列中 直接过
            return true;
        }

        //获取用户所在权限的所有行为
        $actionList = $this->getDutyAction($this->User['am_id']);

        if($actionList === false){
            $this->redirect('admin/Error/invalid');
            exit;
        }

        if( in_array($Url, $actionList)){
            //如果当前url 在该用户的行为列表内 通过
            return true;
        }

        return false;
    }

    //验证是否只能修改自己的。
    public function _checkEditMe(){
        if($this->User['am_edit_me']==1){
            return false;
        }
    }


    //验证用户是否是总编或者栏目主编
    protected function checkArticleIsShowMy()
    {
        $where = [];
        $ddName = $this->User['dd_name'];
        if( $ddName != '总编辑' && $ddName != '栏目主编' )
        {
            $where['ai_mid'] = $this->User['am_id'];
        }
        return $where;
    }

}