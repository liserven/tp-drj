<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/4/27
 * Time: 11:10
 */

namespace app\admin\controller;

use app\common\model\City;
use app\common\validate\IDMustBePositiveInt;


class District extends Base
{
    public function tolist()
    {
        if ($this->request->isPost()) {
            if (!$this->_checkAction()) {
                return $this->ajaxShow(false, '无权此操作');
            }

        }else{
            $province  = db('provice')->select();

            $two   = db('city')->where('province_id', $province[0]['provice_id'])->select();
            $this->assign([
                'province' => $province,
                'two'=> $two,

            ]);

            return $this->fetch();
        }
    }

    public function getsortbypid($provice_id)
    {
        $data =City::all(['province_id'=> $provice_id]);

        $this->assign('data', $data);

        $data = [
            'partner_limit'=> $data[0]['partner_limit'],
            'html'=> $this->fetch()
        ];
        return json_encode($data);
    }

    public function getSet($provice_id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $data = City::all(['$provice_id'=> $provice_id]);
        $this->assign('set', $data);
        return $this->fetch();
    }

    public function doEdit()
    {
        if( $this->request->isPost())
        {
            (new IDMustBePositiveInt())->goCheck();
            $data = [
                'id'=> input('post.id/d'),
                'partner_limit' => input('post.partner_limit/d')
            ];
            (new IDMustBePositiveInt())->goCheck($data);
            return $this->resultHandle(City::update($data));

        }
    }
    public function getCityLimit($id)
    {

        (new IDMustBePositiveInt())->goCheck();
        $data =City::get($id);
        return $data->partner_limit;

    }

}