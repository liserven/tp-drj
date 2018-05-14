<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\phpStudy\WWW\drhome\public/../application/admin\view\villa\doadd.html";i:1526002442;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
                <input type="text" name="vd_name"  lay-verify="required" placeholder="请输入名称" class="layui-input">
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
                <input type="text" name="vd_unit_price"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">总价</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_price"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">建筑面积</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_building_area"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">占地面积</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_covers_area"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">别墅层高</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_height"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">入户门</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_door"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">窗户</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_windows"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">屋面瓦</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_wmw"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">外墙</label>
            <div class="layui-input-inline">
                <input type="text" name="vd_wq"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">室</label>
            <div class="layui-input-inline">
                <input type="text" name="room"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">厅</label>
            <div class="layui-input-inline">
                <input type="text" name="office"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">卫</label>
            <div class="layui-input-inline">
                <input type="text" name="wei"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">缩略图</label>
            <div class="layui-col-md2">
                <img src="" id="img-upload-b" alt="" class="screen-img" required>
                <input type="hidden" name="vd_logo" id="input-form-b">
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">服务选择</label>
            <div class="layui-input-block">
                <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input name="like[]"  title="<?php echo $vo['name']; ?>"  type="checkbox" value="<?php echo $vo['id']; ?>">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">轮播图：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="lb-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="lb-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="lb-start-btn">开始上传</button>
                </div>
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