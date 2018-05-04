<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 9:27
 */

namespace app\admin\controller;


use app\common\model\Orfrom;
use app\common\model\VillaOrder;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\ParameterException;
use custom\CusLog;
use think\Db;

class Ordlist extends Base{

    public function tolist(){

        $ordlist = db('villa_order')->select();


        foreach ($ordlist as $k=>$val){
           $data[$k] = db('user_data')->where('ud_id',$val['user_id'])->find();
           $ordlist[$k]['user_id'] = $data[$k]['ud_name'];
           $list[$k] = db('user_data')->where('ud_id',$val['partner_id'])->find();

           $ordlist[$k]['partner_id'] = $list[$k]['ud_name'];
        }


        $this->assign([
            'page' => $ordlist,

            ]

        );
        return $this->fetch();
    }
    //订单删除
    public function doDel( $id )
    {
        ( new IDMustBePositiveInt() )->goCheck();
        $data = VillaOrder::get([ 'id'=>$id ]);
        if( !$data )
        {
            throw new ParameterException();
        }
        Db::startTrans();
        try{
            $result = $data->delete();
            CusLog::writeLog($this->User['am_id'], '删除了 <a class="c-red">'.$data->id.'</a>Banner');
            Db::commit();
            return $this->resultHandle($result);
        }catch ( \Exception $e ){
            Db::rollback();
            return show( false, $e->getMessage() );
        }
    }

}
