<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"D:\phpStudy\WWW\drhome\public/../application/admin\view\user\doadd.html";i:1528441923;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    <link rel="icon" href="__JS__/<?php echo $mName; ?>/wangEditor/release/wangEditor.css">
    <script src="__JS__/jquery.min.js"></script>
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
    
<div style="padding: 20px;">
    <form class="layui-form" method="post" enctype=multipart/form-data>
        <div class="layui-form-item">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-inline">
                <input type="text" name="name" lay-verify="required" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" name="phone" lay-verify="required" placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-inline">
                <input type="text" name="password" lay-verify="required" placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
                <input type="radio" name="sex" value="1" title="男">
                <input type="radio" name="sex" value="2" title="女" >
                <input type="radio" name="sex" value="3" title="保密" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">个人说明</label>
            <div class="layui-input-inline">
                <input type="text" name="message" lay-verify="required" placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份</label>
            <div class="layui-input-inline">
                <select name="ud_status">
                    <option>请选择</option>
                    <option value="承包代理合伙人">承包代理合伙人</option>
                    <option value="营销代理合伙人">营销代理合伙人</option>
                    <option value="客服">客服</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">推荐人</label>
            <div class="layui-input-inline">
                <input type="text" name="referee" lay-verify="required" placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
        <label class="layui-form-label">地区：</label>
        <div class="layui-input-inline">
            <select name="provice" id="provice" lay-filter="provice">
                <option value="">请选择</option>
                <?php if(is_array($provice) || $provice instanceof \think\Collection || $provice instanceof \think\Paginator): $i = 0; $__LIST__ = $provice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['provice_name']; ?>" data-id="<?php echo $vo['provice_id']; ?>" ><?php echo $vo['provice_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <div class="layui-input-inline">
            <select name="city" id="city" lay-filter="city">
                <option value="">选择市级</option>

            </select>
        </div>
        <div class="layui-input-inline">
            <select name="county" id="county" lay-filter="county">
                <option value="">选择县级</option>
            </select>
        </div>
        <div class="layui-input-inline">
            <select name="town" id="town" lay-filter="town">
                <option value="">选择镇级</option>
            </select>
        </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">其他</label>
            <div class="layui-input-inline">
                <input type="text" name="ud_address"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">头像</label>
            <div class="layui-col-md2">
                <img src="" id="img-upload-d" alt="" class="screen-img">
                <input type="hidden" name="ud_logo" id="input-form-d">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份证正面</label>
            <div class="layui-col-md2">
                <img src="" id="img-upload-a" alt="" class="screen-img" >
                <input type="hidden" name="ud_id_photo" id="input-form-a">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份证反面</label>
            <div class="layui-col-md2">
                <img src="" id="img-upload-b" alt="" class="screen-img" >
                <input type="hidden" name="ud_id_photo_r" id="input-form-b">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">半身照片</label>
            <div class="layui-col-md2">
                <img src="" id="img-upload-c" alt="" class="screen-img" >
                <input type="hidden" name="ud_photo" id="input-form-c">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo" id="submit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

</div>



</div>
<?php if(($aName == 'doadd') OR ($aName == 'doedit')): ?>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="__STATIC__/qiniu/dist/qiniu.min.js"></script>
    <script src="__JS__/<?php echo $mName; ?>/wangEditor/release/wangEditor.js"></script>

<?php endif; ?>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js?v=<?php echo time(); ?>"></script>


<?php if(($cName == 'Index')): ?>
    <script type="text/javascript" src="__JS__/<?php echo $mName; ?>/chat.js"></script>
    <script type="text/javascript" src="__JS__/jquery-3.2.1.min.js"></script>
<?php endif; ?>
    </body>
</html>
