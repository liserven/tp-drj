<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:72:"D:\phpStudy\WWW\toupiao\public/../application/index\view\kehu\doadd.html";i:1513514261;s:68:"D:\phpStudy\WWW\toupiao\public/../application/index\view\layout.html";i:1513257464;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\header.html";i:1513509895;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\lefter.html";i:1513257728;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\footer.html";i:1513512055;}*/ ?>
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


<div  style="margin: 100px 0 40px 210px;overflow: auto">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>添加客户 <a href="<?php echo url('index/Kehu/toList'); ?>" class="layui-btn layui-btn-small">客户列表</a> </legend>
    </fieldset>
    <form class="layui-form" id="add_vote" method="post" action="<?php echo url('index/Kehu/doAdd'); ?>">
        <div class="layui-form-item text-center">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-inline">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入姓名" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
                <input type="radio" name="sex" value="1" title="男" checked>
                <input type="radio" name="sex" value="2" title="女">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" name="phone" lay-verify="phone"  placeholder="请输入手机号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">微信号</label>
            <div class="layui-input-inline">
                <input type="text" name="wx" placeholder="请输入微信号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">QQ号</label>
            <div class="layui-input-inline">
                <input type="text" name="qq" placeholder="请输入QQ号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <textarea name="message" id="message" placeholder="请输入内容" class=""></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <select name="status" lay-verify="required">
                    <option value="1">潜在客户</option>
                    <option value="2">已确定可签单</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            </div>
        </div>
    </form>
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