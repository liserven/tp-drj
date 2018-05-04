<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/16
 * Time: 15:10
 */

namespace app\common\model;


class NewSort extends BaseModel
{

    //关联分类表
    public function sort()
    {
        return $this->belongsTo('Sort', 'sid', 'id' );
    }

    //关联资讯表
    public function news()
    {
        return $this->belongsTo('News', 'nid', 'id');
    }



}