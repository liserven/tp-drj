<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/15
 * Time: 10:11
 */

namespace app\admin\controller;

use app\common\model\User as UserModel;
use app\common\model\Member as MemberModel;
use app\common\model\UserData;
use app\common\service\UserResetPass;
use app\common\validate\IDMustBePositiveInt;
use app\common\validate\UserValidate;
use app\lib\exception\UserException;
use custom\CusLog;
use think\Db;

/**
 * Class User
 * @package app\admin\controller
 * 用户模板控制器
 */
class User extends Base
{


    protected function _initialize()
    {
        $this->assign('provice', Db::table('provice')->select());
        parent::_initialize();
    }

    /**
     * @url admin\User\toList
     * 用户列表页
     */
    public function toList()
    {
        $list = Db::table('user_data')->where('province','null')->select();
        var_dump($list);exit;




        $province = input('get.provice');
        $city = input('get.city');
        $county = input('get.county');
        $town = input('get.town');
        $phone = input('get.phone');
        $name  = input('get.name');
        $where = [
            'type' => 2,
            'status' => 1
        ];
        if (!empty($town)) {
            $where['town'] = $town;
        }
        if (!empty($county)) {
            $where['county'] = $county;
        }
        if (!empty($city)) {
            $where['city'] =$city;
        }
        if (!empty($province)) {
            $where['province'] = $province;
        }
        if (!empty($phone)) {
            $where['ud_phone'] = $phone;
        }
        if (!empty($name)) {
            $where['ud_name'] = $name;
        }
        $userlist = Db::table('user_data')->where($where)->paginate('15');
        $this->assign('page', $userlist);
        return $this->fetch();

    }

    /**
     * @url admin\User\toAdd
     * 用户添加页面
     */
    public function toAdd()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
        } else {
            return view();
        }
    }

    /**
     * @url admin\User\doAdd
     * 用户添加方法
     */
    public function doAdd()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $data['ud_name'] = input('name');//姓名
            $data['ud_phone'] = input('phone');//手机号
            $data['ud_password'] = md5(input('password'));//密码
            $data['ud_sex'] = input('sex');//性别
            $data['ud_logo'] = input('ud_logo');//头像
            $data['province'] = input('get.provice');//省
            $data['city'] = input('get.city');//市
            $data['county'] = input('get.county');//县
            $data['town'] = input('get.town');//镇
            $data['ud_address'] = input('ud_address');//详细地址
            $data['ud_photo'] = input('ud_photo');//一寸照片
            $data['ud_id_photo'] = input('ud_id_photo');//身份证正面
            $data['ud_id_photo_r'] = input('ud_id_photo_r');//身份证反面
            $data['referee'] = input('referee');//推荐人
            $data['ud_status'] = input('ud_status');//合伙人类型
            $data['type'] = 2;//类型
            $data['ud_examine_status'] = 1;//审核状态
            $data['message'] = input('message');//个人说明

            try {
                $result = UserData::create($data);
                return $this->resultHandle($result);

            } catch (\Exception $e) {
                Db::rollback();
                return show(false, $e->getMessage());
            }

        } else {
            return view();
        }
    }

    /**
     * @URL admin\User\toEdit
     * 用户修改页面
     */
    public function toEdit($id)
    {

    }

    /**
     * @url admin\User\doEdit
     * 用户修改方法
     */
    public function doEdit()
    {
        if ($this->request->isPost()) {
            //组合数据
            $data['au_nickname'] = input('nickname');
            $data['au_iphone'] = input('iphone');
            $data['au_email'] = input('email');
            $data['au_status'] = input('state') == 'on' ? 1 : 2;
            $data['au_id'] = input('uid');
            $userValidate = (new UserValidate())->goCheck($data);


            if ($userValidate) {
                Db::startTrans();

                try {

                    $userResult = UserModel::update($data);

                    CusLog::writeLog($this->User['am_id'], '修改了' . $data['au_nickname'] . '资料');

                    Db::commit();

                    return $this->resultHandle($userResult);
                } catch (\Exception $e) {
                    return $this->ajaxShow(false, $e->getMessage());
                    Db::rollback();
                }


            } else {
                return $this->ajaxShow(false, $userValidate->getError());
            }
        } else {
            $id = input('id/d');
            (new IDMustBePositiveInt())->goCheck();

            $UserData = UserModel::get($id);

            $this->assign('UserData', $UserData);

            return $this->fetch();
        }

    }

    public function toResetPassword($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $this->assign('id', $id);
        return $this->fetch();
    }

    public function checkIsAdmin()
    {
        $pass = input('post.pas');
        $uid = $this->User['am_id'];

        $UserData = MemberModel::get($uid);
        if (md5($pass) != $UserData['am_password']) {
            return show(false, '验证错误');
        }
        return show(true);

    }

    public function doResetPassword()
    {
        //重置密码

        $data['isQiang'] = input('post.state') == 'on' ? 1 : 2;
        $data['id'] = input('post.id');
        $data['pass'] = input('post.prepassword');
        $data['newpass'] = input('post.newpassword');

        Db::startTrans();

        try {
            $user = new UserResetPass($this->User['am_id'], $data);
            $result = $user->reset();
            CusLog::writeLog($this->User['am_id'], '修改了 用户' . $data['id'] . '密码');
            Db::commit();
            return $result->getContent();
        } catch (\Exception $e) {
            throw new UserException([
                'msg' => $e->getMessage()
            ]);
            Db::rollback();
        }


    }

    /**
     * @url admin\User\doDel
     * 用户删除方法
     */
    public function doDel($id)
    {
        $this->checkEditDelStatus();
        $data = ['au_id' => $id]; //获取所有的参数
        $UserResult = UserModel::destroy($id);
        if ($UserResult) {
            CusLog::writeLog($this->User['am_id'], '删除了 用户' . $id);
            return $this->ajaxShow(true, '删除成功');
        } else {
            return $this->ajaxShow(false, '删除失败');
        }
    }


    /**
     * @url admin/User/editState
     * 修改用户状态方法
     */
    public function editStatus($id, $state = 2)
    {
        $this->checkEditDelStatus();
        $data = ['au_id' => $id, 'au_status' => $state]; //获取所有的参数
        $UserResult = UserModel::update($data);
        if ($UserResult) {
            CusLog::writeLog($this->User['am_id'], '修改了用户' . $id . '状态');
            return $this->ajaxShow(true, '修改成功');
        } else {
            return $this->ajaxShow(false, '修改失败');
        }
    }


    /**
     * @url admin/User/setSeal
     * 对用户封号
     */
    public function setSeal()
    {
    }

    //获取合伙人星级评分
    public function getUserStar()
    {
        $id = input('get.id');
        $data = db('partner_star')->where('pid', $id)->find();//获取该合伙人星级评分
        $page = db('user_data')->where('ud_id',$id)->find();//获取该合伙人个人说明
        $list = db('partner_laud')->count('pid',$id);//获取该合伙人受赞数量
        $abcd = db('villa_order')->count('partner_id',$id);//获取该用户成交数量
       // $bacd = db('partner_laud')->count('pid',$id);//获取该用户沟通数量

        $this->assign([
            'data'=> $data,
            'page'=>$page,
            'list'=>$list,
            'abcd'=>$abcd,
            //'bacd'=>$bacd

        ]);
        return $this->fetch();

    }

    //黑名单列表
    public function black($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $list = db('user_data')->where('ud_id', $id)->setField('status', 2);

        return $this->resultHandle($list);
    }
}