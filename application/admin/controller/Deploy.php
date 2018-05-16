<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/25
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\Deploy as DeployModel;
use think\Db;
use app\common\validate\IDMustBePositiveInt;

class Deploy extends Base
{
    public function doAdd()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
                $data['name'] = input('name');
                $data['img'] = input('img');
                $data['type'] = input('type');


                try{
                    $result = DeployModel::create($data);
                    return $this->resultHandle($result);

                }catch (\Exception $e)
                {
                    return show( false, $e->getMessage() );
                }
            } else {


                return view();
            }

        }


    public function doEdit(){
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $id           = input('id');
            $name         = input('name');
            $img          = input('img');
            $type         = input('type');

            try{
                $result = Db::table('deploy')->update(['id'=>$id,'name'=>$name,'img'=>$img,'type'=>$type]);
                return $this->resultHandle($result);

            }catch (\Exception $e)
            {
                return show( false, $e->getMessage() );
            }
    }else{
            (new IDMustBePositiveInt())->goCheck();
            $id = input('id/d');

            $data = Db::table('deploy')->where('id',$id)->find();
            $this->assign('data',$data);
            return view();
        }
    }
}