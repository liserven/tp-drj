<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpStudy\WWW\toupiao\public/../application/admin\view\index\welcome.html";i:1512007648;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>欢迎页2</title>
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="icon" href="__STATIC__/static/image/code.png">
</head>
<body class="body">

<div class="layui-collapse" lay-accordion="" lay-filter="collapse">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">软件信息</h2>
        <div class="layui-colla-content layui-show">
            <table class="layui-table">
                <tr>
                    <td width="40%">软件名称</td>
                    <td width="60%">员工业绩报表系统</td>
                </tr>
                <tr>
                    <td>系统版本</td>
                    <td>v1.0.0</td>
                </tr>
                <tr>
                    <td>QQ群</td>
                    <td>2134811921（后台技术维护）</td>
                </tr>
                <tr>
                    <td>官网</td>
                    <td><a href="javascript:parent.location.href='http://www.lsybk.com';">www.lsybk.com</a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">服务器信息</h2>
        <div class="layui-colla-content">
            <table class="layui-table">
                <tr>
                    <td width="40%">服务器域名</td>
                    <td width="60%"><?php echo $server['HTTP_HOST']; ?></td>
                </tr>
                <tr>
                    <td>服务器标识</td>
                    <td><?php echo $server['SERVER_SOFTWARE']; ?></td>
                </tr>
                <tr>
                    <td>服务器操作系统</td>
                    <td><?php echo $server['osname']; ?></td>
                </tr>
                <tr>
                    <td>服务器语言</td>
                    <td><?php echo $server['HTTP_ACCEPT_LANGUAGE']; ?></td>
                </tr>
                <tr>
                    <td>服务器端口</td>
                    <td><?php echo $server['SERVER_PORT']; ?></td>
                </tr>
                <tr>
                    <td>服务器主机名</td>
                    <td><?php echo $server['SERVER_NAME']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">数据库信息</h2>
        <div class="layui-colla-content">
            <table class="layui-table">
                <tr>
                    <td width="40%">数据库版本</td>
                    <td width="60%"><?php echo $server['mysqlversion']; ?></td>
                </tr>
                <tr>
                    <td>数据库名称</td>
                    <td><?php echo $server['databasename']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">PHP相关参数</h2>
        <div class="layui-colla-content">
            <table class="layui-table">
                <tr>
                    <td width="40%">PHP版本</td>
                    <td width="60%"><?php echo $server['phpversion']; ?></td>
                </tr>
                <tr>
                    <td>上传文件最大限制</td>
                    <td><?php echo $server['maxupload']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['layer','element'], function () {
        var layer = layui.layer, element = layui.element();

        //监听折叠
        element.on('collapse(collapse)', function(data){
            //layer.msg('展开状态：'+ data.show);
        });

        // you code ...


    });
</script>
</body>
</html>