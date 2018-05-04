<?php

namespace app\common\model;

class Deploy extends BaseModel{

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';

    private static function getCommon($where=[])
    {
        return self::alias("bd")
            ->where($where)


            ->order("id DESC");
    }
    public static function getDoplyPage($where = [], $rows = 15)
    {
        return self::getCommon($where)->paginate($rows);
    }
}