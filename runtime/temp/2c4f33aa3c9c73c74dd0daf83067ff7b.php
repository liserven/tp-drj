<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\phpStudy\WWW\drj\public/../application/admin\view\building\doadd.html";i:1525344465;s:54:"D:\phpStudy\WWW\drj\application\admin\view\layout.html";i:1525344465;s:54:"D:\phpStudy\WWW\drj\application\admin\view\header.html";i:1525344465;s:54:"D:\phpStudy\WWW\drj\application\admin\view\footer.html";i:1525344465;}*/ ?>

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
            <label class="layui-form-label">商品名称</label>
            <div class="layui-input-inline">
                <input type="text" name="g_name" lay-verify="required" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">选择分类</label>
            <div class="layui-input-inline">
                <select name="quiz1" id="culm"  lay-filter="sort">
                    <option value="">请选择</option>
                <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['name']; ?>" data-id="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </select>



            </div>
            <div class="layui-input-inline">
                <select name="quiz2" class="two-sort" lay-filter="two-sort">
                    <option value="">请选择</option>
                </select>
            </div>


        </div>
        <div class="layui-form-item" id="addiv">


        </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品价格</label>
                <div class="layui-input-inline">
                    <input type="text" name="g_price" lay-verify="required" placeholder="请输入替换内容" class="layui-input">
                </div>
            </div>
        <div class="layui-form-item">
            <label class="layui-form-label">折后价格</label>
            <div class="layui-input-inline">
                <input type="text" name="g_price_r" lay-verify="required" placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品材质</label>
            <div class="layui-input-inline">
                <input type="text" name="g_material"lay-verify="required"  placeholder="请输入替换内容" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品排序</label>
            <div class="layui-input-inline">
                <input type="text" name="order" value="999" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">推荐Banner</label>
            <div class="layui-input-block">
                <input name="banner" value="1" title="是"  type="radio" >
                <input name="banner" value="2" title="否" checked="" type="radio">
            </div>
            <div class="layui-col-md2" style="display: none;">
                <img src="" id="img-upload-c" alt="" class="screen-img" >
                <input type="hidden" name="banner" id="input-form-c">
            </div>


        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">推荐首页</label>
            <div class="layui-input-block">
                <input name="is_index" value="1" title="是"  type="radio" >
                <input name="is_index" value="2" title="否" checked="" type="radio">
            </div>



        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">商品图</label>
            <div class="layui-col-md2">
                <img src="" id="img-upload-b" alt="" class="screen-img" required>
                <input type="hidden" name="g_img" id="input-form-b">
            </div>
        </div>
        <div class="screen_box">
            <div class="layui-form-item screen_box_t">
                <label class="layui-form-label">规格</label>
                <div class="layui-block" >
                    <div class="layui-col-md2">
                        <img src="" id="img-upload-1" alt="" class="screen-img" required>
                        <input type="hidden" name="img[]" id="input-form-1" >
                    </div>
                    <div class="layui-input-inline gg">
                        <input name="size[]" placeholder="例80*80-黄-风格" autocomplete="off" class="layui-input" required type="text">
                    </div>
                    <div class="layui-input-inline gg">
                        <input name="stock[]" placeholder="库存" autocomplete="off" class="layui-input"  required type="text">
                    </div>
                    <div class="layui-input-inline gg">
                        <input name="price[]" placeholder="价格" autocomplete="off" class="layui-input" required type="text">
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-block">
                <div class="layui-col-md1">
                    <button class="layui-btn layui-btn-xs" id="add_screen">添加一条</button>
                    <button class="layui-btn layui-btn-xs" id="del_screen">删除一条</button>
                </div>

            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" >列表图</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal"  required id="lb-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr>
                                <th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="lb-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="lb-start-btn">开始上传</button>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">展示图</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal"  required id="zs-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr>
                                <th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>预览</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="zs-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="zs-start-btn">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">服务选择</label>
            <div class="layui-input-block">
                <?php if(is_array($deploy) || $deploy instanceof \think\Collection || $deploy instanceof \think\Paginator): $i = 0; $__LIST__ = $deploy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                 <input name="like[]"  title="<?php echo $vo['name']; ?>"  type="checkbox" value="<?php echo $vo['id']; ?>">
                <?php endforeach; endif; else: echo "" ;endif; ?>
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
��� �c�����8N1	  �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 