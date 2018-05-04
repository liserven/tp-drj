<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/3/1
 * Time: 10:09
 */

namespace app\common\model;


class VillaData  extends BaseModel
{
    public static function getVillaPage($where = [], $rows = 10, $order = 'zh')
    {
        $data = self::with('images')->where($where);
        if( $order == 'jg_s' )
        {
            $data->order('vd_price asc');
        }
        if( $order == 'jg_j' ){
            $data->order('vd_price desc');
        }
        if( $order == 'zh' )
        {
            $data->order(['order'=> 'asc', 'id'=>'desc']);
        }
        return  $data->paginate($rows);

    }


    public function images()
    {
        return $this->hasMany('VillaImg', 'vi_villa_id', 'id');
    }

    public static function indexVilla($where=[])
    {
        $where['status'] = 1;
        return self::where($where)->order(['is_index'=> 'asc', 'order'=> 'asc'])->field('id,vd_name, vd_price, vd_unit_price, vd_height, vd_class, vd_logo,vd_building_area, office, room, wei')->limit(0,10)->select();
    }




    public static function getFind($id)
    {
        return self::alias('vd')
            ->where(['id'=> $id])
            ->join('__VILLA_COLLECTION__ vc', 'vc.vc_id=vd.id', 'left')
            ->field('vd.*, count(distinct vc.vc_id) as collections')
            ->find();
    }



}