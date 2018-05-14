<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/12
 * Time: 9:14
 */

namespace app\common\service;


use app\common\model\BuildingCollection;
use app\common\model\BuildingDetails;
use app\common\model\BuildingScreen;
use app\lib\exception\BuildingException;
use app\lib\exception\ParameterException;

class BuildingService
{
    private $id;

    function __construct()
    {
    }

    //收藏建材
    public function setBuildingCollection($userId, $id)
    {
        $where = [
            'u_id' => $userId,
            'bu_id' => $id,
        ];
        if( !BuildingDetails::get($id)){
            throw new BuildingException();
        }
        $isCollection= $this->buildingIsCollection($where);
        if($isCollection )
        {
            //如果已经收藏 选择删除该收藏
            $isCollection->delete();
            $resultData['isCollection'] = 1; //如果返回是1 说明是取消收藏
        }
        else{
            $resultData = BuildingCollection::create($where);
            $resultData['isCollection'] = 2; //如果是2，说明是添加收藏成功
        }
        return show(true, 'ok', $resultData);
    }


    //查询是否收藏该建材
    public function buildingIsCollection($where= [])
    {
        $data= BuildingCollection::get($where);
        return !empty($data)? $data: false;
    }

    //查询该建飘香否还存在
    public static function getBuildingData($buildingId)
    {
        $where = [
            'status' => 1,
            'id'=> $buildingId
        ];
        return BuildingDetails::get($where);
    }

    //验证库存
    public static function checkStock($typeId, $num)
    {
        $screen = BuildingScreen::get(['id'=>$typeId]); //查找该规格的商品
        if( $screen['stock'] < $num )
        {
            throw new BuildingException([
                'msg' => '库存不足',
                'errCode' => 60005
            ]);
        }
        return $screen;
    }

//收藏建材 多个
    public function setBuildingCollections($userId, $ids)
    {
        if( !is_array($ids))
        {
            throw new ParameterException([
                'msg'=> '参数错误'
            ]);
        }
        foreach ($ids as $id)
        {
            $where = [
                'u_id' => $userId,
                'bu_id' => $id,
            ];
            if( !BuildingDetails::get($id)){
                throw new BuildingException();
            }
            $isCollection= $this->buildingIsCollection($where);
            if(!$isCollection )
            {
                $resultData = BuildingCollection::create($where);
                $resultData['isCollection'] = 2; //如果是2，说明是添加收藏成功
            }
        }
        return show(true, 'ok', $resultData);
    }




}