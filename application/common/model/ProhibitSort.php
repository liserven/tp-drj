<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 14:24
 */

namespace app\common\model;


class ProhibitSort extends BaseModel
{
    protected $autoWriteTimestamp = true; //开启时间自动写入
    protected $createTime = 'ps_atime';      //设置写入字段
    protected $updateTime = false;

    protected $hidden = []; //隐藏的字段
}