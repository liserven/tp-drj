<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:30
 */

namespace app\common\model;


class Banner extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';

    public function setStartTimeAttr($value)
    {
        return strtotime($value);
    }

    public function setOverTimeAttr($value)
    {
        return strtotime($value);
    }

    public static function getCommon($where=[])
    {
        return self::alias('b')
            ->where($where)
            ->order('b.pid DESC');
    }

    //查询分页
    public static function getBannerPage($where = [], $rows = 5)
    {
        return self::getCommon($where)->paginate($rows);
    }

    //前台接口model
    public static function getBannerList($where = [], $rows =10 )
    {
        $where['b.status'] = 1;
//        $where['b.start_time'] = ['<', time()];
//        $where['b.over_time'] = ['>', time()];
        return self::getCommon($where)->field('b.href,b.img,b.title,b.type, b.gid')->limit(0, $rows)->select();
    }
}