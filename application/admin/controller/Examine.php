<?php
namespace app\admin\controller;



use app\common\model\AuditingInformation;
use app\common\validate\Find;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use custom\CusLog;
use think\db;
class Examine extends Base{

    public function tolist(){
        $list = db('auditing_information')->order('id','desc')->select();
        $this->assign('page', $list);
        return $this->fetch();
    }

    public function doedit(){
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }

            $data['auditing'] = input('auditing');
            $data['content'] = input('content');


            try{
                $result = AuditingInformation::create($data);
                return $this->resultHandle($result);

            }catch (\Exception $e)
            {
                return show( false, $e->getMessage() );
            }
        } else {
            (new IDMustBePositiveInt())->goCheck();
            $data = AuditingInformation::get([ 'id'=> input('id/d')]);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }
    public function doDel( $id )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $data = AuditingInformation::get([ 'id'=>$id ]);
        if( !$data )
        {
            throw new ParameterException();
        }
        Db::startTrans();
        try{
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">'.$data->auditing.'</a>Banner');
            Db::commit();
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            Db::rollback();
            return show( false, $e->getMessage() );
        }
    }
    public function doadd(){

        if ($this->request->isPost()) {
            $data['auditing']      = input('auditing');
            $data['content']   = input('editorValue');
            try{
                $result = AuditingInformation::create($data);
                return $this->resultHandle($result);

            }catch (\Exception $e)
            {
                return show( false, $e->getMessage() );
            }
        } else {
            return $this->fetch();

        }
    }
}