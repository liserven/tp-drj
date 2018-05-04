<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/9
 * Time: 10:02
 */

namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true; //开启时间自动写入
    protected $createTime = 'create_at';      //设置写入字段
    protected $updateTime = 'update_at';

    private static $whereCondtion;


    //判断查询条件是否为空
    protected static function getWhereArr($where)
    {
        if( is_array($where) )
        {
            foreach( $where as $key=>$val )
            {
                if( !empty($val) )
                {
                    self::$whereCondtion[$key] = $val;
                }
            }
        }
        else if (is_string($where)){
            self::$whereCondtion = $where;
        }
        return self::$whereCondtion;
    }
}