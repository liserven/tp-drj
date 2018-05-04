<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
//首页Banner位
Route::get('api/:version/i_banner', 'api/:version.Banner/indexBanner');
Route::get('api/:version/need', 'api/:version.User/getNeed');
Route::post('api/:version/edit_need', 'api/:version.User/editNeed');


//建材分类
Route::get('api/:version/l_sort', 'api/:version.Sort/getOneSort');
Route::get('api/:version/get_t_sort', 'api/:version.Sort/getTwoSort');




Route::get('api/:version/i_d_villa', 'api/:version.Index/indexRecommendVillaDz');
Route::get('api/:version/i_b_villa', 'api/:version.Index/indexRecommendVillaBz');
Route::get('api/:version/i_b_building', 'api/:version.Index/indexRecommendBuilding');

//首页合伙人列表
Route::get('api/:version/i_partner', 'api/:version.Index/getPartnerList');
//游客获取合伙人随机列表
Route::get('api/:version/i_partner_rand', 'api/:version.Index/getPartnerListRand');




//申请成为合伙人
Route::post('api/:version/apply_partner','api/:version.Partner/applyPartner');
Route::post('api/:version/apply_partner_code','api/:version.Partner/applyPartnerCode');
//合伙人支付成功返回支付宝通知接口
Route::rule('/partner_zfb_notify', 'api/v1.Partner/applyPartnerAliNotify');
//合伙人申请支付成功微信返回通知接口
Route::post('/partner_wx_notify','api/v1.Partner/applyPartnerNotify');
Route::post('api/:version/check_repeat','api/:version.Partner/checkRepeat');


//查询物流接口
Route::get('api/:version/get_wuliu','api/:version.KdNiao/findKd');



//首页消息位
Route::get('api/:version/chat_list', 'api/:version.Index/getChatList');
Route::post('api/:version/haircode','api/:version.Login/smsCode'); //注册发送手机验证码
Route::post('api/:version/echohome','api/:version.Login/echohome'); //注册发送手机验证码
Route::post('api/:version/editpass_haircode','api/:version.Login/editPasswordPhoneCode');  //重置密码手机验证码
Route::post('api/:version/editpass','api/:version.Login/editPass');  //重置密码
//修改个人资料
Route::post('api/:version/editinfo','api/:version.User/editInfo');
Route::post('api/:version/feed_back','api/:version.User/addFeedback');
//修改logo
Route::post('api/:version/editlogo','api/:version.User/editLogo');
//重置密码
Route::post('api/:version/addfeedback','api/:version.User/addFeedback');
//登录注册
Route::post('api/:version/login','api/:version.Login/login');
Route::post('api/:version/register','api/:version.Login/register');
//微信QQ登录 返回时 请求验证openid是否需要绑定手机号 如果已经存在 直接返回token
Route::post('api/:version/check_openid','api/:version.Login/checkOpenId');

//微信登录
Route::post('api/:version/wx_login','api/:version.Login/WxLogin');

//QQ登录
Route::post('api/:version/qq_login','api/:version.Login/QQLogin');



/*  合伙人 */
//获取所有客户列表 按时间最新排序
Route::get('api/:version/customs', 'api/:version.Partner/getCustomer');
Route::post('api/:version/apply_partner', 'api/:version.Partner/applyPartner');
//合伙人获取个人名片
Route::get('api/:version/gettcard', 'api/:version.Partner/getPartnerCard');
Route::post('api/:version/p_phone', 'api/:version.Partner/partnerPhoneUser' ); //合伙人打电话动作
Route::post('api/:version/binding_user', 'api/:version.Partner/PartnerBindingUser' ); //合伙人发起绑定请求
Route::post('api/:version/like_partner', 'api/:version.Partner/setPartnerLike' ); //合伙人点赞
Route::post('api/:version/star_partner', 'api/:version.Partner/setPartnerScore' ); //合伙人评分
//获取合伙人统计信息
//用户接收绑定消息
Route::get('api/:version/eum_list', 'api/:version.Notice/partnerUserEnm');
//用户确定绑定关系接口
Route::post('api/:version/confirm_binding', 'api/:version.User/confirmBinding' );

