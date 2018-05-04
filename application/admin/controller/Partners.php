<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/30
 * Time: 16:01
 */

namespace app\admin\controller;
use think\Db;

class Partners extends Base
{
    protected function _initialize()
    {
        $this->assign('provice', Db::table('provice')->select());
        parent::_initialize();
    }

    public function tolist (){

        //所有的合伙人
        $list = Db::table('user_data')->field('count(distinct ud_id) as totals , ud_id , province as name')->group('province')
            ->order('totals desc')->where('type','2')->paginate(10);
        $this->assign('page', $list);
        return $this->fetch();

    }

    public function getByWhere()
    {

        $province = input('get.provice');
        $city = input('get.city');
        $county = input('get.county');
        $start_time = input('start_time') ? strtotime(input('start_time') ) : '' ;
        $over_time = input('over_time') ? strtotime(input('over_time') ) : '';
        $order = input('get.order/d');
        $data = Db::table('user_data')->alias('vo');
        $where=[];
        if( !empty($province))
        {
            if( !empty($city)){

                if( !empty($county))
                {
                    $where['county'] = $county;
                    $data->field('count(distinct ud_id) as totals, vo.ud_id, vo.town as name');
                    $data->group('town');

                }
                $where['city'] = $city;
                $data->field('count(distinct ud_id) as totals, vo.ud_id, vo.county as name');
                $data->group('county');

                goto a;
            }

            $where['province'] = $province;
            $data->field('count(distinct ud_id) as totals, vo.ud_id, vo.city as name');
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