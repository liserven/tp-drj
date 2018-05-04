<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"D:\phpStudy\WWW\zgmrw\public/../application/home\view\index\index.html";i:1517534367;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\layout.html";i:1517304201;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\header.html";i:1517566734;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\footer.html";i:1517566734;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>国民健康美容网</title>
    <link href="https://cdn.bootcss.com/Swiper/4.0.7/css/swiper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="__CSS__/<?php echo $mName; ?>/bootstrap.min.css">
    <link rel="stylesheet" href="__CSS__/<?php echo $mName; ?>/detail.css">
    <link rel="stylesheet" href="__CSS__/<?php echo $mName; ?>/animate.css">
    <link rel="stylesheet" href="__CSS__/<?php echo $mName; ?>/style.css">
    <link rel="stylesheet" href="__CSS__/<?php echo $mName; ?>/element.min.css">
    <link rel="stylesheet" href="__CSS__/<?php echo $mName; ?>/example.css"><!-- 美化下拉窗口 -->
    <!-- <link rel="stylesheet" href="../../public/css/index.sass"> -->
</head>

<body>
<div class="main-container">
    <header>
        <div class="row-rotuer">
            <a class="float-left col-md-3 padding-none" href="<?php echo url('home/Index/index'); ?>">
                <img src="__ROOT__/Image/showindex-logo.png" alt="">
            </a>
            <ul class="rightcontent float-right col-md-5 padding-none">
                <li class="float-left">
                    <input type="text" placeholder="眼部整形" />
                    <a href="#">
                        <img src="__ROOT__/Image/indexsearch-icon.png" alt="">
                    </a>
                </li>
                <li class="float-left downloadrightcode">
                    <a class="rightcode on" href="">客户端下载</a>
                    <a class="rightcode" href="">微信公众号</a>
                </li>
                <li class="float-right">
                    <a>
                        <img src="__ROOT__/Image/personaladmin.png" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <nav>
        <div class="row-rotuer">
            <ul class="nextnav">
                <li class="col-md-10 float-left">
                    <a  <?php if($cName == 'Index'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Index/index'); ?>">首页</a>
                    <a <?php if($cName == 'Policies'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Policies/tolist'); ?>">政策法规</a>
                    <a <?php if($cName == 'Meeting'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Meeting/index'); ?>">会议</a>
                    <a <?php if($cName == 'Cosmetology'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Cosmetology/index'); ?>">美容科普</a>
                    <a <?php if($cName == 'Industrydynamic'): ?>class="on" <?php endif; ?> href="/Industrydynamic_index/3">行业动态</a>
                    <a <?php if($cName == 'Hospital'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Hospital/index'); ?>">医院</a>
                    <a <?php if($cName == 'Supplier'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Supplier/index'); ?>">供应商</a>
                    <a <?php if($cName == 'Doctor'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Doctor/index'); ?>">医生</a>
                    <a <?php if($cName == 'training'): ?>class="on" <?php endif; ?> href="<?php echo url('home/training/index'); ?>">人才培训</a>
                    <a <?php if($cName == 'Review'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Review/index'); ?>">评审认证</a>
                </li>
                <li class="col-md-2 float-right text-right">
                    <button>标准联盟</button>
                </li>
            </ul>
        </div>
    </nav>
    <div style="height:120px;"></div>

		<div class="indexshowcontent">
			<div class="row-rotuer indexshowlogo">
				<div class="messageleft">
					<div class="box">
						<ul class="col-md-4 swiper-container float-left">
							<div class="swiper-wrapper">
								<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($banner) ? array_slice($banner,1,3, true) : $banner->slice(1,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<div class="swiper-slide lunindex">
										<a href="<?php echo $vo['url']; ?>" target="_blank">
											<img src="<?php echo $vo['img']; ?>" alt="">
										</a>
										<div class="imagetitle"><?php echo $vo['title']; ?></div>
									</div>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</ul>
						<ul class="col-md-7 swiper-container float-right" style="width: 61.3333%;">
							<div class="swiper-wrapper">
                                <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($banner) ? array_slice($banner,4,6, true) : $banner->slice(4,6, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <div class="swiper-slide lunindex on">
                                        <a href="<?php echo $vo['url']; ?>" target="_blank">
                                            <img src="<?php echo $vo['img']; ?>" alt="">
                                        </a>
                                        <div class="imagetitle"><?php echo $vo['title']; ?></div>
                                    </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</ul>
						<ul class="col-md-4 swiper-container float-left">
							<div class="swiper-wrapper">
                                <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($banner) ? array_slice($banner,7,9, true) : $banner->slice(7,9, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <div class="swiper-slide lunindex">
                                        <a href="<?php echo $vo['url']; ?>" target="_blank">
                                            <img src="<?php echo $vo['img']; ?>" alt="">
                                        </a>
                                        <div class="imagetitle"><?php echo $vo['title']; ?></div>
                                    </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</ul>
					</div>

					<!-- 行业资讯 -->
					<div class="sublmist">
						<?php if(is_array($news) || $news instanceof \think\Collection || $news instanceof \think\Paginator): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<ul class="col-md-4 float-left">
								<li>
									<dt>
										<h3>
											<?php echo $vo['name']; ?></h3>
										<dd class="littletitle">
											<a class="tabon active">市场</a>
											<a class="on">|</a>
											<a class="tabon">国际</a>
											<a class="on">|</a>
											<a class="tabon">技术</a>
										</dd>
									</dt>
									<div>
										<div class="tabindexs">
											<img width="100%" height="141px" src="__ROOT__/Image/sublmist-list0.png" alt="">
											<div class="imagetitle">1化妆品卫生监督条例实施细则</div>
											<div class="imagecontent">
												<dd>
													<a href="">·美容美发行业管理暂行办法</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理办法</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理调理</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理调理</a>
												</dd>
											</div>
										</div>
										<div class="tabindexs active">
											<img width="100%" height="141px" src="__ROOT__/Image/sublmist-list0.png" alt="">
											<div class="imagetitle">2化妆品卫生监督条例实施细则</div>
											<div class="imagecontent">
												<dd>
													<a href="">·美容美发行业管理暂行办法</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理办法</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理调理</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理调理</a>
												</dd>
											</div>
										</div>
										<div class="tabindexs active">
											<img width="100%" height="141px" src="__ROOT__/Image/sublmist-list0.png" alt="">
											<div class="imagetitle">3化妆品卫生监督条例实施细则</div>
											<div class="imagecontent">
												<dd>
													<a href="">·美容美发行业管理暂行办法</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理办法</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理调理</a>
												</dd>
												<dd>
													<a href="">·医疗美容服务管理调理</a>
												</dd>
											</div>
										</div>
									</div>
								</li>
							</ul>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>

					<!--<div id="myVue">-->
						<!--<template>-->
							<!--<el-tabs v-model="activeName" @tab-click="handleClick">-->
								<!--<el-tab-pane label="用户管理" name="first">用户管理1</el-tab-pane>-->
								<!--<el-tab-pane label="配置管理" name="second">配置管理</el-tab-pane>-->
								<!--<el-tab-pane label="角色管理" name="third">角色管理</el-tab-pane>-->
								<!--<el-tab-pane label="定时任务补偿" name="fourth">定时任务补偿</el-tab-pane>-->
							<!--</el-tabs>-->
						<!--</template>-->
					<!--</div>-->

					<!-- 医美机构导航 -->
					<img class="doctorbeauty" width="100%" height="108px" src="__ROOT__/Image/doctorbeauty.png" alt="">

					<!-- 专家推荐 -->
					<div class="recommendation">
						<h3 class="titlename">
							<div></div>
							<span>专家</span>推荐</h3>
						<div class="recommendationcontent">
                            <?php if(is_array($expert) || $expert instanceof \think\Collection || $expert instanceof \think\Paginator): $i = 0; $__LIST__ = $expert;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <ul class="col-md-3 float-left">
                                    <li class="on list flipou">
										<a href=""><img width="100%" height="164px" src="<?php echo $vo['zgz_img']; ?>" alt=""></a>
                                        <dt>
                                            <b><?php echo $vo['name']; ?></b>
                                            <span><?php echo $vo['current_post']; ?></span>
                                        </dt>
                                        <dd><?php echo $vo['hospital']; ?></dd>
                                        <div style="width: 90%;height: 1px;background-color: #eeeeee;margin: 14px auto 0;"></div>
                                        <p>
											<?php if(is_array($vo['projects']) || $vo['projects'] instanceof \think\Collection || $vo['projects'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['projects'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
												<a><?php echo $v['project']['name']; ?></a>
											<?php endforeach; endif; else: echo "" ;endif; ?>
                                        </p>
                                    </li>
                                    <li class="hositry list flipou out">
                                        <h3><?php echo $vo['name']; ?></h3>
                                        <span><?php echo $vo['current_post']; ?></span>
                                        <div style="clear: both;"></div>
                                        <p class="s1"><?php echo $vo['hospital']; ?></p>
                                        <p class="s2"><?php echo $vo['message']; ?></p>
                                        <div style="width: 90%;height: 1px;background-color: #fff;margin: 27px auto 0;"></div>
                                        <p class="s3">
											<?php if(is_array($vo['projects']) || $vo['projects'] instanceof \think\Collection || $vo['projects'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['projects'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                            <a><?php echo $v['project']['name']; ?></a>
											<?php endforeach; endif; else: echo "" ;endif; ?>
                                        </p>
                                    </li>
                                </ul>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>

					<!-- 友情链接 -->
					<div class="friendshiplink">
						<h3 class="titlename lineheight">
							<div style="margin-right: 17px;margin-top: 2px;"></div>
							<span>友情</span>链接</h3>
						<ul class="links">
                            <?php if(is_array($youqing) || $youqing instanceof \think\Collection || $youqing instanceof \think\Paginator): $i = 0; $__LIST__ = $youqing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>


<div class="newsright">
    <?php if($cName == 'Index'): ?>
    <ul class="navlist" id="summary1">
        <li>
            <a>指导单位 :</a>
            <br>
            <span>国家卫生计生委人口文化发展中心</span>
        </li>
        <li>
            <a>支持单位 :</a>
            <br>
            <span>国家卫生计生委人口文化发展中心</span>
        </li>
        <li>
            <a>支持单位 :</a>
            <br>
            <span>国家卫生计生委人口文化发展中心</span>
            <span>家庭健康专业委员会</span>
            <span>中国卫生信息和健康医疗大数据学会</span>
            <span>整形美容专业委员会</span>
        </li>
    </ul>
    <?php endif; ?>
    <!-- 专家认证 -->
    <?php if($cName == 'Doctor'): ?>
        <div class="authentication">
            <a href="">专家认证</a>
        </div>
    <?php endif; ?>
    <!-- 专家认证 -->
    <?php if($cName == 'Hospital'): ?>
        <div class="applehospital">
            <a href="">美容机构认证</a>
        </div>
    <?php endif; ?>
    <!-- 美业头条 -->
    <ul class="headlines" id="summary2">
        <li>
            <dt class="linesheader">美业
                <span>头条</span>
                <a>更多</a>
            </dt>
            <?php if(is_array($headline) || $headline instanceof \think\Collection || $headline instanceof \think\Paginator): $i = 0; $__LIST__ = $headline;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <dd class="">
                    <a href=""><?php echo $vo['title']; ?></a>
                    <br>
                    <span>3小时前</span>
                </dd>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </li>
    </ul>

    <!-- 申请加入联盟 -->
    <div class="applyunion">
        <a href="">申请加入联盟</a>
    </div>

    <!-- 会议报名 -->
    <ul class="mettingchart" id="summary3">
        <li>
            <dt class="linesheader">会议
                <span>报名</span>
                <a>更多</a>
            </dt>
            <?php if(is_array($meeting) || $meeting instanceof \think\Collection || $meeting instanceof \think\Paginator): $i = 0; $__LIST__ = $meeting;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <dd>
                    <p>
                        <span>10</span>
                        <br>3月</p>
                    <a href=""><?php echo $vo['title']; ?>
                        <br>
                        <span><?php echo $vo['city']; ?></span>
                    </a>
                </dd>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </li>
    </ul>

    <!-- 50强评选申请 -->
    <div class="strongapply">
        <a href="">2018年机构50强评选申请</a>
    </div>

    <!-- 医美乐普 -->
    <ul class="cedicalcommon-sense" id="summary4">
        <li>
            <dt class="linesheader">医美
                <span>科普</span>
            </dt>
            <dd>
                <a href="">微整形</a>
                <a href="">眼部</a>
                <a href="">鼻部</a>
                <a href="">眉部</a>
                <a href="">口唇</a>
                <a href="">牙齿</a>
                <a href="">胸部</a>
                <a href="">耳部</a>
                <a href="">私密</a>
                <a href="">皮肤</a>
                <a href="">瘦身塑形</a>
                <a href="">面部轮廓</a>
                <a href="">毛发</a>
            </dd>
        </li>
    </ul>
</div>
</div>

<!-- 通用底部 -->
<footer>
    <ul class="row-rotuer">
        <li class="float-left leftmessage">
            <h3 class="aboutletus">
                <a href="">关于我们</a>
                <a href="">美容网团队</a>
                <a href="">加入我们</a>
                <a href="">诚聘英才</a>
            </h3>
            <p>
                <a>市场合作：haungwq0926@163.com</a> |
                <a>求职应聘：zelong_dai@163.com</a>
            </p>
            <dd>国民健康美容网全国统一热线：010-254125（工作时间：周一至周五9：30-18:30）</dd>
            <dd>地址：北京市丰台区菜户营天伦北里小区7号楼</dd>
            <dd>国民健康美容网 版权所有 版权所有Copyright © 1998 - 2018 Tencent. All Rights Reserved</dd>
        </li>
        <li class="float-right secondcode">
            <dd>
                <img src="__ROOT__/Image/secondcode-icon.png" alt="">
                <br>
                <a>下载美容网客户端</a>
            </dd>
            <dd>
                <img src="__ROOT__/Image/secondcode-icon.png" alt="">
                <br>
                <a>关注微信公众号</a>
            </dd>
        </li>
    </ul>
</footer>
</div>
</body>
<script src="__JS__/<?php echo $mName; ?>/jquery.min.js"></script>
<script src="__JS__/<?php echo $mName; ?>/swiper.min.js"></script>
<script src="__JS__/<?php echo $mName; ?>/jquery.js"></script>
<script src="__JS__/<?php echo $mName; ?>/scrollfix.js"></script>
<script src="__JS__/<?php echo $mName; ?>/main.js"></script>
<script src="__JS__/<?php echo $mName; ?>/jquery.dropkick-min.js"></script><!--/美化下拉窗口-->
<script src="http://www.jq22.com/jquery/vue.min.js"></script>
<script src="__JS__/<?php echo $mName; ?>/element.min.js"></script>
<script src="http://www.jq22.com/jquery/1.11.1/jquery.min.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        autoplay: 1000, //可选选项，自动滑动
        speed: 300,
        loop: true,
        //effect: "fade",//slide的切换效果:淡入淡出
        autoplayDisableOnInteraction: false, //手动滑动后出现bug，调用此项可解决无法自动滑动问题
    })

    $.fn.ready(function() {
        $('.change').dropkick({
            change: function (value, label) {
                // alert('You picked: ' + label + ':' + value);
            }
        });
    });
</script>
<script>
    new Vue({
        el: '#myVue',
        data() {
            return {
                activeName: 'second',
                activeName2: 'first',
                tabPosition: 'top',
                editableTabsValue2: '2',
                editableTabs2: [{
                    title: 'Tab 1',
                    name: '1',
                    content: 'Tab 1 content'
                }, {
                    title: 'Tab 2',
                    name: '2',
                    content: 'Tab 2 content'
                }],
                tabIndex: 2
            }
        },
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
            },
            addTab(targetName) {
                let newTabName = ++this.tabIndex + '';
                this.editableTabs2.push({
                    title: 'New Tab',
                    name: newTabName,
                    content: 'New Tab content'
                });
                this.editableTabsValue2 = newTabName;
            },
            removeTab(targetName) {
                let tabs = this.editableTabs2;
                let activeName = this.editableTabsValue2;
                if(activeName === targetName) {
                    tabs.forEach((tab, index) => {
                        if(tab.name === targetName) {
                        let nextTab = tabs[index + 1] || tabs[index - 1];
                        if(nextTab) {
                            activeName = nextTab.name;
                        }
                    }
                });
                }

                this.editableTabsValue2 = activeName;
                this.editableTabs2 = tabs.filter(tab => tab.name !== targetName);
            }
        }
    })
</script>
<!-- <script>
	$(document).ready(function(){
		var summaries = $('.summary');
		summaries.each(function (i) {
			var summary = $(summaries[i]);
			var next = summaries[i + 1];
			if (next) {
				summary.scrollFix({
					distanceTop: $(".header").outerHeight() + 10,
					endPos: next,
					zIndex: 998
				});
			} else {
				summary.scrollFix({
					distanceTop: $(".header").outerHeight() + 10,
					endPos: '.footer',
					zIndex: 998
				});
			}
		});
	})
</script>

</html>