//合伙人修改状态接口
Route::post('api/:version/qy_partner', 'api/:version.PartnerUser/editPartnerUserStatus' );

//用户给合伙人打电话接口
Route::post('api/:version/u_p_phone', 'api/:version.Phone/userCallPhone' );

//系统消息
Route::get('api/:version/notices', 'api/:version.Notices/notices');






/*  建材  */
// 获取建材列表
Route::get('api/:version/l_building', 'api/:version.Building/getBuildingList'); //获取建材详情 带规格图片
// 获取建材详情
Route::get('api/:version/d_building', 'api/:version.Building/getBuildingDetailById'); //获取建材详情 带规格图片
// 加入购物车
Route::post('api/:version/building_cart_add', 'api/:version.Building/addShoppingCart'); //添加购物车
Route::post('api/:version/building_cart_del', 'api/:version.Building/delShoppingCart'); //删除购物车内容
//查询购物车内容
Route::get('api/:version/building_cart_list', 'api/:version.Building/getShoppingCart');

//建材提交订单
Route::post('api/:version/o_report_building', 'api/:version.Order/reportOrder');


// 购买
//建材收藏
Route::post('api/:version/building_collection', 'api/:version.Building/buildingCollection');
Route::post('api/:version/del_b_collections', 'api/:version.Collection/delBuildingCollections');
Route::get('api/:version/c_building', 'api/:version.Collection/getUserBuildingConnection'); //获取收藏建材列表

//订单
//别墅订单
Route::get('api/:version/o_villa', 'api/:version.Order/getOrderByVilla'); //获取收藏建材列表





//支付宝建材支付
Route::post('api/:version/ali_pay_building', 'api/:version.Pay/aliPay');
Route::post('/ali_pay_building_notify', 'api/v1.Pay/buildingAliPayNotify');

//支付宝查询
Route::get('/zfb_find', 'api/v1.AliPay/getAliPayInfoByTradeNo');
//支付宝退款接口
Route::post('/zfb_refund', 'api/v1.AliPay/AliPayRefundByTradeNo');


/**
 * 购买   ：  微信
 */
Route::post('api/:version/wx_pay', 'api/:version.Pay/payBuildingByWx');
Route::post('api/:version/wx_notify', 'api/:version.Pay/payBuildingByWxNotify');

//获取合伙人费用
Route::get('api/:version/partner_money', 'api/:version.Partner/getPartnerMoney');




//建材订单
Route::get('api/:version/o_building', 'api/:version.Order/getOrderByBuilding'); //查询订单
Route::post('api/:version/cancel_order', 'api/:version.Order/cancelBuildingOrder'); //取消订单
Route::post('api/:version/del_building_order', 'api/:version.Order/delBuildingOrder'); //订单
//查询订单详情

Route::get('api/:version/o_building_d', 'api/:version.Order/getOrderDetailBuilding'); //查询订单详情


/*  商城  */
// 获取别墅列表
Route::get('api/:version/villas', 'api/:version.Villa/getVillas');
// 获取别墅详情
Route::get('api/:version/villa_detail', 'api/:version.Villa/getVillaData');

//收藏别墅
Route::post('api/:version/coll_villa', 'api/:version.Villa/villaCollection');


// 别墅收藏
Route::get('api/:version/c_villa', 'api/:version.Collection/getUserVillaCollection');
Route::post('api/:version/del_v_collection', 'api/:version.Collection/delVillaCollections');
/*  个人中心  */
Route::get('api/:version/user_info', 'api/:version.User/getUserInfo');
//修改用户信息
Route::post('api/:version/edit_info', 'api/:version.User/editInfo');
//修改用户logo
Route::post('api/:version/edit_logo', 'api/:version.User/editLogo');
Route::post('api/:version/set_push', 'api/:version.User/setUserPush');
// 修改资料
//收货地址管理
Route::get('api/:version/address', 'api/:version.User/getAddressList'); //用户地址
Route::post('api/:version/add_address', 'api/:version.User/addAddress'); //添加地址
Route::post('api/:version/edit_address', 'api/:version.User/editAddress'); //修改地址
Route::post('api/:version/del_address', 'api/:version.User/delAddress'); //删除地址
Route::post('api/:version/set_address_default', 'api/:version.User/editAddressDefault'); //删除地址


