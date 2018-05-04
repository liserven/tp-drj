<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:72:"D:\phpStudy\WWW\toupiao\public/../application/index\view\vote\doadd.html";i:1512282773;s:68:"D:\phpStudy\WWW\toupiao\public/../application/index\view\layout.html";i:1512119949;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\header.html";i:1512281627;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\lefter.html";i:1512119335;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\footer.html";i:1512141124;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>投票管理系统</title>
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
                <a class="name" href="javascript:;"><img src="__ADMIN__/static/image/code.png" alt="logo"> Admin </a>
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
                <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon">&#xe628;</i><?php echo $vo['content']; ?></a>
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






<!-- body -->
<div class="layui-body my-body">
    <div class="layui-tab layui-tab-card my-tab" lay-filter="card" lay-allowClose="true">
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>添加投票 <a href="<?php echo url('index/Kehu/tolist'); ?>"
                                    class="layui-btn layui-btn-sm layui-btn-normal">返回列表</a></legend>
                </fieldset>
                <form class="layui-form" id="myform" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">投票名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="topic" lay-verify="required" autocomplete="off"
                                   placeholder="请输入投票名称"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">开始时间</label>
                        <div class="layui-input-inline">
                            <input class="layui-input" name="start_time" id="start_time" lay-verify="required" placeholder="请输入开始时间" type="text">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">结束时间</label>
                        <div class="layui-input-inline">
                            <input class="layui-input" id="over_time" name="over_time" lay-verify="required" placeholder="请输入结束时间" type="text">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">投票说明</label>
                        <div class="layui-input-inline">
                            <textarea name="explain" id="explain" lay-verify="required" cols="100" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="add_vote">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <p>易风学院</p>
</div>
</div>
<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
<script type="text/javascript" src="__STATIC__/static/js/index.js"></script>
<script type="text/javascript" src="__JS__/admin/common.js"></script>
<script type="text/javascript" src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
<script>


</script>
</body>
</html>