<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/10
 * Time: 17:13
 */

namespace app\admin\controller;


use app\common\model\Friend;
use app\common\model\FriendGroup;

class Chat extends Base
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }


    public function index()
    {

        $friendgroup = FriendGroup::getFriendGroupListByMid($this->User['am_id']);
        foreach($friendgroup as $key=>$val ){
            $friendgroup[$key]['friends'] = Friend::getFriendsByMid($this->User['am_id'], $val['id']);
        }
        $this->assign('friends', $friendgroup);
        $this->assign('user', $this->User);
        return $this->fetch();
    }
}