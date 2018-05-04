<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/11
 * Time: 16:17
 */

namespace app\admin\controller;

use app\common\lib\Upload;
use app\common\model\Link as LinkModel;
use app\common\validate\IDMustBePositiveInt;
use app\common\validate\LinkValidate;
use app\lib\exception\ParameterException;
use custom\CusLog;

/**
 * Class Link
 * @package app\admin\controller
 * 友情链接控制器
 */
class Link extends Base
{


    /**
     * @url admin\Duty\toList
     *链接列表页
     */
    public function toList()
    {
        $where['seach'] = input('seach') ? input('seach') : '';
        $page = LinkModel::getPage($where);
        $this->assign('page', $page);
        return $this->fetch();
    }

    /**
     * @url admin\Duty\doAdd
     *链接添加方法
     */
    public function doAdd()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $data = input('post.');
            if( $this->request->file( ))
            {
                $imgStr = Upload::image();
                $data['logo'] = $imgStr;
            }
            (new LinkValidate())->goCheck($data);
            try {
                $result = LinkModel::create($data);
                echo "<script>
                            window.parent.location.reload();
                    </script>";
            } catch (\Exception $e)
            {
                $this->success($e->getMessage(), 'doAdd');
            }
        } else {
            return $this->fetch();
        }
    }

    /**
     * @url admin\Duty\doEdit
     *链接修改方法
     */
    public function doEdit()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }
            $data = input('post.');
            if( $this->request->file( ))
            {
                $imgStr = Upload::image();
                $data['logo'] = $imgStr;
            }
            (new LinkValidate())->goCheck($data);
            try {
                $result = LinkModel::update($data);
                echo "<script>
                            window.parent.location.reload();
                    </script>";
            } catch (\Exception $e)
            {
                $this->error($e->getMessage(), 'doAdd');
            }
        } else {
            (new IDMustBePositiveInt())->goCheck();
            $id = input('id');
            $this->assign('data', LinkModel::get($id));
            return $this->fetch();
        }
    }


    /**
     * @url admin\Duty\doDel
     *链接删除方法
     */
    public function doDel($id)
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $data = LinkModel::get([ 'id'=>$id ]);
        if( !$data )
        {
            throw new ParameterException();
        }
        try{
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">'.$data->title.'</a>Banner');
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            return show( false, $e->getMessage() );
        }
    }

    public function editStatus($id, $state)
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $data = LinkModel::get([ 'id'=>$id ]);
        if( !$data )
        {
            throw new ParameterException();
        }
        $content = $state == 1 ? '启用了 -'.$data->title.'- 链接' : '停用了 - <a class="c-red">'.$data->title.'-</a> 链接';
        try{
            $data->status = $state;
            $result = $data->save();
            CusLog::writeLog($this->User['am_id'], $content);
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            return show( false, $e->getMessage() );
        }
    }

    public function editOrder($id, $order)
    {

        ( new IDMustBePositiveInt() )->goCheck();
        $data = LinkModel::get([ 'id'=>$id ]);
        if( !$data )
        {
            throw new ParameterException();
        }
        try{
            $data->order = $order;
            $result = $data->save();
            CusLog::writeLog($this->User['am_id'], '修改了 <a class="c-red">'.$data->title.'</a>排序,结果为'.$order);
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            return show( false, $e->getMessage() );
        }
    }

}