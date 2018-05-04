<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 8:56
 */

namespace app\admin\controller;

use app\common\model\ActionData;
use app\common\model\DutyAction;
use app\common\validate\ActionValidate;
use app\common\validate\Find;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use custom\CusLog;
use think\Db;

/**
 * Class action
 * @package app\admin\controller
 * 行为控制器
 */
class Action extends Base
{
    //alalaa
    //初始化父类方法
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $actionPidList = ActionData::getActionPidSelect(['ad_pid' => 0]); //查询所有一级分类
        $this->assign('actionPidList', $actionPidList);
    }


    /**
     * @url admin\Reply\toList
     * 行为列表页
     */
    public function toList()
    {

        $where['ad_pid'] = input('pid') ? input('pid') : '';
        $where['ad_topic'] = input('seach') ? input('seach') : '';
        $actionList = ActionData::findByPage($where); //查询所有分类
        $this->assign('page', $actionList);
        return $this->fetch();

    }

    /**
     * @url admin\Reply\toAdd
     * 行为添加页面
     */
    public function toAdd()
    {
    }

    /**
     * @url admin\Reply\doAdd
     * 行为添加方法
     */
    public function doAdd()
    {

        if ($this->request->isPost()) {
            //组合数据
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $data['ad_pid'] = input('pid/d') ? input('pid/d') : 0;
            $data['ad_topic'] = input('topic');
            $data['ad_url'] = input('url');
            $data['ad_status'] = input('status');
            //验证数据
            (new ActionValidate())->goCheck($data);
            //添加数据
            $actionResult = ActionData::create($data);
            //返回结果
            if (!$actionResult) {
                return show(false, '添加失败');
            } else {

                CusLog::writeLog($this->User['am_id'], '添加行为' . $data['ad_topic']);
                return show(true, '添加成功');
            }
        } else {
            return $this->fetch();
        }
    }

    /**
     * @URL admin\Reply\toEdit
     * 行为修改页面
     */
    public function toEdit($id)
    {
        $actionData = ActionData::get($id);
        $this->assign('actionData', $actionData);
        return $this->fetch();
    }

    /**
     * @url admin\Reply\doEdit
     * 行为修改方法
     */
    public function doEdit()
    {
        if ($this->request->isPost()) {

            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }


            //组合数据
            $data['ad_pid'] = input('pid/d') ? input('pid/d') : 0;
            $data['ad_topic'] = input('topic');
            $data['ad_url'] = input('url');
            $data['ad_state'] = input('state') == 'on' ? 1 : 2;
            $data['ad_id'] = input('adid/d');
            //验证数据
            (new ActionValidate())->goCheck($data);
            $data = ActionData::get($data['ad_id']);
            if (!$data)
            {
                new ParameterException([
                    'msg' => '该行为已经不存在'
                ]);
            }

            //修改
            $actionResult = ActionData::update($data);

            //返回结果
            if (!$actionResult) {
                CusLog::writeLog($this->User['am_id'], '修改'.$data->ad_topic.'行为');
                return $this->ajaxShow(false, '修改失败');
            } else {
                return $this->ajaxShow(true, '修改成功');
            }

        } else {
            (new IDMustBePositiveInt())->goCheck();
            $id = input('id/d');
            $actionData = ActionData::get($id);
            $this->assign('data', $actionData);
            return $this->fetch();
        }
    }


    /**
     * @url admin\Reply\doDel
     * 行为删除方法
     */
    public function doDel($id)
    {
        if (!$this->_checkAction()) {
            return $this->ajaxShow(false, '无权此操作');
        }
        (new IDMustBePositiveInt())->goCheck();
        $actionRs = ActionData::get($id);
        if (!$actionRs) {
            return $this->ajaxShow(false, '当前行为已经不存在');
        }
        Db::startTrans();
        try {
            $actionResult = $actionRs->delete();
            DutyAction::destroy(['da_action_id'=>$id]); //删除对应关联数据
            CusLog::writeLog($this->User['am_id'], '删除行为' . $actionRs->ad_topic);
            Db::commit();
            return $this->resultHandle($actionResult);
        } catch (\Exception $e) {
            Db::rollback();
            $this->ajaxShow(false, $e->getMessage());
        }
    }

    public function editStatus($id, $state)
    {
        $this->checkEditDelStatus();
        $data = ActionData::get($id);
        if (!$data) {
            throw new ParameterException([
                'msg' => '此角色已经不存在',
            ]);
        }
        $data->ad_status = $state;
        $UserResult = $data->save();
        if ($UserResult) {
            $str = $state == 1 ? '启用了' : '停用了';
            CusLog::writeLog($this->User['am_id'], $str . '权限' . $data->ad_topic . '状态');
            return $this->ajaxShow(true, '修改成功');
        } else {
            return $this->ajaxShow(false, '修改失败');
        }
    }


}