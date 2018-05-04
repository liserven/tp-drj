<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/28
 * Time: 14:46
 */

namespace app\admin\controller;

use think\Db;

class Consumers extends Base
{

    protected function _initialize()
    {
        $this->assign('provice', Db::table('provice')->select());
        parent::_initialize();
    }

    public function  analyse(){

        //所有的客户订单
        $list = Db::table('villa_order')->field('count(distinct id) as totals , id , provice as name')->group('provice')
            ->order('totals desc')->paginate(10);
        $this->assign('page', $list);
        return $this->fetch();

    }

    public function getByWhere()
    {

        $provice = input('get.provice');
        $city = input('get.city');
        $county = input('get.county');
        $start_time = input('start_time') ? strtotime(input('start_time') ) : '' ;
        $over_time = input('over_time') ? strtotime(input('over_time') ) : '';
        $order = input('get.order/d');
        $data = Db::table('villa_order')->alias('vo');
        $where=[];
        if( !empty($provice))
        {
            if( !empty($city)){

                if( !empty($county))
                {
                    $where['county'] = $county;
                    $data->field('count(distinct id) as totals, vo.id, vo.town as name');
                    $data->group('town');

                }
                $where['city'] = $city;
                $data->field('count(distinct id) as totals, vo.id, vo.county as name');
                $data->group('county');

                goto a;
            }

            $where['provice'] = $provice;
            $data->field('count(distinct id) as totals, vo.id, vo.city as name');
            $data->group('city');
            goto a;
        }

        a:

        $data->where($where);
        if( $start_time )
        {
            if( !$over_time )
            {
                $over_time = time();
            }
            $data->where('create_at', 'between', [$start_time, $over_time ]);
        }
        if( $order == 1 )
        {
            $data->order('totals asc');
        }
        else{
            $data->order('totals desc');
        }

        $result = $data->paginate(10);
        $this->assign( 'page', $result);

        if( $result->isEmpty() )
        {
            $is_empty = true;
        }
        else{
            $is_empty = false;
        }
        return json([
            'is_empty'=> $is_empty,
            'html'=> $this->fetch(),
        ]);
    }
}