<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\phpStudy\WWW\toupiao\public/../application/index\view\index\modify.html";i:1512119406;s:75:"D:\phpStudy\WWW\toupiao\public/../application/index\view\iframe_layout.html";i:1512119382;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\header.html";i:1512119260;s:70:"D:\phpStudy\WWW\toupiao\public/../application/index\view\.\footer.html";i:1512119492;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>表单</title>
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="icon" href="__STATIC__/static/image/code.png">
</head>
<body class="body">

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>管理员密码修改</legend>
</fieldset>
<form class="layui-form" id="myform" method="post" action="<?php echo url('index/modify'); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">旧密码</label>
        <div class="layui-input-inline">
            <input type="text" name="oldpassword" lay-verify="title" autocomplete="off" placeholder="请输入旧密码" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">新密码</label>
        <div class="layui-input-inline">
            <input type="text" name="password" lay-verify="required" placeholder="请输入新密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码</label>
        <div class="layui-input-inline">
            <input type="text" name="repassword" lay-verify="required" placeholder="请输入确认密码" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
        </div>
    </div>
</form>

<script src="__PUBLIC__/jquery.min.js" charset="utf-8"></script>
<script src="__STATIC__/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.use(['form', 'layedit', 'laydate','table'], function(){
        // 操作对象
        var form = layui.form();
        //监听提交
        form.on('submit(demo1)', function(data){
            $("#myform").submit();
            return false;
        });

        // you code ...

    });
</script>
</body>
</html>