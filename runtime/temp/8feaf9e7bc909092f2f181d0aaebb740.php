<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:68:"D:\phpStudy\WWW\mrw\public/../application/admin\view\news\doadd.html";i:1516347328;s:54:"D:\phpStudy\WWW\mrw\application\admin\view\layout.html";i:1516347325;s:54:"D:\phpStudy\WWW\mrw\application\admin\view\header.html";i:1516347325;s:54:"D:\phpStudy\WWW\mrw\application\admin\view\footer.html";i:1516347326;}*/ ?>

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
    
<div class='layui-row' style="padding: 20px;">
    <form class="layui-form" method="post" style="padding:0 0 25px 50px; " enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">标题：</label>
            <div class="layui-col-md3">
                <input type="text" name="title" lay-verify="required" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">简略标题：</label>
            <div class="layui-col-md3">
                <input type="text" name="sm_title" lay-verify="required" placeholder="请输入简略标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">简介：</label>
            <div class="layui-input-block">
                <textarea name="message" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容来源：</label>
            <div class="layui-col-md3">
                <input type="text" name="source" lay-verify="required" placeholder="请输入内容来源 比如:原创" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">一级分类：</label>
            <div class="layui-input-inline">
                <select name="one_sort" lay-verify="">
                    <?php if(is_array($sort) || $sort instanceof \think\Collection || $sort instanceof \think\Paginator): $i = 0; $__LIST__ = $sort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">二级分类：</label>
            <div class="layui-input-inline">
                <select name="sort_id" lay-verify="">
                    <?php if(is_array($twoSort) || $twoSort instanceof \think\Collection || $twoSort instanceof \think\Paginator): $i = 0; $__LIST__ = $twoSort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容标签：</label>
            <div class="layui-col-md3">
                <input type="text" name="label" lay-verify="required" placeholder="请输入内容来源 比如:原创" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">常用标签：</label>
            <div class="layui-col-md3">
                <?php if(is_array($hotLabel) || $hotLabel instanceof \think\Collection || $hotLabel instanceof \think\Paginator): $i = 0; $__LIST__ = $hotLabel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <a href="javascript:;" style="height: 35px; line-height: 35px;"><span class="layui-badge layui-bg-gray"><?php echo $vo['name']; ?></span></a>,
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">推送头条：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_index" value="1" title="是" >
                <input type="radio" name="is_index" value="2" title="否" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">缩略图：</label>
            <div class="layui-col-md3" >
                <ul class="list">
                    <li>
                        <input type="file" name="file" onchange="handleFiles(this.files,this.parentNode)">
                    </li>
                </ul>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">置顶：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_top" value="1" title="是">
                <input type="radio" name="is_top" value="2" title="否" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">评论：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_comment" value="1" title="是" checked>
                <input type="radio" name="is_comment" value="2" title="否">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">顺序：</label>
            <div class="layui-col-md1">
                <input type="number" name="order" value="99" lay-verify="required"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" style="height:700px">
            <label class="layui-form-label">内容：</label>
            <div class="layui-input-block">
                <textarea id="editor_id" class="new-content" name="content">

                </textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <script>
        function handleFiles(file, obj) {
            //获取当前点击的元素的所有同级元素的html内容

            obj.style.width = '200px';
            obj.style.height = '150px';
            var con = obj.innerHTML;
            //判断当前点击元素内是否已经存在img图片元素，如果有则先全部清除后再添加，如果没有就直接添加
            if (con.indexOf("img") > 0) {
                var pic = obj.getElementsByTagName("img");
                for (i = 0; i < pic.length; i++) {
                    obj.removeChild(pic[i]);
                }
                //调用添加img图片的函数
                creatImg(pic);
            } else {
                creatImg(pic);
            }

            function creatImg(pic) {
                //创建一个img元素
                var img = document.createElement("img");
                var span = document.createElement("span");
                span.className = 'del_span';
                span.innerText = '删除';
                //设置img元素的源文件路径，window.URL.createObjectURL() 方法会根据传入的参数创建一个指向该参数对象的URL. 这个URL的生命仅存在于它被创建的这个文档里
                img.src = window.URL.createObjectURL(file[0]);
                //window.URL.revokeObjectURL() 释放一个通过URL.createObjectURL()创建的对象URL，在图片被显示出来后，我们就不再需要再次使用这个URL了，因此必须要在加载后释放它
                img.onload = function () {
                    window.URL.revokeObjectURL(this.src);
                }
                //在当前点击的input元素后添加刚刚创建的img图片元素
                obj.appendChild(img);
                obj.appendChild(span);
                span.onclick = function()
                {
                    var con = obj.innerHTML;
                    var pic = obj.getElementsByTagName("img");
                    var input = obj.getElementsByTagName("input");
                    input[0].value = '';
                    if (con.indexOf("img") > 0) {
                        var pic = obj.getElementsByTagName("img");
                        for (i = 0; i < pic.length; i++) {
                            obj.removeChild(pic[i]);
                        }
                    }
                    span.remove();
                    obj.style.width = '80px';
                    obj.style.height = '80px';
                }
            }
        }
    </script>
</div>
</div>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
<?php if(($aName == 'doadd') OR ($aName == 'doedit')): ?>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<?php endif; ?>
    </body>
</html>
