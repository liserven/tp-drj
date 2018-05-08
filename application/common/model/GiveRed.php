<?php
namespace app\common\model;

/**
 * Class GiveRed
 * @package app\common\model
 * 发红包
 */
class GiveRed extends BaseModel{

    //根据合伙人id查询红包
    public static function getGiveRedByUid($where)
    {
        return self::alias('gr')
                    ->join('__GRAB_RED__ grr', 'grr.rid=gr.id', 'left')
                    ->where($where)
                    ->field('count(distinct grr.id) as red_totals, gr.num, gr.solo, gr.word, gr.total,gr.user_id')
                    ->group('gr.id')
                    ->order('gr.id desc')
                    ->find();
    }


    public static function getGiveRedByList($where=[], $rows=3)
    {
        return self::alias('gr')
            ->join('__GRAB_RED__ grr', 'grr.rid=gr.id', 'left')
            ->join('__USER_DATA__ ud', 'ud.ud_id=gr.user_id', 'left')
            ->where($where)
            ->field('count(distinct grr.id) as red_totals,gr.id, gr.num,gr.create_at, gr.solo, gr.word, gr.total,gr.user_id, ud.ud_name, ud.ud_logo,ud.ud_phone, ud.ud_sex,ud.ud_id,ud.county')
            ->group('gr.id')
            ->order('gr.id desc')
            ->paginate($rows);
    }

    public function getUserPage(){

    }

}