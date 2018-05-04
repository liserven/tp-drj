<?php
/**
 * Created by PhpStorm.
 * User: lishenyang
 * Date: 2017/12/14
 * Time: 22:02
 */

namespace app\common\model;


class Sort extends BaseModel
{
    public function psort ()
    {
        return $this->belongsTo('Sort', 'pid', 'id');
    }

    //查询所有的下级分类
    public function twoSorts()
    {
        return $this->hasMany( 'Sort', 'pid', 'id');
    }

    public function news()
    {
        return $this->hasMany( 'News', 'one_sort', 'id');
    }

    //获取分页
    public static function getPage($where=[] , $rows=10)
    {
        return self::alias('s')
                    ->with('psort')
                    ->where($where)
                    ->order('s.id DESC')
                    ->paginate($rows);
    }


    //获取首页显示模块
    public static function getIndexNews()
    {
        return self::with([ 'twoSorts'])->where([ 'pid'=>0 ])
                        ->limit(0,6)->select();
    }
}