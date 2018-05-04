<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/16
 * Time: 15:10
 */

namespace app\common\model;


class News extends BaseModel
{
    //关联分类中间表
    public function sorts()
    {
        return $this->hasMany('NewSort', 'id', 'nid');
    }
    //关联标签中间表
    public function labels()
    {
        return $this->hasMany('NewLabel', 'new_id', 'id');
    }
    //获取分页
    public static function getPage($where=[], $rows=10 )
    {
        return self::alias('n')
                    ->where($where)
                    ->with('sorts', 'sorts.sort','labels', 'labels.label')
                    ->paginate($rows);
    }
    
    
    //获取全段政策法规中页面
    public static function getToListBySort($sortID ,$start=0, $rows=16)
    {
        return self::where([ 'sort_id'=>$sortID ])
                    ->field('id,title,sort_id, create_at')
                    ->limit($start, $rows)
                    ->cache(true, 60)
                    ->select();
    }


    //根据一级分类查询
    public static function getNewsBySortId($oneID, $limit=10 )
    {
        return self::where([ 'one_sort'=>$oneID ])->whereOr([ 'sort_id'=>$oneID ])->limit($limit)->field('id, title, sm_img, create_at,source')->select();
    }

    public static function getNewsById($id)
    {
        return self::with([ 'labels'])->where([ 'id'=>$id ])->find();
    }
}