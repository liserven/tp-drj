<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:73:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\expert\doedit.html";i:1517386929;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\layout.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\header.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\footer.html";i:1517209356;}*/ ?>

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
    <form class="layui-form" method="post" action="<?php echo url('admin/Banner/doAdd'); ?>" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">名称：</label>
            <div class="layui-col-md3">
                <input type="text" name="name" lay-verify="required" placeholder="请输入名称" value="<?php echo $data['name']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机：</label>
            <div class="layui-col-md3">
                <input type="text" name="phone" lay-verify="phone" placeholder="请输入手机" value="<?php echo $data['phone']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">头像：</label>
            <div class="layui-col-md3">
                <div id="container">
                    <button id="pickfiles" class="layui-btn layui-btn-normal" type="" data-is="1">上传</button>
                </div>
                <img src="<?php echo $data['logo']; ?>"  id="yl_logo"/>
                <input type="hidden" value="<?php echo $data['logo']; ?>" name="logo" id="logo_img">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">性别：</label>
            <div class="layui-input-block">
                <input type="radio" name="sex" value="1" title="男" <?php if($data['sex'] == '1'): ?>checked<?php endif; ?> >
                <input type="radio" name="sex" value="2" title="女" <?php if($data['sex'] == '2'): ?>checked<?php endif; ?> >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所在医院：</label>
            <div class="layui-col-md3">
                <input type="text" name="hospital" lay-verify="required" value="<?php echo $data['hospital']; ?>" placeholder="请输入地址" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">医生资质：</label>
            <div class="layui-input-black">
                <?php if(is_array($qualifications) || $qualifications instanceof \think\Collection || $qualifications instanceof \think\Paginator): $i = 0; $__LIST__ = $qualifications;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="qualifications[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>"
                           lay-skin="primary" <?php if(in_array( $vo['id'], $qualificationsd)): ?>checked<?php endif; ?> >

                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">学历</label>
            <div class="layui-input-block">
                <select name="education" lay-verify="required">
                    <option value=""></option>
                    <option value="博士后" <?php if($data['education'] == '博士后'): ?>selected<?php endif; ?> >博士后</option>
                    <option value="双博士" <?php if($data['education'] == '双博士'): ?>selected<?php endif; ?>>双博士</option>
                    <option value="博士" <?php if($data['education'] == '博士'): ?>selected<?php endif; ?>>博士</option>
                    <option value="双硕士" <?php if($data['education'] == '双硕士'): ?>selected<?php endif; ?>>双硕士</option>
                    <option value="硕士" <?php if($data['education'] == '硕士'): ?>selected<?php endif; ?>>硕士</option>
                    <option value="本科" <?php if($data['education'] == '本科'): ?>selected<?php endif; ?>>本科</option>
                    <option value="进修" <?php if($data['education'] == '进修'): ?>selected<?php endif; ?>>进修</option>
                    <option value="专科" <?php if($data['education'] == '专科'): ?>selected<?php endif; ?>>专科</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">当前职务</label>
            <div class="layui-input-block">
                <select name="current_post" lay-verify="required">
                    <option value=""></option>
                    <option value="院长" <?php if($data['current_post'] == '院长'): ?>selected<?php endif; ?> >院长</option>
                    <option value="副院长" <?php if($data['current_post'] == '副院长'): ?>selected<?php endif; ?> >副院长</option>
                    <option value="主任医师" <?php if($data['current_post'] == '主任医师'): ?>selected<?php endif; ?>>主任医师</option>
                    <option value="副主任医师" <?php if($data['current_post'] == '副主任医师'): ?>selected<?php endif; ?>>副主任医师</option>
                    <option value="医生" <?php if($data['current_post'] == '医生'): ?>selected<?php endif; ?>>医生</option>
                    <option value="实习医生" <?php if($data['current_post'] == '实习医生'): ?>selected<?php endif; ?>>实习医生</option>
                    <option value="外聘教授" <?php if($data['current_post'] == '外聘教授'): ?>selected<?php endif; ?>>外聘教授</option>
                    <option value="中心主任" <?php if($data['current_post'] == '中心主任'): ?>selected<?php endif; ?>>中心主任</option>
                    <option value="主诊医生" <?php if($data['current_post'] == '主诊医生'): ?>selected<?php endif; ?>>主诊医生</option>
                    <option value="研究员" <?php if($data['current_post'] == '研究员'): ?>selected<?php endif; ?>>研究员</option>
                    <option value="副研究员" <?php if($data['current_post'] == '副研究员'): ?>selected<?php endif; ?>>副研究员</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">擅长项目：</label>
            <div class="layui-input-black">
                <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="project[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>"
                           lay-skin="primary" <?php if(in_array( $vo['id'], array_column($projects, 'project_id') )): ?>checked<?php endif; ?>>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">医生介绍：</label>
            <div class="layui-input-inline" style="width:600px;">
                <textarea name="message" placeholder="请输入内容" class="layui-textarea"><?php echo $data['message']; ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所得成果：</label>
            <div class="layui-input-inline" style="width:600px;">
                <textarea name="fruit" placeholder="请输入医生成果以,分割" class="layui-textarea"><?php echo $data['fruit']; ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">从业时间：</label>
            <div class="layui-col-md3">
                <input type="text" name="start_time" lay-verify="required" placeholder="请输入从业开始时间" value="<?php echo $data['start_time']; ?>" class="layui-input"
                       id="cy_time">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">资格证：</label>
            <div class="layui-col-md3">
                <div id="zgz_box">
                    <button id="zgz" class="layui-btn layui-btn-normal">上传</button>
                </div>
                <img src="<?php echo $data['zgz_img']; ?>"  id="zgz_yl_img"/>
                <input type="hidden" name="zgz" value="<?php echo $data['zgz_img']; ?>" id="zgz_img">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">从业证：</label>
            <div class="layui-col-md3">
                <div id="zyz_box">
                    <button id="zyz" class="layui-btn layui-btn-normal">上传</button>
                </div>
                <img src="<?php echo $data['zyz_img']; ?>"  id="zyz_yl_img"/>
                <input type="hidden" name="cyz" value="<?php echo $data['zyz_img']; ?>" id="zyz_img">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">美容医生从业资格证：</label>
            <div class="layui-col-md3">
                <div id="mrysz_box">
                    <button id="mrysz" class="layui-btn layui-btn-normal">上传</button>
                </div>
                <img src="<?php echo $data['mrysz_img']; ?>"  id="mrysz_yl_img"/>
                <input type="hidden" name="mrzgz" value="<?php echo $data['mrysz_img']; ?>" id="mrysz_img">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">顺序</label>
            <div class="layui-input-inline">
                <input type="number" name="order" value="<?php echo $data['order']; ?>" lay-verify="required" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
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
