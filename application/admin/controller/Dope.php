<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 8:56
 */

namespace app\admin\controller;

use app\common\model\Dopes;
use app\common\validate\Find;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use custom\CusLog;
use think\db;

class Dope extends Base{
      public function tolist(){
          $list = db('dopes')->order('id','desc')->paginate('15');
          $this->assign('page', $list);
          return $this->fetch();
      }
      public function doAdd(){

          if ($this->request->isPost()) {
             $data['name']      = input('name');
             $data['content']   = input('editorValue');
              try{
                  $result = Dopes::create($data);
                  return $this->resultHandle($result);

              }catch (\Exception $e)
              {
                  return show( false, $e->getMessage() );
              }
          } else {
              return $this->fetch();

          }
      }
     //修改
    public function doEdit(){

        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }

            $data['g_name'] = input('g_name');
            $data['g_price'] = input('g_price');
            $data['g_price_r'] = input('g_price_r');


            try{
                $result = Dopes::create($data);
                return $this->resultHandle($result);

            }catch (\Exception $e)
            {
                return show( false, $e->getMessage() );
            }
        } else {
            (new IDMustBePositiveInt())->goCheck();
            $data = Dopes::get([ 'id'=> input('id/d')]);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }

    //删除
      public function doDel( $id )
      {
          ( new IDMustBePositiveInt() )->goCheck();
          $data = Dopes::get([ 'id'=>$id ]);
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

  }