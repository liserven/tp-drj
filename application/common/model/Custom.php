<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/13
 * Time: 9:25
 */

namespace app\common\model;


class Custom extends BaseModel
{
    protected $autoWriteTimestamp = true; //开启时间自动写入
    protected $createTime = 'create_at';      //设置写入字段
    protected $updateTime = 'update_at';
    public function getAuSexAttr($value)
    {
        if( $value == 1){
            return  '男';
        }
        if( $value == 2){
            return  '女';
        }
        if( $value == 3){
            return  '保密';
        }
    }

    protected $visible = ['au_nickname','au_logo','au_iphone','au_id','au_sex','au_birthday','au_email','au_place'];
    /**
     * 根据条件条件分页查询
     * @param array $where
     * @param int $rows
     */
    public static function getByUserPageList( $where = [], $rows = 5 )
    {
        $data = self::alias('au')
                    ->where(self::getWhereArr($where))
                    ->order('au_id DESC')
                    ->paginate($rows);
        return $data;
    }


    public static function getUserByID($id)
    {
        $data = self::where('au_id',$id)->find();
        return $data;
    }

}