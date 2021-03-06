<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"D:\phpStudy\WWW\drj\public/../application/admin\view\villa\doedit.html";i:1523240917;s:54:"D:\phpStudy\WWW\drj\application\admin\view\layout.html";i:1519356432;s:54:"D:\phpStudy\WWW\drj\application\admin\view\header.html";i:1519809078;s:54:"D:\phpStudy\WWW\drj\application\admin\view\footer.html";i:1521108885;}*/ ?>

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
    <form class="layui-form" method="POST" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">别墅名称</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_name"  value="<?php echo $arr['vd_name']; ?>" lay-verify="required"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">一级分类</label>
            <div class="layui-input-inline">
                <select name="vd_class" lay-verify="required">

                    <option value="定制别墅">定制别墅</option>
                    <option value="标准别墅">标准别墅</option>

                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">二级分类</label>
            <div class="layui-input-inline">
                <select name="vd_class_r" lay-verify="required">

                    <option value="家">家</option>
                    <option value="墅">墅</option>
                    <option value="堡">堡</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">单价</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_unit_price"  value="<?php echo $arr['vd_unit_price']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">总价</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_price" value="<?php echo $arr['vd_price']; ?>"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">建筑面积</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_building_area" value="<?php echo $arr['vd_building_area']; ?>"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">占地面积</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_covers_area" value="<?php echo $arr['vd_covers_area']; ?>"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">别墅层高</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_height"  value="<?php echo $arr['vd_height']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">入户门</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_door"  value="<?php echo $arr['vd_door']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">屋面瓦</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_wmw"  value="<?php echo $arr['vd_wmw']; ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">外墙</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_wq"   value="<?php echo $arr['vd_wq']; ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">室</label>
            <div class="layui-input-inline">
                <input type="text" name="room"  value="<?php echo $arr['room']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">厅</label>
            <div class="layui-input-inline">
                <input type="text" name="office"  value="<?php echo $arr['office']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">卫</label>
            <div class="layui-input-inline">
                <input type="text" name="wei"   value="<?php echo $arr['wei']; ?>"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">外观图：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="wg-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="wg-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="wg-start-btn">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">室内图：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="sn-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="sn-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="sn-start-btn">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">细节图：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="xj-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="xj-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="xj-start-btn">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">结构图：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="jg-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="jg-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="jg-start-btn">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">面积图：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="mj-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="mj-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="mj-start-btn">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo" id="submit">立即修改</button>
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
