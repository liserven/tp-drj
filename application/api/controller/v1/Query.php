<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/5/29
 * Time: 16:47
 */

namespace app\api\controller\v1;

use QL\QueryList;

include_once ROOT_PATH.'vendor/autoload.php' ;

class Query extends Base
{


    public function index()
    {
        $html = <<<STR
        <div id="one">
            <div class="two">
                <a href="http://querylist.cc">QueryList官网</a>
                <img src="http://querylist.com/1.jpg" alt="这是图片">
                <img src="http://querylist.com/2.jpg" alt="这是图片2">
            </div>
            <span>其它的<b>一些</b>文本</span>
        </div>        
STR;
        $rules = array(
            //采集id为one这个元素里面的纯文本内容
            'text' => array('#one','text'),
            //采集class为two下面的超链接的链接
            'link' => array('.two>a','href'),
            //采集class为two下面的第二张图片的链接
            'img' => array('.two>img:eq(1)','src'),
            //采集span标签中的HTML内容
            'other' => array('span','html')
        );
        $url = 'http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2013/54/01/540102.html';
        $data = QueryList::html($html)->rules($rules)->query()->getData();
        halt($data);
    }
}