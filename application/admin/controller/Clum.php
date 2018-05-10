<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\BuildingColumn;
use app\common\model\BuildingDetailsSet;
use app\common\validate\IDMustBePositiveInt;
use custom\CusLog;
use think\Db;


class Clum extends Base
{
    public function tolist()
    {
        $page = Db::table('building_column')->paginate('15')->each(function($item,$key){
            if(is_array($item) && !empty($item)) {
                $list = db('building_column')->where('id', $item['pid'])->find();

                $item['pid'] = $list['name'];

                return $item;
            }
        });

        $this->assign('page',$page);

        return $this->fetch();
    }

    public function doadd()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $quiz1 = input('quiz1');

            $data['name'] = input('name');
            if(!$quiz1){
                $data['pid'] = 0;

                try{
                    $result = BuildingColumn::create($data);
                    return $this->resultHandle($result);
            }catch (\Exception $e){
                    return show( false, $e->getMessage() );
                }
            }else{
                $data['pid'] = $quiz1;
                try{
                    $result = BuildingColumn::create($data);
                    return $this->resultHandle($result);
                }catch (\Exception $e){
                    return show( false, $e->getMessage() );
                }

            }
           } else {
            $province  = db('building_column')->where('pid', 0)->select();
            $this->assign([
                'province' => $province,

            ]);

            return $this->fetch();

        }
    }

    public function doDel( $id )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $data = BuildingColumn::get([ 'id'=>$id ]);
        if( !$data )
        {
            throw new ParameterException();
        }
        Db::startTrans();
        try{
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">'.$data->name.'</a>Banner');
            Db::commit();
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            Db::rollback();
            return show( false, $e->getMessage() );
        }
    }


    public function getsortbypid($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = BuildingColumn::all(['pid'=> $id]);
        $this->assign('data', $data);
        return $this->fetch();

    }


    public function getSet($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = BuildingDetailsSet::all(['clumr_id'=> $id]);
        $this->assign('set', $data);
        return $this->fetch();
    }

    public function doEdit(){

        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
       }else{
            $id = input('id/d');
            $province  = db('building_column')->where('pid', 0)->select();
           $page = db('building_column')->where('id',$id)->find();

           $this->assign([
               'page'=>$page,
               'province'=>$province
           ]);
         return view();
       }
    }

}

