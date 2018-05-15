<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:58
 */

namespace app\common\model;


class ActionData extends BaseModel
{
    public function actions(){
        return $this->hasMany('ActionData','ad_pid','ad_id');
    }

    public function pname(){
        return $this->belongsTo('ActionData','ad_pid','ad_id');
    }
    //条件查询全部分布
    public static function findByPage($where=[],$rows=15){
        //一对一查询
        return self::with('pname')->where(self::getWhereArr($where))->paginate($rows);
    }

    public static function findByPageList($where=[],$rows=10){

        return self::with('actions')->where($where)->paginate($rows);
    }

    //根据父级id查询
    public static function getByActionPid($pid=0,$rows=10){
        return self::where('ad_pid','=',$pid)->paginate($rows);
    }


    public static function getActionPidSelect( $where=[] ){
        return self::where($where)->select();
    }



    public static function getWhereArr($where)
    {
        $map = [];
        if( !empty($where['ad_topic']) )
        {
            $map['ad_topic'] = $where['ad_topic'];
        }
        if( !empty($where['ad_pid']) )
        {
            $map['ad_pid'] = $where['ad_pid'];
        }

        return $map;
    }

}