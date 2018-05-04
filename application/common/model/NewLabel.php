<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/16
 * Time: 15:11
 */

namespace app\common\model;

/**
 * Class NewLabel
 * @package app\common\model
 * 新闻标签中间模型层
 */
class NewLabel extends BaseModel
{

        //关联标签表
    public function label()
    {
        return $this->belongsTo('Label', 'label_id', 'id');
    }
        //关联资讯表
    public function news()
    {
        return $this->belongsTo('News', 'new_id', 'id');
    }
}