<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"D:\phpStudy\WWW\zgmrw\public/../application/home\view\industrydynamic\index.html";i:1517537609;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\layout.html";i:1517304201;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\header.html";i:1517535874;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\footer.html";i:1517534367;}*/ ?>
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
                    <a <?php if($cName == 'Inddfsfdsex'): ?>class="on" <?php endif; ?> href="">评审认证</a>
                </li>
                <li class="col-md-2 float-right text-right">
                    <button>标准联盟</button>
                </li>
            </ul>
        </div>
    </nav>
    <div style="height:120px;"></div>

<!-- 行业动态 -->
    <div class="indexshowcontent">
        <div class="row-rotuer indexshowlogo" style="margin-top:40px;">
            <div class="messageleft">
                <ul class="float-left leftside fix-bottom left-nav">
                    <li>
                        <dd class="<?php echo $sort=='all'?'on' : ''; ?>"><a href="/industrydynamic_index/3">全部</a></dd>
                        <?php if(is_array($sortList) || $sortList instanceof \think\Collection || $sortList instanceof \think\Paginator): $i = 0; $__LIST__ = $sortList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <dd  class="<?php echo $vo['id']==$sort?'on' : ''; ?>"><a href="/industrydynamic_index/<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></a></dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </li>
                </ul>
                <div class="industry-container float-left">
                    <div class="xobbox">
                        <ul class="col-md-5 swiper-container float-left padding-none" style="width: 39.5%;">
                            <div class="swiper-wrapper">
                                <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($banner) ? array_slice($banner,1,3, true) : $banner->slice(1,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <div class="swiper-slide lunindex">
                                    <a href="<?php echo $vo['url']; ?>"><img width="100%" height="129px" src="<?php echo $vo['img']; ?>" alt=""></a>
                                    <div class="imagetitle"><?php echo $vo['title']; ?></div>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </ul>
                        <ul class="col-md-7 swiper-container float-right padding-none">
                            <div class="swiper-wrapper">
                                <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($banner) ? array_slice($banner,1,3, true) : $banner->slice(1,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <div class="swiper-slide lunindex">
                                    <a href="<?php echo $vo['url']; ?>"><img width="100%" height="270px" src="<?php echo $vo['img']; ?>" alt=""></a>
                                    <div class="imagetitle"><?php echo $vo['title']; ?></div>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </ul>
                        <ul class="col-md-5 swiper-container float-left padding-none" style="width: 39.5%;margin: 12px 0 0 0;">
                            <div class="swiper-wrapper">
                                <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($banner) ? array_slice($banner,1,3, true) : $banner->slice(1,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <div class="swiper-slide lunindex">
                                    <a href="<?php echo $vo['url']; ?>"><img width="100%" height="129px" src="<?php echo $vo['img']; ?>" alt=""></a>
                                    <div class="imagetitle"><?php echo $vo['title']; ?></div>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </ul>
                    </div>

                    <!-- 资讯 -->
                    <ul class="dynamic-commit">
                        <?php if(is_array($news) || $news instanceof \think\Collection || $news instanceof \think\Paginator): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url('home/Policies/tonull'); ?>" target="_blank" class="float-left"><img src="<?php echo $vo['sm_img']; ?>?imageView2/1/w/198/h/120" alt=""></a>
                            <dd class="float-left">
                                <h3><a href="<?php echo url('home/Policies/tonull'); ?>" target="_blank"><?php echo $vo['title']; ?></a></h3>
                                <p><span><?php echo $vo['source']; ?></span><a><?php echo $vo['create_at']; ?></a></p>
                            </dd>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <!-- 加载更多 -->
                    <div class="loadmorecontent margin80"></div>
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
<script src="http://www.jq22.com/jquery/vue.min.js"></script>
<script src="__JS__/<?php echo $mName; ?>/element.min.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        autoplay: 1000, //可选选项，自动滑动
        speed: 300,
        loop: true,
        //effect: "fade",//slide的切换效果:淡入淡出
        autoplayDisableOnInteraction: false, //手动滑动后出现bug，调用此项可解决无法自动滑动问题
    })
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