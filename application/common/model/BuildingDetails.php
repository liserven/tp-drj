<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/3/7
 * Time: 10:24
 */

namespace app\common\model;


class BuildingDetails extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';

    private static function getCommon($where=[])
    {
        return self::alias("bd")
                    ->where($where)
                    ->join("__BUILDING_COLUMN__ bc", "bc.id=bd.g_column", "left")
                    ->join("__BUILDING_COLUMN__ bc2", "bc2.id=bd.g_columr", "left")
                    ->join("__BUILDING_COLUMN__ bc3", "bc3.id=bd.g_columx", "left")
                    ->field("bd.*, bc.name as oname, bc2.name as tname, bc3.name as ename")
                    ->order("id DESC");
    }

    //获取商品规格 一对多
    public function colors()
    {
        return $this->hasMany('BuildingScreen', 'gid', 'id');
    }
    //获取商品图片 一对多
    public function images()
    {
        return $this->hasMany('BuildingImg', 'g_id', 'id');
    }
    //获取服务
    public function deplo(){
        return $this->hasMany('Deploy','gid','id');
    }
    //获取商品详情 一对多
    public function beset()
    {
        return $this->hasMany('BuildingSet', 'gid', 'id');
    }
   //获取商品分类 一对多

    public static function getShoppingStock($buildingId, $typeId){}

    public static function getListByWhere($where=[], $rows= 10)
    {
        return self::alias('bd')->where($where)->field('bd.id, bd.g_name, bd.g_column, bd.g_columr, bd.g_columx, bd.g_price_r
        , bd.g_price, bd.g_img ')->paginate($rows);
    }


    private static function getCommonWhere($where=[])
    {
        $where['bd.status'] = 1;
        return $where;
    }

    public function sets()
    {
        return $this->hasMany('building_set', 'gid', 'id');
    }

    public function customers()
    {
        return $this->hasMany('building_customer', 'gid', 'id');
    }

    public static function getBuildingDetailById($where=[],$rows=15)
    {
        return self::with(['colors', 'images', 'sets', 'customers'])
                    ->where($where)
                    ->find();
    }

    public static function getBuildingPage($where = [], $rows = 15)
    {
        return self::getCommon($where)->paginate($rows);
    }


    public static function getIndex()
    {
        return self::where([ 'status'=>1 ])->order([ 'is_index'=> 'asc', 'order'=> 'asc'])->field('id,g_name, g_price, g_img, g_price_r')->limit(0,9)->select();
    }



}