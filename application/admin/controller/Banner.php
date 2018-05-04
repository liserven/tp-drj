<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\Banner as BannerModel;
use app\common\validate\BannerValidate;
use app\common\validate\IDMustBePositiveInt;
use custom\CusLog;

class Banner extends Base
{


    //列表显示
    public function toList()
    {

        $bannerList = BannerModel::getBannerPage();
        $this->assign('page', $bannerList);
        return $this->fetch();
    }



    public function doAdd()
    {
        if( $this->request->isPost() )
        {
            $data = input('post.');
            if( strtotime($data['over_time']) < time() )
            {
                return show( false, '下架时间不得是过去时间..');
            }
            if( strtotime($data['over_time']) < strtotime($data['start_time']) )
            {
                return show( false, '下架时间不得早于上架时间..');
            }
            ( new BannerValidate() )->goCheck($data);
            try{
                $data['type'] = 1;
                $result = BannerModel::create($data);
                CusLog::writeLog($this->User['am_id'], '添加了 <a class="c-red">'.$data['title'].'</a>Banner');
                return $this->resultHandle($result);
            }catch (\Exception $e)
            {
                return show(false, $e->getMessage() );
            }
        }else{
            return $this->fetch();
        }
    }


    public function doEdit()
    {   
        if( $this->request->isPost() )
        {
            $data = input('post.');
            $banner_data = BannerModel::get([ 'pid'=>$data['pid'] ]);
            if( !$banner_data )
            {
                return show(false, '该Banner不存在了' );
            }
            if( strtotime($data['over_time']) < time() )
            {
                return show( false, '下架时间不得是过去时间..');
            }
            if( strtotime($data['over_time']) < strtotime($data['start_time']) )
            {
                return show( false, '下架时间不得早于上架时间..');
            }
            ( new BannerValidate() )->goCheck($data);
            $result = BannerModel::update($data);
            CusLog::writeLog($this->User['am_id'], '修改了 <a class="c-red">'.$banner_data->title.'</a> Banner');
            return $this->resultHandle($result);
        }else{
            (new IDMustBePositiveInt( ) )->goCheck();

            $banner_data = BannerModel::find(['id'=>input('id')]);


            $this->assign( 'data', $banner_data );
            return $this->fetch();
        }
    }

    public function doDel( $id )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $banner_data = BannerModel::get([ 'pid'=>$id ]);
        if( !$banner_data )
        {
            return show( false, '该Banner已经不存在了...');
        }
        try{
            $result = $banner_data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">'.$banner_data->title.'</a>Banner');
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            return show( false, $e->getMessage() );
        }
    }

    public function editStatus( $id, $state )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $banner_data = BannerModel::get([ 'id'=>$id ]);
        if( !$banner_data )
        {
            return show( false, '该Banner已经不存在了...');
        }
        $content = $state == 1 ? '启用了 -'.$banner_data->title.'- Banner' : '停用了 - <a class="c-red">'.$banner_data->title.'-</a> Banner';
        try{
            $banner_data->status = $state;
            $result = $banner_data->save();
            CusLog::writeLog($this->User['am_id'], $content);
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            return show( false, $e->getMessage() );
        }
    }


    public function editOrder( $id , $order )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $banner_data = BannerModel::get([ 'id'=>$id ]);
        if( !$banner_data )
        {
            return show( false, '该Banner已经不存在了...');
        }
        try{
            $banner_data->order = $order;
            $result = $banner_data->save();
            CusLog::writeLog($this->User['am_id'], '修改了 <a class="c-red">'.$banner_data->title.'</a>排序,结果为'.$order);
            return $this->resultHandle($result);
        }catch ( \Exception $e ){   
            return show( false, $e->getMessage() );
        }
    }


    public function doDels( $ids=[] )
    {
        if( empty($ids) )
        {
            return show(false, '选中数据为空');
        }
        try{
            $str_ids = implode(',' , $ids );
            $result = BannerModel::destroy($str_ids);
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            return show( false, $e->getMessage() );
        }
    }
}