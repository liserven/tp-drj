<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\mrw\public/../application/admin\view\index\index.html";i:1516347338;s:54:"D:\phpStudy\WWW\mrw\application\admin\view\layout.html";i:1516347325;s:54:"D:\phpStudy\WWW\mrw\application\admin\view\header.html";i:1516347325;s:54:"D:\phpStudy\WWW\mrw\application\admin\view\footer.html";i:1516347326;}*/ ?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理系统</title>
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="stylesheet" href="__CSS__/common.css">
    <link rel="icon" href="__STATIC__/editor/themes/simple/simple.css">
    <script src="__STATIC__/layui/layui.js"></script>
    <!--/meta 作为公共模版分离出去-->
    <script type="text/javascript">
        layui.config({
            base:'/Js/admin/',
        }).extend({
            custom : 'common'
        }).use('operation');
        var config = {
            root : "__ROOT__",
            url : "__URL__",
            curl : "__CURL__",
            uid: "<?php echo $User['am_id']; ?>",
            cName : "<?php echo $cName; ?>",
            nickname:"<?php echo $User['am_nickname']; ?>"
        };
        var baseUrl = 'http://www.zxzm.com';
    </script>

</head>
<body>

<div class="box-content">
    


<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">国民美容网后台管理</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">商品管理</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="<?php echo $User['am_logo']; ?>" class="layui-nav-img">
                    <?php echo $User['am_nickname']; ?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" class="edit-info">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">消息<span class="layui-badge">9</span></a></li>
            <li class="layui-nav-item"><a href="<?php echo url('admin/Member/goOut'); ?>">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><i class="layui-icon"><?php echo $vo['icon']; ?></i><?php echo $vo['title']; ?></a>
                        <dl class="layui-nav-child">
                            <?php if(is_array($vo['data']) || $vo['data'] instanceof \think\Collection || $vo['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <dd><a href="javascript:;" href-url="<?php echo $v['url']; ?>"><i class="layui-icon"><?php echo $vo['icon']; ?></i><?php echo $v['title']; ?></a></dd>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </dl>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>

    <div class="layui-body my-body">
        <div class="layui-tab layui-tab-card my-tab" lay-filter="card" lay-allowClose="true">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="1"><span><i class="layui-icon">&#xe68e;</i>首页</span></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe id="iframe" src="<?php echo url('index/welcome'); ?>" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © 至善至美
    </div>

    <!--聊天-->
    <div id="chat-default">
        <p class="chat-prompt"> 
            <span class="d-logo"><img src="<?php echo $User['am_logo']; ?>" alt=""></span>
            <?php echo $User['am_nickname']; ?> IM
            <i class="layui-icon success-color" >&#xe60c;</i>
        </p>
    </div>

    <div id="chat-dialog" class="display-none">

    </div>


    <div id="chat-detail" class=" layui-row display-none">
        <div class="detail-content">
            <div class="d-c-l layui-col-md3 layui-col-xs3">
                <ul>
                    <li class="d-c-l-list">
                        <div class="chat-c-detail-logo">
                            <img src="http://t.cn/RCzsdCq" alt="">
                        </div>
                        <div class="chat-c-detail-info">
                            <p class="u-nickname">我是老大</p>
                            <p class="u-xiaoxi">我是老大</p>
                        </div>
                    </li>
                    <li class="d-c-l-list">
                        <div class="chat-c-detail-logo">
                            <img src="http://t.cn/RCzsdCq" alt="">
                        </div>
                        <div class="chat-c-detail-info">
                            <p class="u-nickname">我是老大</p>
                            <p class="u-xiaoxi">我是老大</p>
                        </div>
                    </li>
                    <li class="d-c-l-list">
                        <div class="chat-c-detail-logo">
                            <img src="http://t.cn/RCzsdCq" alt="">
                        </div>
                        <div class="chat-c-detail-info">
                            <p class="u-nickname">我是老大</p>
                            <p class="u-xiaoxi">我是老大</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-c-r layui-col-md9 layui-col-xs9">
                <div class="d-c-r-top">

                </div>
                <div class="d-c-r-bottom">
                    <textarea name="content" id="content" cols="0" rows="0"></textarea>
                    <button class="layui-btn layui-btn-sm  layui-btn-normal submit-btn-b">
                        发送信息
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="__JS__/<?php echo $mName; ?>/chat_page.js"></script>
</div>
</div>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
<?php if(($aName == 'doadd') OR ($aName == 'doedit')): ?>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<?php endif; ?>
    </body>
</html>
