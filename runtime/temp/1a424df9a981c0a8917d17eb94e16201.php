<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\phpStudy\WWW\zgmrw\public/../application/home\view\policies\detail.html";i:1517534367;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\layout.html";i:1517304201;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\header.html";i:1517534367;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\footer.html";i:1517534367;}*/ ?>
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
                    <a <?php if($cName == 'Industrydynamic'): ?>class="on" <?php endif; ?> href="<?php echo url('home/Industrydynamic/index'); ?>">行业动态</a>
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

<div class="indexshowcontent">
    <div class="row-rotuer indexshowlogo">
        <div class="messageleft">
            <div class="dateilcontent">
                <p class="titletarget">
                    <a href="policie.html">首页</a>
                    <a>></a>
                    <a class="on">政策法规</a>
                </p>
                <h3>报告预测：2020年我国美容产业年产值将超过一万亿元</h3>
                <a class="dateiltimer">2017-08-14</a>
                <ul class="sharethird">
                    <li class="float-left">
                        <a>政策</a>
                        <a>七部委</a>
                    </li>
                    <li class="float-right"><button class="nullcolloct"><i></i><text>收藏</text></button></li>
                    <li class="float-right">
                        <a class="float-left">分享到：</a>
                        <a class="float-left">
                            <img width="36px" height="34px" src="__ROOT__/Image/sharetowx.png" alt="">
                        </a>
                        <a class="float-left">
                            <img width="36px" height="34px" src="__ROOT__/Image/sharetoqq.png" alt="">
                        </a>
                        <a class="float-left" onclick="zone()" href="http://connect.qq.com/widget/shareqq/index.html?',s.join('&'),'" target="_blank">
                            <img width="36px" height="34px" src="__ROOT__/Image/sharetozone.png" alt="">
                        </a>
                    </li>
                </ul>
                <div class="dateilintroduce">
                    新华社北京10月27日电由国家发改委产业所牵头编制的《全国美容产业发展战略规划纲要》预测，到2020年我国美容产业年产值将超过一万亿元，就业人口将达到3000万人。
                </div>
                <a class="dateilimage">
                    <img width="100%" src="__ROOT__/Image/dateilimage.png" alt="">
                </a>
                <span class="imageintroduce">报告预测：2020年我国美容产业年产值将超过一万亿元 </span>
                <p class="dateilrichtext">
                    新华社北京10月27日电（记者 王薇）由国家发改委产业所牵头编制的《全国美容产业发展战略规划纲要》预测，到2020年我国美容产业年产值将超过一万亿元，就业人口将达到3000万人。
                </p>
                <p class="dateilrichtext">
                    《全国美容产业发展战略规划纲要》26日在京通过了来自中央相关部委和美容行业专家学者的评审，这标志着我国美容产业从此有了繁荣发展的行动纲领，将推动该产业规范、健康、绿色、协调发展。
                </p>
                <p class="dateilrichtext">
                    规划纲要预测，到2020年我国美容产业年产值将超过1万亿元；就业人口将达到3000万人；上市公司将超过100家；美容产业园区超过10个；将出现年销售额超过500亿元规模的领军企业等。
                </p>
                <p class="dateilrichtext">
                    国家发改委产业所服务业研究室主任王佳元在评审会上介绍，美容产业是一个完全竞争性行业，由于发展历史较短，目前存在企业规模较小、创新驱动不够、服务人员素质偏低、行业监管不完善、发展规划缺失等问题。为了编制一个符合中国国情且具有可操作性的产业规划，编制专家工作组历时一年多，先后到广东、浙江、上海等美容产业较发达地区进行调研，听取企业和消费者的意见建议，参照了国内外发达国家和地区的经验。
                </p>
                <ul class="shareto marginnone">
                    <li>
                        <dt>分享到</dt>
                        <dd>
                            <a href="">
                                <img width="58px" height="58px" src="__ROOT__/Image/sharetowx.png" alt="">
                            </a>
                            <a href="">
                                <img width="58px" height="58px" src="__ROOT__/Image/sharetoqq.png" alt="">
                            </a>
                            <a class="marginnone" href="">
                                <img width="58px" height="58px" src="__ROOT__/Image/sharetozone.png" alt="">
                            </a>
                        </dd>
                    </li>
                </ul>
                <ul class="targetlost">
                    <li>
                        <a href="#">上一篇：
                            <span>甘肃省7部门联合行动整治医疗美容行业乱象</span>
                        </a>
                    </li>
                    <li class="marginnone">
                        <a href="#">下一篇：
                            <span>甘肃省7部门联合行动整治医疗美容行业乱象</span>
                        </a>
                    </li>
                </ul>

                <!-- 华丽的分割线 -->
                <div style="width: 100%;height: 1px;background-color: #eee;margin: 30px 0 0 0;"></div>

                <!-- 活动预告 -->
                <ul class="activitytrailer">
                    <li>
                        <dt>
                            <img width="100%" src="__ROOT__/Image/activitytrailer.png" alt="">
                        </dt>
                        <dd>
                            <button class="float-left">活动预告</button>
                            <h4 class="float-left">创业干货分享--医疗美容搬回家PK韩国高端美容</h4>
                            <a class="float-right">
                                <span>1017-08-14</span>
                                <span>北京</span>
                            </a>
                        </dd>
                    </li>
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