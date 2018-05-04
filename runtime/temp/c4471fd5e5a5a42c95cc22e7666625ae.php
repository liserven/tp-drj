<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\phpStudy\WWW\drj\public/../application/admin\view\login\index.html";i:1525344465;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台登录</title>
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="icon" href="__STATIC__/static/image/code.png">
</head>
<body>

<div class="login-main">
    <header class="layui-elip">后台登录</header>
    <form class="layui-form" id="myform" method="post" action="<?php echo url('login/login'); ?>">
        <div class="layui-input-inline">
            <input type="text" name="phone" required lay-verify="required|phone" placeholder="管理员手机号" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="password" name="password" required lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="padding: 0;"><img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="" id="captcha_image"/></label>
            <div class="layui-input-block">
                <input type="text" name="captcha" id="captcha" required lay-verify="required" placeholder="验证码" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-input-inline login-btn">
            <button type="submit" class="layui-btn" lay-submit lay-filter="formDemo">登录</button>
        </div>
    </form>
</div>

<script src="__STATIC__/jquery-3.2.1.min.js"></script>
<script src="__JS__/jquery.min.js"></script>
<script src="__STATIC__/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['form'], function () {

        var form = layui.form
            ,$ = layui.jquery;

        $("#captcha_image").click(function(){
            var src = $(this).attr('src');
            $(this).attr('src',"<?php echo captcha_src(); ?>?"+Math.random());
        });
        //监听提交
        form.on('submit(formDemo)', function(data){
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
                        window.location.href = result.data.url;

                    }else{
                        layer.msg(result.msg,{icon:2,time:1000});
                        var src = $("#captcha_image").attr('src');
                        $("#captcha_image").attr('src',"<?php echo captcha_src(); ?>?"+Math.random());
                        $("#captcha").val('');
                    }
                },
            })
            return false;
        });
    });
</script>
</body>
</html>