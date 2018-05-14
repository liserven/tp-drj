<?php
namespace app\common\model;
class BuildingOrder extends BaseModel
{
    public static function getBuildPage($where = [], $rows = 10)
    {
        return self::with(['user_data'])
            ->where($where)
            ->find()
            ->paginate($rows);
    }
    public static function getOrderDetailsBuWhere($where=[], $rows=10)
    {
        return self::alias('bo')
            ->where($where)
            ->field('bo.id, bo.order_no, bo.total_price, bo.total_count, bo.snap_img, bo.snap_name,
                       bo.snap_address,  bo.create_at, bo.status, bo.payment_type,bo.message')
            ->order('id desc')
            ->paginate($rows);
    }
    public static function getOrderDetailsBuWhereFind($where=[])
    {
        return self::alias('bo')
            ->where($where)
            ->field('bo.id, bo.order_no, bo.total_price, bo.total_count, bo.snap_img, bo.snap_name,
                       bo.snap_address,bo.user_id,  bo.create_at, bo.status,bo.payment_type,bo.pay_time,bo.trade_no, bo.transaction_id, bo.cancel_reason')
            ->order('id desc')
            ->find();
    }
    public function detail()
    {
        return $this->hasOne('user_data')->field('ud_id,ud_name');

    }
}