//用户反馈
Route::post('api/:version/feedback', 'api/:version.User/Feedback');



/*  用户  */
/*  聊天  */
/* 红包
*/
Route::post('api/:version/add_packet', 'api/:version.Packets/launchPackets'); //发起红包
Route::get('api/:version/l_packet', 'api/:version.Packets/findPartner'); //发起红包
Route::post('api/:version/receive_packet', 'api/:version.Packets/receivePackets'); //领取红包
Route::post('api/:version/give_packet', 'api/:version.Packets/givePackets'); //赠送红包
Route::get('api/:version/f_packet', 'api/:version.Packets/getPacketsByDz'); //查看红包列表
Route::get('api/:version/g_packet', 'api/:version.Packets/getMyGiveRed'); //查看我赠送的红包
Route::get('api/:version/r_packet', 'api/:version.Packets/getMyReceiveRed'); //查看我接受的红包
Route::get('api/:version/u_packets', 'api/:version.Packets/getUserPackets'); //查看我接受的红包
Route::get('api/:version/packets_detail', 'api/:version.Packets/getPacketsDetailById'); //查看红包详情
Route::post('api/:version/red_use', 'api/:version.Packets/redUse'); //发起红包使用命令
//合伙人确认使用红包
Route::post('api/:version/partner_red_confirm', 'api/:version.Packets/partnerConfirmRed'); //合伙人确认使用红包

//合伙人查询使用红包列表
Route::get('api/:version/partner_red_confirm_list', 'api/:version.Partner/redConfirm'); //合伙人查询使用红包列表

//合伙人潜在客户列表
Route::get('api/:version/potential_customers', 'api/:version.Partner/potentialCustomers'); //合伙人潜在客户列表



//砍价
Route::post('api/:version/l_bargain', 'api/:version.Bargain/launchBargain'); //发起砍价
Route::get('/h_bargain_view/:id', 'index/Bargain/helpBargainView'); //帮忙砍价页面
Route::post('/h_bargain', 'api/v1.Bargain/helpBargain'); //帮忙砍价接口
Route::get('api/:version/m_bargain', 'api/:version.Bargain/myBargain'); //查询我的砍价
Route::get('api/:version/c_bargain', 'api/:version.Bargain/getBargainConfig'); //查询砍价配置
Route::post('/h_bargain_code', 'api/v1.Login/helpBargainPhoneCode'); //砍价接口发送验证码


//极光推送api
Route::post('api/:version/jpush', 'api/v1.Push/push'); //砍价接口发送验证码


//微信退款接口
Route::post('/refund', 'api/v1.Refund/wxRefund');
//微信查询订单
Route::get('/wx_quert_find', 'api/v1.Pay/reFind');


//消息
Route::get('api/:version/u_notice', 'api/:version.Notice/noticeList');



//搜索
Route::get( 'api/:version/search', 'api/:version.Index/search');

//分享
Route::get('share/red', 'index/Share/red');
Route::get('share/card', 'index/Share/card');
Route::get('share/home', 'index/Share/home');
Route::get('share/building', 'index/Share/index');







//后台路由
Route::get('/find_ali_status', 'admin/Partner/aliPayFind'); //查询我的砍价


//距离
Route::get('api/:version/geo', 'api/:version.Geo/index');


//获取地址
Route::get('api/:version/l_provice', 'api/:version.City/getProvice');
Route::get('api/:version/l_city', 'api/:version.City/getCity');
Route::get('api/:version/l_county', 'api/:version.City/getCounty');
Route::get('api/:version/l_town', 'api/:version.City/getTown');















