<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/6/8
 * Time: 17:22
 */

namespace app\admin\controller;
use app\common\model\Custom as CustomModel;
use think\Db;


class Custom extends Base
{

    //客服列表
  public function tolist(){
      $userlist = Db::table('custom')->paginate('15');
      $this->assign('page', $userlist);
      return $this->fetch();
  }
   //客服添加
  public function doadd(){
      if ($this->request->isPost()) {
          if (!$this->_checkAction()) {
              return $this->ajaxShow(false, '无权此操作');
          }
          $data['ud_name'] = input('name');//姓名
          $data['ud_phone'] = input('phone');//手机号
          $data['ud_sex'] = input('sex');//性别
          $data['ud_logo'] = input('ud_logo');//头像
          $data['message'] = input('message');//个人说明
          $data['ud_address'] = input('address');//地区
          try {
              $result = CustomModel::create($data);
              return $this->resultHandle($result);

          } catch (\Exception $e) {
              Db::rollback();
              return show(false, $e->getMessage());
          }
      }else{
          return view();
      }
  }
  public function doEdit()
  {
      if ($this->request->isPost()) {
          if (!$this->_checkAction()) {
              return $this->ajaxShow(false, '无权此操作');
          }
          $id = input('post.id');
          $name = input('ud_name');//姓名
          $phone = input('ud_phone');//手机号
          
          $sex = input('sex');//性别
          $logo = input('ud_logo');//头像
          $message = input('message');//个人说明
          $address= input('address');//地区
          try {
               $data = db('custom')->where('ud_id',$id)->update(['ud_name'=>$name,'ud_phone'=>$phone,'ud_sex'=>$sex,'ud_logo'=>$logo,'ud_address'=>$address,'message'=>$message]);

              return show(true, 'ok', []);

          } catch (\Exception $e) {
              Db::rollback();
              return show(false, $e->getMessage());
          }
      }else{
          $id = input('id/d');
          $data = db('custom')->where('ud_id',$id)->find();
          $this->assign('data',$data);
          return $this->fetch();
      }
  }
}