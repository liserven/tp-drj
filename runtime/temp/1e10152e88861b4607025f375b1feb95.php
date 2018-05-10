<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\phpStudy\WWW\drhome\public/../application/admin\view\partners\tolist.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>

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
    
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>信息统计
        <a href="javascript:;" class="layui-btn layui-btn-default layui-btn-small refresh"><i class="layui-icon">&#x1002;</i>刷新</a>
    </legend>
</fieldset>
<div class="layui-col-md12">
    <div class="layui-form-query">
        <form class="layui-form" id="query_form" action="">
            <div class="layui-form-item" style="padding-left:20px ;">
                <div class="layui-block">
                    <label class="layui-form-mid">地区：</label>
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

                    <div class="layui-inline">

                        <input type="text" name="start_time" id="start_time" placeholder="查询开始时间" class="layui-input">

                    </div>
                    <div class="layui-inline">

                        <input type="text" name="over_time" id="over_time" placeholder="查询开始时间" class="layui-input">

                    </div>
                    <div class="layui-inline">
                        <select name="order" id="order" lay-filter="sort">
                            <option value="2">由高到低</option>
                            <option value="1">由低到高</option>
                        </select>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <button class="layui-btn" type="submit" lay-submit="seach_phone" lay-filter="find"><i class="layui-icon"></i>查询
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="layui-form layui-border-box layui-table-view" lay-filter="content-box" style="padding: 20px;border: 0;">
    <div class="layui-table-box findBox">
        <table class="layui-table" style="width: 100%; border: 1px solid #eee">
            <colgroup>
                <col width="50">
                <col width="50">
            </colgroup>
            <thead>
            <tr>
                <th data-field="name" class="col-md-4">
                    <div class="layui-table-cell">
                        <span>地区名称</span>
                    </div>
                </th>
                <th data-field="type"  class="col-md-4">
                    <div class="layui-table-cell"><span>合伙人数量</span></div>
                </th>
                <th data-field="type"  class="col-md-4">
                    <div class="layui-table-cell"><span>排名</span></div>
                </th>
            </tr>
            </thead>
            <tbody class="">
            <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr data-index="0" class="tbody_content" data-id="<?php echo $vo['ud_id']; ?>">
                    <td   class="col-md-4">
                        <div class="layui-table-cell" style="width: 33%;"><?php echo $vo['name']; ?></div>
                    </td>
                    <td  style="width: 33%;">
                        <div class="layui-table-cell"><?php echo $vo['totals']; ?></div>
                    </td>
                    <td  style="width: 33%;">
                        <div class="layui-table-cell" style="width: 33%;">
                            <span class="layui-badge <?php echo $key+1<=3?'layui-badge' : 'layui-bg-gray'; ?>"><?php echo $key+1; ?></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="13"><?php echo $page->render();; ?></td>
            </tr>
            </tfoot>
        </table>

    </div>
</div>
</div>
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
