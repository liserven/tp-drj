<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:73:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\science\doadd.html";i:1517567096;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\layout.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\header.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\footer.html";i:1517209356;}*/ ?>

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
            <label class="layui-form-label">项目类别</label>
            <div class="layui-input-inline">
                <select name="one_xm" lay-filter="one-project">
                    <option value="">请选择</option>
                    <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="two-pro" class="two-pro" lay-filter="two-project">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="three-pro" lay-filter="three-project" class="three-pro">
                    <option value="">请选择</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类型：</label>
            <div class="layui-col-md3">
                <input type="text" name="type" lay-verify="required" placeholder="请输入" class="layui-input" list="type">
                <datalist id="type">
                    <?php if(is_array($config['type']) || $config['type'] instanceof \think\Collection || $config['type'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['type'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </datalist>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否住院：</label>
            <div class="layui-col-md3">

                    <input type="radio" name="is_hospitalization" value="是" title="是">
                    <input type="radio" name="is_hospitalization" value="否" title="否" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">麻醉方式：</label>
            <div class="layui-col-md3">
                <input type="text" name="anesthetic_method" lay-verify="required" placeholder="请输入" class="layui-input" list="anesthetic_method">
                <datalist id="anesthetic_method">
                    <?php if(is_array($config['anesthetic_method']) || $config['anesthetic_method'] instanceof \think\Collection || $config['anesthetic_method'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['anesthetic_method'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </datalist>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">疼痛感：</label>
            <div class="layui-col-md3">
                <input type="text" name="pain" lay-verify="required" placeholder="请输入" class="layui-input" list="pain">
                <datalist id="pain">
                    <?php if(is_array($config['pain']) || $config['pain'] instanceof \think\Collection || $config['pain'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['pain'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </datalist>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">治疗时间：</label>
            <div class="layui-col-md3">
                <input type="text" name="treatment_time" lay-verify="required" placeholder="请输入" class="layui-input" list="treatment_time">
                <datalist id="treatment_time">
                    <?php if(is_array($config['treatment_time']) || $config['treatment_time'] instanceof \think\Collection || $config['treatment_time'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['treatment_time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </datalist>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">维持时间：</label>
            <div class="layui-col-md3">
                <input type="text" name="maintain_time" lay-verify="required" placeholder="请输入" class="layui-input" list="maintain_time">
                <datalist id="maintain_time">
                    <?php if(is_array($config['maintain_time']) || $config['maintain_time'] instanceof \think\Collection || $config['maintain_time'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['maintain_time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </datalist>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">拆线时间：</label>
            <div class="layui-col-md3">
                <input type="text" name="breaking_time" lay-verify="required" placeholder="请输入" class="layui-input" list="breaking_time">
                <datalist id="breaking_time">
                    <?php if(is_array($config['breaking_time']) || $config['breaking_time'] instanceof \think\Collection || $config['breaking_time'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['breaking_time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </datalist>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">参考价格：</label>
            <div class="layui-col-md3">
                <input type="text" name="reference_price" lay-verify="required" placeholder="请输入" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">简介：</label>
            <div class="layui-input-block">
                <textarea name="message" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">效果展示图片：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="testList">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="demoList"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="testListAction">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">原理：</label>
            <div class="layui-input-block">
                <textarea id="yl" class="layui-textarea" name="principle"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">原理图：</label>
            <div class="layui-input-block">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-normal" id="yl-list">选择多文件</button>
                    <div class="layui-upload-list">
                        <table class="layui-table">
                            <thead>
                            <tr><th>文件名</th>
                                <th>大小</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr></thead>
                            <tbody id="yl-detail"></tbody>
                        </table>
                    </div>
                    <button type="button" class="layui-btn" id="yl-start-btn">开始上传</button>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">优点：</label>
            <div class="layui-input-block">
                <textarea id="yd" class="layui-textarea" name="advantage"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">风险：</label>
            <div class="layui-input-block">
                <textarea id="fx" class="layui-textarea" name="risk"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">术前锦囊：</label>
            <div class="layui-input-block">
                <textarea id="sq_id" class="layui-textarea" name="operation_before">
                </textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">术后锦囊：</label>
            <div class="layui-input-block">
                <textarea id="sh_id" class="layui-textarea" name="operation_after">
                </textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">顺序：</label>
            <div class="layui-col-md1">
                <input type="number" name="order" value="99" lay-verify="required"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
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
<?php endif; ?>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
    </body>
</html>
