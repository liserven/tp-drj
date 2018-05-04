<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/25
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\model\Deploy as DeployModel;

class Deploy extends Base
{
    public function doEdit()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
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
                (new IDMustBePositiveInt())->goCheck();
                $id = input('id/d');
                echo $id;exit;
                $data = DeployModel::find(['id' => input('id/d')]);
                var_dump($data);exit;
                $this->assign('data', $data);

                return $this->fetch();
            }

        }
    }
}