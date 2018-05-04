<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/31
 * Time: 10:44
 */

namespace app\common\server;


class PageServer
{
    protected $count;  //总条数
    protected $module; //模型名
    protected $page; //每页显示条数
    protected $pageNow; //第几页


    //初始化方法
    public function __construct($count, $module, $page=1, $pageNow=1)
    {
        $this->count = $count;
        $this->module = $module;
        $this->page = $page;
        $this->pageNow = $pageNow;
    }


    public function get()
    {
        $pageCount = ceil($this->count/$this->page); //计算总页数
        $html = $this->getHtml($pageCount);
        return $html;

    }


    private function getHtml ($pageCount)
    {
        if( $pageCount>0 )
        {
            //组合html数据
            $prevPage = ($this->pageNow-1) > 0 ? $this->pageNow-1 : 1;
            $nextPage = ($this->pageNow+1) > $pageCount ? $pageCount : $this->pageNow+1;
            $prevUrl = '/home/'.$this->module.'/getPageList?p='.$prevPage;
            $nextUrl = '/home/'.$this->module.'/getPageList?p='.$nextPage;
            $html = '<a class="lastpages" style="display:none;" data-href="' . $prevUrl . '"><</a>';  //首先拼接上一页的链接
            //如果总条数比每页显示条数多
            for ($i=0; $i<$pageCount; $i++ )
            {
                //循环组合html, 按照总页数
                $newUrl = '/home/'.$this->module.'/getPageList?p='.($i+1);
                $class = $this->pageNow-1 == $i ? 'on' : '';  //如果当前页数和循环中的节点相同 就说明是当前页， 就标注提示
                $html.= '<a class="pages '.$class.'" data-href="'.$newUrl.'">'.($i+1).'</a>';
            }
            if( $pageCount <= 1 )
            {
                $html .= '<a class="nextpages" style="display:none;" data-href="'.$nextUrl.'">></a>'; //最后拼接下一页的下一页的链接
            }
            else{
                $html .= '<a class="nextpages" data-href="'.$nextUrl.'">></a>'; //最后拼接下一页的下一页的链接
            }
            return $html;
        }
        else{
            return '';
        }


    }
}