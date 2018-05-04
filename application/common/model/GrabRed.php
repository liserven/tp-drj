<?php

namespace app\common\model;


class GrabRed extends BaseModel
{


    public static function getPage($where = [], $rows = 10)
    {
        return self::alias('gb')
                    ->join('__USER_DATA__ ud', 'ud.ud_id=gb.partner_id', 'left')
                    ->join('__GIVE_RED__ gr', 'gr.id=gb.rid', 'left')
                    ->where($where)
                    ->field('ud.ud_name, ud.ud_logo, ud.ud_phone, ud.ud_sex, ud.ud_id, gr.solo, gr.word, gr.num,ud.county,gb.create_at, gr.id, ud.city, ud.town
                    ')
                    ->paginate($rows);
    }


    public static function getPacketsByFind($where=[])
    {
        return self::alias('gb')
            ->join('__USER_DATA__ ud', 'ud.ud_id=gb.partner_id', 'left')
            ->join('__GIVE_RED__ gr', 'gr.id=gb.rid', 'left')
            ->where($where)
            ->field('ud.ud_name, ud.ud_logo, ud.ud_phone, ud.ud_sex, ud.ud_id, gr.solo, gr.word, gr.num,ud.county,gb.create_at, gr.id, ud.city, ud.town
                    ')
           ->find();
    }
}