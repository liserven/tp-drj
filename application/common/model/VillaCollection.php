<?php

namespace app\common\model;
/**
 * Class VillaCollection
 * @package app\common\model
 * 别墅收藏
 */
class VillaCollection extends BaseModel
{
    public function villas()
    {
        return $this->belongsTo('VillaData', 'vc_villa_id', 'id');
    }


    public static function getVillaCollectionByUid($userId, $rows= 10)
    {
        return self::alias('vc')
                ->join('__VILLA_DATA__ vd', 'vd.id=vc.vc_villa_id', 'left')
                ->where([ 'vc_user_id'=> $userId])
                ->field('vc.vc_id as id ,vd.id as vid ,vd_name, vd_price, vd_unit_price, vd_height, vd_class, vd_logo,vd_building_area, office, room, wei')
                ->order('vc.vc_id desc')
                ->paginate($rows);
    }
}