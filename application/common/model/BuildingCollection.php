<?php

namespace app\common\model;
/**
 * Class BuildingCollection
 * @package app\common\model
 * 用户关注建材模型
 */
class BuildingCollection extends BaseModel
{
    //关联建材表
    public function buildings()
    {
        return $this->belongsTo( 'BuildingDetails', 'bu_id', 'id');
    }

    //获取用户收藏建材列表
    public static function getCollectionListByUid($userId, $rows= 10)
    {
        return self::alias('bc')
            ->join('__BUILDING_DETAILS__ gd', 'bc.bu_id=gd.id','left')
            ->field('gd.g_name, gd.g_img, gd.g_price, gd.g_price_r, gd.id as g_id, bc.id')
            ->order('bc.id desc')
            ->where([ 'u_id'=>$userId ])
            ->paginate($rows);
    }

}