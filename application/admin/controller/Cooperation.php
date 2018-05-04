<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/3
 * Time: 10:15
 */

namespace app\admin\controller;

use app\common\model\Cooperation as CooperationModel;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use custom\CusLog;
use think\Db;

class Cooperation extends Base
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }


    //列表显示
    public function toList()
    {
        $page = CooperationModel::getPage();
        $this->assign('page', $page);
        return $this->fetch();
    }


    //添加
    public function doAdd()
    {
        if ($this->request->isPost()) {
            //组合数据
            $data['name']   = input('post.name');
            $data['wechat']   = input('post.wechat');
            $data['logo']   = input('post.logo');
            $data['phone']   = input('post.phone');
            $data['email']   = input('post.email');
            $data['ewm']   = input('post.ewm');
            //验证数据
            Db::startTrans();
            try {
                CooperationModel::create($data);
                Db::commit();
                return show( true, 'ok');
            } catch (\Exception $e) {
                Db::rollback();
                return show( false, $e->getMessage() );
            }
        } else {
            return $this->fetch();
        }
    }

    //修改
    public function doEdit()
    {
        if ($this->request->isPost()) {
            //组合数据
            $data['name']   = input('post.name');
            $data['wechat']   = input('post.wechat');
            $data['logo']   = input('post.logo');
            $data['phone']   = input('post.phone');
            $data['email']   = input('post.email');
            $data['ewm']   = input('post.ewm');
            $data['id']         = input('post.id');
            //验证数据
            Db::startTrans();
            try {
                CooperationModel::update($data);
                Db::commit();
                return show( true, 'ok');
            } catch (\Exception $e) {
                Db::rollback();
                return show( false, $e->getMessage() );
            }
        } else {
            (new IDMustBePositiveInt())->goCheck();
            $id = input('id/d');
            $data = CooperationModel::get($id);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }

    //删除
    public function doDel($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = CooperationModel::get($id);
        if (!$data) {
            throw new ParameterException();
        }
        try {
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">' . $data->name . '</a>合作联系人员');
            return $this->resultHandle($result);
        } catch (\Exception $e) {
            return show(false, $e->getMessage());
        }
    }


    //修改状态
    public function editStatus($id, $state)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = CooperationModel::get(['id' => $id]);
        if (!$data) {
            throw new ParameterException();
        }
        $content = $state == 1 ? '启用了 -' . $data->title . '- Banner' : '停用了 - <a class="c-red">' . $data->title . '-</a> Banner';
        try {
            $data->status = $state;
            $result = $data->save();
            CusLog::writeLog($this->User['am_id'], $content);
            return $this->resultHandle($result);
        } catch (\Exception $e) {
            return show(false, $e->getMessage());
        }
    }

    //修改排序
    public function editOrder($id, $order)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = CooperationModel::get(['id' => $id]);
        if (!$data) {
            return show(false, '该Banner已经不存在了...');
        }
        try {
            $data->order = $order;
            $result = $data->save();
            CusLog::writeLog($this->User['am_id'], '修改了 <a class="c-red">' . $data->title . '</a>排序,结果为' . $order);
            return $this->resultHandle($result);
        } catch (\Exception $e) {
            return show(false, $e->getMessage());
        }
    }


    public function doDels($ids = [])
    {
        if (empty($ids)) {
            return show(false, '选中数据为空');
        }
        try {
            $str_ids = implode(',', $ids);
            $result = CooperationModel::destroy($str_ids);
            return $this->resultHandle($result);
        } catch (\Exception $e) {
            return show(false, $e->getMessage());
        }
    }

}