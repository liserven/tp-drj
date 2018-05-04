<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW\toupiao\public/../application/index\view\login\index.html";i:1513519917;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>投票系统登录界面</title>
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="icon" href="__STATIC__/static/image/code.png">
</head>
<body style="background: rgba(247,249,60,0.1)
      ">
<div class="content"
     style="width: 750px;height:500px;margin:50px auto; background: url('http://p0yeuvj65.bkt.clouddn.com/QQ%E5%9B%BE%E7%89%8720171214221458.jpg');">
    <div class="login-main" style="margin-top:150px; ">
        <header class="layui-elip" style="color:#fff">她是小可爱</header>
        <form class="layui-form" id="myform" method="post" action="<?php echo url('login/login'); ?>">
            <div class="layui-input-inline">
                <input type="text" id="phone" name="phone" required lay-verify="required" placeholder="用户名"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <input type="password" id="password" name="password" required lay-verify="required" placeholder="密码"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline login-btn">
                <button type="submit" class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">登录</button>
            </div>
        </form>
    </div>
</div>
<script src="__PUBLIC__/jquery.min.js"></script>
<script src="__STATIC__/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['form'], function () {
        var $ = layui.$;
        var form = layui.form;
        $('#phone').val('');
        $('#password').val('');
        //监听提交
        form.on('submit(formDemo)', function (data) {
            var datas = data.field;
            var action = data.form.action;
            $.ajax({
                url: action,
                data: datas,
                type: "POST",
                dataType: "json",
                success: function (result) {
                    if (result.bol) {
                        layer.msg(result.msg);
                        window.location.href = "/index";

                    }else{
                        layer.msg(result.msg);
                    }
                },
            })
            return false;
        });
    });
</script>
</body>
</html>