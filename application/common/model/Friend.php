<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/11
 * Time: 16:15
 */

namespace app\common\model;

/**
 * Class Friend
 * @package app\common\model
 * 好友模型层
 */
class Friend extends BaseModel
{

    public static function getFriendsByMid($mid, $groupID)
    {
        $where['f.status'] = 2;
        $where['cid'] = $mid;
        $where['group_id'] = $groupID;
        return self::alias('f')
                    ->where($where)
                    ->join('__MEMBER__ am', 'am.am_id=f.bid','left')
                    ->join('__FRIEND_MESSAGE__ fm', 'fm.send_id=am.am_id and fm.receive_id=f.cid and fm.status=1', 'left')
                    ->field('am.am_nickname,am.am_logo,am.am_log_status,COUNT(DISTINCT fm.id) AS messages,fm.create_at as send_time')
                    ->group('f.id')
                    ->order('fm.status ASC')
                    ->select();
    }
}