<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/20
 * Time: 9:43
 */

namespace app\common\model;


class UserFeedback extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'uf_ctime';
    protected $updateTime = 'uf_utime';
}