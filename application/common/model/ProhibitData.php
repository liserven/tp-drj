<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 14:23
 */

namespace app\common\model;


class ProhibitData extends BaseModel
{

    protected $hidden = []; //隐藏的字段

    public function sorts(){
        return $this->belongsTo('ProhibitSort','pd_sort_id','ps_id');
    }

    //查询全部
    public function getProhibitList(){
        return self::with('sorts')
                    ->select();
    }

    //条件查询分页
    public static function getProhibitPageList($where=[], $rows=10){
        $map = [];
        if(!empty($where['pd_text'])){
            $map['pd_text'] = $where['pd_text'];
        }
        if(!empty($where['pd_sort_id'])){
            $map['pd_sort_id'] = $where['pd_sort_id'];
        }
        return self::with('sorts')
            ->where($map)
            ->paginate($rows);
    }


    //根据名称查询
    public static function getProhibitByText($name){
        return self::with('sorts')->where(['pd_text'=>$name])->find();
    }

    //根据id查询
    public static function getProhibitById($id){
        return self::with('sorts')->where(['pd_id'=>$id])->find();
    }
}