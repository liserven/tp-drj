<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:73:"D:\phpStudy\WWW\toupiao\public/../application/index\view\plan\tolist.html";i:1513517280;s:68:"D:\phpStudy\WWW\toupiao\public/../application/index\view\layout.html";i:1513257464;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\header.html";i:1513509895;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\lefter.html";i:1513257728;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\footer.html";i:1513512055;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>小可爱的用户后台</title>
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="stylesheet" href="__CSS__/common.css">
    <link rel="icon" href="__STATIC__/static/image/code.png">
    <script>
        var config = {
            root : "__ROOT__",
            url : "__URL__",
            curl : "__CURL__",
            cNAme:"<?php echo $cName; ?>",
        };
        var baseUrl = 'localhost/toupiao/public/index.php/';
    </script>
</head>
<body>
<!-- layindexdmin -->
<div class="layui-layout layui-layout-admin"> <!-- 添加skin-1类可手动修改主题为纯白，添加skin-2类可手动修改主题为蓝白 -->
    <!-- header -->
    <div class="layui-header my-header">
        <a href="index.html">
            <!--<img class="my-header-logo" src="" alt="logo">-->
            <div class="my-header-logo">管理后台</div>
        </a>
        <div class="my-header-btn">
            <button class="layui-btn layui-btn-small btn-nav"><i class="layui-icon">&#xe620;</i></button>
        </div>

        <!-- 顶部左侧添加选项卡监听 -->
        <ul class="layui-nav" lay-filter="side-top-left">
            <!--<li class="layui-nav-item"><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="layui-icon">&#xe621;</i>基础</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></dd>
                    <dd><a href="javascript:;" href-url="demo/form.html"><i class="layui-icon">&#xe621;</i>表单</a></dd>
                </dl>
            </li>-->
        </ul>

        <!-- 顶部右侧添加选项卡监听 -->
        <ul class="layui-nav my-header-user-nav" lay-filter="side-top-right">
            <li class="layui-nav-item">
                <a class="name" href="javascript:;"><i class="layui-icon">&#xe629;</i>主题</a>
                <dl class="layui-nav-child">
                    <dd data-skin="0"><a href="javascript:;">默认</a></dd>
                    <dd data-skin="1"><a href="javascript:;">纯白</a></dd>
                    <dd data-skin="2"><a href="javascript:;">蓝白</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="name" href="javascript:;"><img src="http://p0yeuvj65.bkt.clouddn.com/kx_lovely.jpg?imageView2/1/w/60/h/60" alt="logo"> Admin </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" href-url="demo/login.html"><i class="layui-icon">&#xe621;</i>登录页</a></dd>
                    <dd><a href="javascript:;" href-url="demo/map.html"><i class="layui-icon">&#xe621;</i>图表</a></dd>
                    <dd><a href="<?php echo url('login/goout'); ?>"><i class="layui-icon">&#x1006;</i>退出</a></dd>
                </dl>
            </li>
        </ul>

    </div>
    <!-- side -->
    <div class="layui-side my-side">
        <div class="layui-side-scroll">
            <!-- 左侧主菜单添加选项卡监听 -->
            <ul class="layui-nav layui-nav-tree" lay-filter="side-main">
                <?php if(is_array($kx) || $kx instanceof \think\Collection || $kx instanceof \think\Paginator): $i = 0; $__LIST__ = $kx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon"><?php echo $vo['icon']; ?></i><?php echo $vo['content']; ?></a>
                    <dl class="layui-nav-child">
                        <?php if(is_array($vo['data']) || $vo['data'] instanceof \think\Collection || $vo['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <dd><a  href="__CURL__<?php echo $v['url']; ?>"><i class="layui-icon">&#xe630;</i><?php echo $v['content']; ?></a></dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>




<?php


?>


<div  style="margin: 100px 0 0 210px;">

    <fieldset class="layui-elem-field layui-field-title" style="margin-bottom: 0;">
        <legend>计划列表 <a href="<?php echo url('index/Plan/doAdd'); ?>" class="layui-btn layui-btn-small">添加计划</a> </legend>
    </fieldset>

    <?php if(empty($page) || (($page instanceof \think\Collection || $page instanceof \think\Paginator ) && $page->isEmpty())): ?>
        <div class="empty_box">
            <img src="__ROOT__/Image/paidaxing.jpg" alt="" width="63" height="130">
            <span>该板块没有任何内容！！！</span>
        </div>
        <?php else: ?>
    <form action="" style="text-align: center">
        <div class="layui-input-inline">
            <input type="text" name="date" id="start_time" lay-verify="required" autocomplete="off" placeholder="请输入客户手机号" class="layui-input">
        </div>
        <button class="layui-btn layui-btn-small">搜索</button>
    </form>


    <table class="layui-table">
        <colgroup>
            <col width="30">
            <col width="200">
            <col>
            <col>
            <col>
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>计划详情</th>
            <th>添加时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><?php echo $vo['id']; ?></td>
                <td><?php echo $vo['topic']; ?></td>
                <td>
                    <a href="javascript:;" class="c-success get-detail-message" data-id="<?php echo $vo['id']; ?>">查看详情</a>
                    <div style="display: none"><div class="message-detail"><?php echo $vo['content']; ?></div></div>
                </td>
                <td><?php echo $vo['create_at']; ?></td>
                <td><?php echo $vo['update_at']; ?></td>
                <td>
                    <a href="<?php echo url('index/Plan/doEdit',array('id'=>$vo['id'])); ?>" class="layui-btn  layui-btn-xs layui-btn-danger layui-btn-mini">编辑</a>
                    <a href="javascript:;" class="layui-btn  layui-btn-xs layui-btn-danger layui-btn-mini doDel" data_id="<?php echo $vo['id']; ?>" module="Plan">删除</a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td colspan="10"><?php echo $page->render(); ?></td>
        </tr>
        </tbody>
    </table>
    <?php endif; ?>
</div>


<!-- 右键菜单 -->
<div class="my-dblclick-box none">
    <table class="layui-tab dblclick-tab">
        <tr class="card-refresh">
            <td><i class="layui-icon">&#x1002;</i>刷新当前页面</td>
        </tr>
        <tr class="card-close">
            <td><i class="layui-icon">&#x1006;</i>关闭当前页面</td>
        </tr>
    </table>
</div>
<!-- footer -->
<div class="layui-footer my-footer">
    <p class="c-viligant">小哥哥出品 <i class="layui-icon">&#xe6af;</i></p>
</div>
</div>
<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
<script type="text/javascript" src="__STATIC__/static/js/index.js"></script>
<script type="text/javascript" src="__JS__/index/common.js"></script>
<script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
<script>


</script>
</body>
</html>