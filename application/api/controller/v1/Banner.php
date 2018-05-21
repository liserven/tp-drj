<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 18:47
 */

namespace app\api\controller\v1;

use app\lib\exception\ParameterException;
use think\Request;
use app\common\model\Banner as BannerModel;

/**
 * Class Banner
 * @package app\api\controller\v1
 * 广告位控制器
 */
class Banner extends Base
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    //首页Banner位
    public function indexBanner()
    {
        $banners = BannerModel::getBannerList([], 3);
        if( empty($banners) )
        {
            throw new ParameterException();
        }
        return show(true, '', $banners);
    }

    public function aaa()
    {
    }

}
