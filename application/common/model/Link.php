<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/11
 * Time: 16:14
 */

namespace app\common\model;

/**
 * Class Link
 * @package app\common\model
 * 友情链接模型层
 */
class Link extends BaseModel
{

    public static function getPage($where=[], $rows=10 )
    {
        return self::where(self::getWhereCondtion($where))
                    ->paginate($rows);
    }

    public static function getLinkList($where=[])
    {
        return self::select();
    }


    private static function getWhereCondtion($where=[])
    {
        $map = [];
        if( !empty($where['seach']) )
        {
            $map['name'] = [ 'like', '%'.$where['seach'].'%'];
        }
        return $map;
    }
}