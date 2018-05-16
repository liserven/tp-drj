<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\phpStudy\WWW\drhome\public/../application/admin\view\building\doedit.html";i:1526439593;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    <form class="layui-form" method="post" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">商品名称</label>
            <div class="layui-input-inline">
                <input type="text" name="g_name" lay-verify="required" placeholder="请输入标题" value="<?php echo $data['g_name']; ?>"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">选择分类</label>
            <div class="layui-input-inline">
                <select name="g_column" id="culm" lay-filter="sort">
                    <option value="<?php echo $data['g_column']; ?>"><?php echo $data['g_column']; ?></option>
                    <?php if(is_array($one) || $one instanceof \think\Collection || $one instanceof \think\Paginator): $i = 0; $__LIST__ = $one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['name']; ?>" data-id="<?php echo $vo['id']; ?>" ><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </select>


            </div>
            <div class="layui-input-inline">
                <select name="g_columr" class="two-sort" lay-filter="two-sort">
                    <option value="<?php echo $data['g_columr']; ?>"><?php echo $data['g_columr']; ?></option>
                </select>
            </div>


        </div>
        <div class="layui-form-item" id="addiv">
            <?php if(is_array($set) || $set instanceof \think\Collection || $set instanceof \think\Paginator): $i = 0; $__LIST__ = $set;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo $vo['set_name']; ?></label>
                    <div class="layui-input-inline">
                        <input type="hidden" name="set_name[]" value="<?php echo $vo['set_name']; ?>">
                        <input type="text" name="set[]" placeholder="请输入" value="<?php echo $vo['value']; ?>" class="layui-input" required>
                    </div>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品价格</label>
            <div class="layui-input-inline">
                <input type="text" name="g_price" lay-verify="required" placeholder="请输入替换内容" value="<?php echo $data['g_price']; ?>"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">折后价格</label>
            <div class="layui-input-inline">
                <input type="text" name="g_price_r" lay-verify="required" placeholder="请输入替换内容"
                       value="<?php echo $data['g_price_r']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品材质</label>
            <div class="layui-input-inline">
                <input type="text" name="g_material" lay-verify="required" placeholder="请输入替换内容"
                       value="<?php echo $data['g_material']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品排序</label>
            <div class="layui-input-inline">
                <input type="text" name="order" value="<?php echo $data['order']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">推荐Banner</label>
            <div class="layui-input-block">
                <input name="banner" value="1" title="是" type="radio">
                <input name="banner" value="2" title="否" checked="" type="radio">
            </div>
            <div class="layui-col-md2" style="display: none;">
                <img src="" id="img-upload-c" alt="" class="screen-img">
                <input type="hidden" name="banner" id="input-form-c">
            </div>


        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">推荐首页</label>
            <div class="layui-input-block">
                <input name="is_index" value="1" title="是" type="radio">
                <input name="is_index" value="2" title="否" checked="" type="radio">
            </div>


        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">商品图</label>
            <div class="layui-col-md2">
                <img src="<?php echo $data['g_img']; ?>" id="img-upload-b" alt="" class="screen-img" required>
                <input type="hidden" name="g_img" id="input-form-b">
            </div>
        </div>
        <div class="screen_box">
                <?php if(is_array($screen) || $screen instanceof \think\Collection || $screen instanceof \think\Paginator): $i = 0; $__LIST__ = $screen;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="layui-form-item screen_box_t">
                        <label class="layui-form-label">规格</label>
                        <div class="layui-block">
                            <div class="layui-col-md2">
                                <img src="<?php echo $vo['img']; ?>" id="img-upload-<?php echo $key+1; ?>" alt="" class="screen-img" required>
                                <input type="hidden" name="img[]" value="<?php echo $vo['img']; ?>" id="input-form-<?php echo $key+1; ?>">
                            </div>
                            <div class="layui-input-inline gg">
                                <input name="size[]" placeholder="例80*80-黄-风格" value="<?php echo $vo['size']; ?>" autocomplete="off"
                                       class="layui-input" required value="<?php echo $vo['size']; ?>" type="text">
                            </div>
                            <div class="layui-input-inline gg">
                                <input name="stock[]" placeholder="库存" autocomplete="off" value="<?php echo $vo['stock']; ?>"
                                       class="layui-input" required value="<?php echo $vo['stock']; ?>" type="text">
                            </div>
                            <div class="layui-input-inline gg">
                                <input name="price[]" placeholder="价格" autocomplete="off" value="<?php echo $vo['price']; ?>"
                                       class="layui-input" required value="<?php echo $vo['price']; ?>" type="text">
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="layui-form-item screen_box_t">
                    <label class="layui-form-label">规格</label>
                    <div class="layui-block">
                        <div class="layui-col-md2">
                            <img src="" id="img-upload-1" alt="" class="screen-img" required>
                            <input type="hidden" name="img[]" id="input-form-1">
                        </div>
                        <div class="layui-input-inline gg">
                            <input name="size[]" placeholder="例80*80-黄-风格" autocomplete="off"
                                   class="layui-input" required type="text">
                        </div>
                        <div class="layui-input-inline gg">
                            <input name="stock[]" placeholder="库存" autocomplete="off"
                                   class="layui-input" required type="text">
                        </div>
                        <div class="layui-input-inline gg">
                            <input name="price[]" placeholder="价格" autocomplete="off"
                                   class="layui-input" required type="text">
                        </div>
                    </div>
                </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-block">
                <div class="layui-col-md5">
                    <button class="layui-btn layui-btn-xs" id="add_screen">添加一条</button>
                    <button class="layui-btn layui-btn-xs" id="del_screen">删除一条</button>
                </div>

            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">列表图</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" required id="lb-list">选择多文件</button>
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
                            <tbody id="lb-detail">
                            <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['g_img_type'] == '1'): ?>
                            <tr id="upload-<?php echo $key; ?>">
                                <td>
                                    原图
                                </td>
                                <input type="hidden" name="lb-input[]" value="<?php echo $vo['g_img']; ?>" />
                                <td></td>
                                <td>已上传</td>
                                <td class="yl-'+index+'"><img src="<?php echo $vo['g_img']; ?>" alt="" width="80" height="80"></td>
                                <td>
                                    <button class="layui-btn layui-btn-mini layui-btn-danger delete-img" data-id="<?php echo $vo['id']; ?>">删除</button>
                                    </td>
                                </tr>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
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
                    <button type="button" class="layui-btn layui-btn-normal" required id="zs-list">选择多文件</button>
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
                            <tbody id="zs-detail">
                            <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['g_img_type'] == '2'): ?>
                                    <tr>
                                        <td>
                                            原图
                                        </td>
                                        <input type="hidden" name="zs-input[]" id="lsy-<?php echo $key; ?>" value="<?php echo $vo['g_img']; ?>" />
                                        <td></td>
                                        <td>已上传</td>
                                        <td class="yl-'+index+'"><img src="<?php echo $vo['g_img']; ?>" alt="" width="80" height="80"></td>
                                        <td>
                                            <button class="layui-btn layui-btn-mini layui-btn-danger delete-img" data-id="<?php echo $vo['id']; ?>">删除</button>
                                        </td>
                                    </tr>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
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
                    <input name="deploy[]" title="<?php echo $vo['name']; ?>" type="checkbox">

                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formEdit" id="submit">立即提交</button>
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
