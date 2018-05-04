<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\phpStudy\WWW\zgmrw\public/../application/home\view\cosmetology\index.html";i:1517568776;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\layout.html";i:1517304201;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\header.html";i:1517566734;s:55:"D:\phpStudy\WWW\zgmrw\application\home\view\footer.html";i:1517566734;}*/ ?>
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
            <div class="row-rotuer indexshowlogo" style="margin-top:40px;">
                <div class="messageleft">
                    <!-- 美容科普 项目分类 -->
                    <div class="tableft"></div>
                    <ul class="classification padding-none">
                        <li>
                            <span>项目分类：</span>
                            <dd>
                                <?php if(is_array($oneProject) || $oneProject instanceof \think\Collection || $oneProject instanceof \think\Paginator): $i = 0; $__LIST__ = $oneProject;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <a class=""><?php echo $vo['name']; ?></a>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </dd>
                        </li>

                        <li>
                            <span>二级分类：</span>
                            <dd>
                                <?php if(is_array($twoProject) || $twoProject instanceof \think\Collection || $twoProject instanceof \think\Paginator): $i = 0; $__LIST__ = $twoProject;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <a class=""><?php echo $vo['name']; ?></a>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </dd>
                        </li>

                        <li>
                            <span>三级分类：</span>
                            <dd>
                                <?php if(is_array($threeProject) || $threeProject instanceof \think\Collection || $threeProject instanceof \think\Paginator): $i = 0; $__LIST__ = $threeProject;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <a class=""><?php echo $vo['name']; ?></a>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </dd>
                        </li>

                    </ul>
                    <!-- 手术 执行方案 -->
                    <div class="operation">
                        <h1 class="operationname"><?php echo $threeProject['0']['name']; ?></h1>
                        <section>
                            <div class="headertitle"><div></div>简介</div>
                            <p><?php echo $data['message']; ?></p>
                        </section>
                        <section>
                            <div class="headertitle"><div></div>档案</div>
                            <ul>
                                <li class="col-md-3"><span>类型：<?php echo $data['type']; ?></span></li>
                                <li class="col-md-3 on"><span>疼痛感：<a class="pain_1"></a></span></li>
                                <li class="col-md-3"><span>维持时间：<?php echo $data['maintain_time']; ?></span></li>
                                <li class="col-md-3"><span>治疗时间：<?php echo $data['treatment_time']; ?></span></li>
                                <li class="col-md-3"><span>麻醉方法：<?php echo $data['anesthetic_method']; ?></span></li>
                                <li class="col-md-3"><span>参考价格：<?php echo $data['reference_price']; ?></span></li>
                                <li class="col-md-3"><span>住院：<?php echo $data['is_hospitalization']; ?></span></li>
                                <li class="col-md-3"><span>拆线时间：<?php echo $data['breaking_time']; ?></span></li>
                            </ul>
                        </section>
                        <section>
                            <div class="headertitle"><div></div>项目/手术原理</div>
                            <ul>
                                <?php echo $data['principle']; ?>
                            </ul>
                            <div class="footerimg">
                                <?php if(is_array($data['imgs']) || $data['imgs'] instanceof \think\Collection || $data['imgs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['imgs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type'] == 'yl'): ?>
                                        <a class="col-md-3"><img src="<?php echo $vo['img']; ?>" alt=""></a>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </section>
                        <section>
                            <div class="headertitle"><div></div>效果展示</div>
                            <div class="twoimage">
                                <?php if(is_array($data['imgs']) || $data['imgs'] instanceof \think\Collection || $data['imgs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['imgs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type'] == 'xg'): ?>
                                        <a class="col-md-6"><img src="<?php echo $vo['img']; ?>" alt=""></a>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </section>
                        <section>
                            <div class="headertitle"><div></div>优点</div>
                            <p>1、横向永久</p>
                            <p>2、自然变大</p>
                            <p>3、使眼睛视野更开阔、有神</p>
                        </section>
                        <section>
                            <div class="headertitle"><div></div>缺点及风险</div>
                            <p>1、可能存在疤痕遗留问题</p>
                            <p>2、恢复时间较长</p>
                        </section>
                        <section>
                            <div class="headertitle"><div></div>术前锦囊</div>
                            <p>1、女性避开例假期，避免出血增多或肿胀加重。</p>
                            <p>2、手术前两周内，请勿复用固醇激素和阿司匹林类抗凝药物</p>
                            <p>3、手术当日不要化妆，也不要带装饰物等。</p>
                            <p>4、妊娠前期（三个月）或妊娠后期（三个月）暂缓手术。</p>
                            <p>5、男性需要提前戒烟一周。</p>
                            <p>6、常规身体检查--全身检查，血压、心电图等。</p>
                        </section>
                        <section class="last">
                            <div class="headertitle"><div></div>术后锦囊</div>
                            <p>
                                双眼皮手术后首要注意的就是保持创口的清洁。如果创口不清洁，很容易引发感染导致疤痕的形成。因此，重睑术后洗脸时要分外注意，不要使创口沾到水，如果创口上有血痂或者分泌物，可以用无菌盐水或者医用酒精擦拭。
                            </p>
                            <p>
                                术后的轻微疼痛是不可避免的，尽管如此，也不要急于吃阿斯匹林类的止痛片，因为这类药物会加重创口的出血。
                            </p>
                            <p>
                                为了防止术后可能出现的淤血以及肿胀等现象，可以通过对局部伤口加压包扎或者用冰袋冷敷的方式进行护理，加快消肿的速度。
                            </p>
                            <p>
                                很多爱美者认为重睑术后不适合做过多的眼部运动，其实不然，只有不断加强眼睛的运动，才能加快眼睛肌肉和周围组织的血液循环，减轻并消除手术部位的肿胀，促进手术淤血的早日吸收。
                            </p>
                            <p>
                                含有重金属的化妆护肤品有可能加重手术切口的疤痕增生，所以手术后三个月内切不可使用含有重金属的化妆护肤品。
                            </p>
                            <p>
                                一些人重睑手术恢复之后，手术部位依然有种紧绷绷的感觉，这是手术后的正常现象，只要做好局部的保湿和软化就能缓解这种现象。重睑手术切口愈合之后就可以使用一些具有保湿、软化组织功效的护肤品
                            </p>
                        </section>
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