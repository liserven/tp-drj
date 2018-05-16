<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpStudy\WWW\drhome\public/../application/admin\view\partner\tolist.html";i:1526458344;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    <legend>申请列表
        <a href="javascript:;" class="layui-btn layui-btn-default layui-btn-small refresh"><i class="layui-icon">&#x1002;</i>刷新</a>
    </legend>
</fieldset>
<div class="layui-form layui-border-box layui-table-view" lay-filter="content-box" style="padding: 20px;border: 0;">
    <div class="layui-table-box">
        <table class="layui-table" style="width: 100%; border: 1px solid #eee">
            <colgroup>
                <col width="50">
                <col width="50">
            </colgroup>
            <thead>
            <tr>
                <th data-field="0">
                    <div class="layui-table-cell laytable-cell-1-0 laytable-cell-numbers">
                        <span>#</span>
                    </div>
                </th>

                <th data-field="id">
                    <div class="layui-table-cell laytable-cell-1-id">
                        <span>ID</span>

                    </div>
                </th>
                <th data-field="name">
                    <div class="layui-table-cell">
                        <span>用户名称</span>
                    </div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>性别</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>出生日期</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>所在地区</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>半身照片</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>身份证正面</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>身份证反面</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>手机号</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>身份</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>付款状态</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>操作</span></div>
                </th>

            </tr>
            </thead>
            <tbody class="">
            <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr data-index="0" class="tbody_content" data-id="<?php echo $vo['id']; ?>">
                    <td >
                        <div class="layui-table-cell"><?php echo $key; ?></div>
                    </td>

                    <td>
                        <div class="layui-table-cell"><?php echo $vo['id']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell" class="name"><?php echo $vo['name']; ?></div>
                    </td>
                    <?php if($vo['sex'] == 1): ?>
                    <td>
                        <div class="layui-table-cell">男</div>
                    </td>
                        <?php elseif($vo['sex'] == 2): ?>
                            <td>
                                <div class="layui-table-cell">女</div>
                            </td>
                        </elseif>
                            <?php else: ?>
                                <td>
                                    <div class="layui-table-cell">保密</div>
                                </td>
                            </else>

                    <?php endif; ?>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['birthday']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['address']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell img-detail">
                            <img src="<?php echo $vo['id_photo']; ?>?imageView2/1/w/50/h/50">
                        </div>
                        <div style="display:none;">
                            <img src="<?php echo $vo['id_photo']; ?>" alt="">
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell img-detail">
                            <img src="<?php echo $vo['id_code_just']; ?>?imageView2/1/w/50/h/50">
                        </div>
                        <div style="display:none;">
                            <img src="<?php echo $vo['id_code_just']; ?>" alt="">
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell img-detail">
                            <img src="<?php echo $vo['id_code_back']; ?>?imageView2/1/w/50/h/50"/>
                        </div>
                        <div style="display:none;">
                            <img src="<?php echo $vo['id_code_back']; ?>?imageView1/1/w/300/h/300" alt="">
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['phone']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['type']; ?></div>
                    </td>
                    <?php if($vo['examine_status'] == '4'): ?>
                    <td>
                        <div class="layui-table-cell"><?php echo aliPayStatusNum($vo['examine_status']); ?></div>
                    </td>
                    <?php endif; ?>
                    <td>
                        <div class="layui-table-cell"><?php echo aliPayStatusNum($vo['examine_status']); ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <input type="hidden" name="" class="wx" value="<?php echo $vo['transaction_id']; ?>">
                            <input type="hidden" name="" class="zfb" value="<?php echo $vo['trade_no']; ?>">
                            <?php if($vo['examine_status'] == '1'): ?>
                                <a class="layui-btn layui-btn-xs find-ali-status" pay-type="<?php echo $vo['payment_type']; ?>" name="<?php echo $vo['name']; ?>">查询付款</a>

                                <a class="layui-btn layui-btn-xs">已通过</a>
                            <?php endif; if($vo['examine_status'] == '3'): ?>
                                <a class="layui-btn layui-btn-xs aggry" data-id="<?php echo $vo['user_id']; ?>">通过</a>
                                <a class="layui-btn layui-btn-danger unaggry layui-btn-xs"data-id="<?php echo $vo['user_id']; ?>">拒绝</a>
                            <?php endif; if($vo['examine_status'] == '2'): ?>
                                <a class="layui-btn layui-btn-xs">未通过</a>
                            <?php endif; ?>
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
