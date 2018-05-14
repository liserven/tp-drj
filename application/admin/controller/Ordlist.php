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

        $ordlist = Db::table('villa_order')->paginate('15')->each(function($item,$key){
            $item = db('user_data')->where('ud_id',$item['user_id'])->find();
            $item['user_id'] = $item['ud_name'];
            $item = db('user_data')->where('ud_id',$item['partner_id'])->find();
            $item['partner_id'] =  $item['ud_name'];
            return $item;
        });





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
