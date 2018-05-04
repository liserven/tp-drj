<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/11
 * Time: 16:15
 */

namespace app\common\model;


/**
 * Class FriendGroup
 * @package app\common\model
 * 好友分组模型层
 */
class FriendGroup extends BaseModel
{

    public function groups()
    {
        return $this->hasMany('Friend', 'group_id', 'id');
    }

    public static function getFriendGroupListByMid($mid)
    {
        return self::where([ 'mid'=>$mid ])
                ->select();
    }
}