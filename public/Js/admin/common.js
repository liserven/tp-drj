
//定义一个模块
layui.define(['form', 'layer','laydate','upload'], function (exports) {
    var $ = layui.jquery
        , form = layui.form
        , upload = layui.upload
        , laydate = layui.laydate;
    var custom = {
        //自定义时间控件
        date: function (options) {
            //给传输过来的参数 设置默认值
            options = options ? options : {};
            //设置默认值
            var default_options = {
                elem: '#date-time',
                type: 'datetime'
            };
            //合并参数
            $.extend(default_options, options);
            //调用时间控件生成
            laydate.render({
                elem: default_options.elem,
                type: default_options.type
            });
        },
        //自定义封装url
        url : function (str, bol, opns) {
            var strs = typeof ( opns ) != 'undefined' && opns.length > 0 ? str + "/" + opns : str;

            return bol ? config.gurl + str : config.curl + '/' + str;
        },
        
        //自定义弹窗方法
        dialog : function (options, isFull) {
            var full = isFull === true ? isFull : false;
            //设置默认值
            var default_options = {
                type:2,
                title: '添加',
                url: '',
                area: ['900px', '650px'],
                anim: 1,
            };
            //合并参数
            $.extend(default_options, options);
            var dialog = layer.open({
                type: default_options.type,
                title: default_options.title,
                content: default_options.url,
                area: default_options.area,
                anim: default_options.anim,
                fixed: false,
                resize:false,
            });
            if( isFull === true )
            {
                layer.full(dialog);
            }
        },
        //异步请求方法
        ajax : function (options) {
            var default_options = {
                onSubmitBtn:'#submit',
                type:'POST',
                async : true,
                dataType: 'JSON',
                url: 'doAdd',
                data: {},
                beforeSend : function () {
                    $(default_options.onSubmitBtn).attr({ disabled: "disabled" });
                    layer.msg('玩命请求中', {
                        icon: 16
                        ,shade: 0.01
                    });
                },
                complete: function () {
                    $(default_options.onSubmitBtn).removeAttr("disabled");
                },
                callrack : function (result) {
                    if( result.bol )
                    {
                        layer.msg(result.msg, {icon:1, time:1000});
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                    else{
                        layer.msg(result.msg, {icon:2, time:1000});
                    }
                }
            };
            $.extend(default_options, options);
            $.ajax({
                complete:default_options.complete(),
                beforeSend : default_options.beforeSend(),
                async : default_options.async,
                data : default_options.data,
                type : default_options.type,
                dataType : default_options.dataType,
                url : default_options.url,
                success : default_options.callrack()
            });
        },
        /**
         * 上传图片公共接口
         */
        imgUpload:function (options) {
            var default_option = {
                bthObj : '#img-upload', //点击上传按钮
                imgObj : '#yl-img', //图片预览img对象
                inputObj : '#input-form',  //上传成功，表单放置对象
                errorObj : '#error-box' //上传失败，再次上传 重试区域
            };
            $.extend(default_option, options);
            var uploadInst = upload.render({
                elem: default_option.bthObj
                , url: custom.url('admin/Image/uploadImg')
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $(default_option.imgObj).attr('src', result); //图片链接（base64）
                    });
                }
                , done: function (res) {
                    //如果上传失败
                    if (res.code > 0) {
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    $(default_option.inputObj).val( res.str);
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var demoText = $(demoText.errorObj);
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function () {
                        uploadInst.upload();
                    });
                }
            });
        },
        QiniuUpload:function(options,isEditor){
            isEditor = isEditor == 'undefined' || isEditor == null ? 1 : 2;
        	var default_option = {
        			browse_button: 'pickfiles',//上传选择的点选按钮
        			container: 'container',//上传区域DOM ID，默认是browser_button的父元素，
        			//drop_element: 'container',//拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
        			yl_img : '#yl_logo', //预览图片区域
        			input_value:'#logo_img',//提交表单隐藏区域
                    editor : {},
                    init : {
                        'BeforeUpload': function(up, file) {
                            // 每个文件上传前，处理相关的事情
                            layer.open({
                                type: 1,
                                skin: 'layui-layer-rim', //加上边框
                                area: ['420px', '240px'], //宽高
                                content: ' <div style="text-align: center;padding-top: 40px;">' +
                                '<progress  id="progressBar" value="0" max="100"></progress><span id="percentage"></span>' +
                                '</div>'
                            });
                        },
                        'UploadProgress': function(up, file) {
                            // 实现进度条功能
                            $('#progressBar').val(file.percent);
                            $('#percentage').text(file.percent + '%');
                        },
                        'FileUploaded': function(up, file, info) {
                            layer.msg('成功');
                            $('.layui-layer-shade').remove();
                            $('.layui-layer-page').remove();
                            var container = $('#'+default_option.container);
                            var parent = container.parent('.layui-input-block');
                            container.remove();
                            parent.text('上传成功');
                            $(default_option.yl_img).attr('src', 'http://oy1wh09ro.bkt.clouddn.com/'+up.files[0].target_name);
                            $(default_option.input_value).val('http://oy1wh09ro.bkt.clouddn.com/'+up.files[0].target_name);
                        },
                        'Error': function(up, err, errTip) {
                            layer.msg('失败');
                        }
                    },
                    wangEditor: {
                        'BeforeUpload': function(up, file) {
                            // 每个文件上传前，处理相关的事情
                            layer.open({
                                type: 1,
                                skin: 'layui-layer-rim', //加上边框
                                area: ['420px', '240px'], //宽高
                                content: ' <div style="text-align: center;padding-top: 40px;">' +
                                '<progress  id="progressBar" value="0" max="100"></progress><span id="percentage"></span>' +
                                '</div>'
                            });
                        },
                        'UploadProgress': function(up, file) {
                            // 显示进度

                            // 实现进度条功能
                            $('#progressBar').val(file.percent);
                            $('#percentage').text(file.percent + '%');
                        },
                        'FileUploaded': function(up, file, info) {
                            layer.msg('成功');
                            $('.layui-layer-shade').remove();
                            $('.layui-layer-page').remove();
                            var domain = up.getOption('domain');
                            var sourceLink = domain + up.files[0].target_name; //获取上传成功后的文件的Url
                            // 插入图片到editor
                            default_option.editor.cmd.do('insertHtml', '<img src="' + sourceLink + '" style="max-width:100%;"/>')
                        },
                        'Error': function(up, err, errTip) {
                            //上传出错时,处理相关的事情
                            console.log('on Error');
                        },
                        'UploadComplete': function() {
                            //队列文件处理完毕后,处理相关的事情
                            console.log('on UploadComplete');
                        }
                    },
                };
        	$.extend(default_option, options);
        	Qiniu.uploader({
                runtimes: 'html5,flash,html4', //上传模式,依次退化
                browse_button: default_option.browse_button, //上传选择的点选按钮，**必需**
                uptoken_url: custom.url('admin/getToken/getQiNiuToken'), //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
                domain: 'http://oy1wh09ro.bkt.clouddn.com/', //bucket 域名，下载资源时用到，**必需**
                container: default_option.container, //上传区域DOM ID，默认是browser_button的父元素，
                max_file_size: '300mb', //最大文件体积限制
                flash_swf_url: 'plupload/Moxie.swf', //引入flash,相对路径
                max_retries: 3, //上传失败最大重试次数
                dragdrop: true, //开启可拖曳上传
                drop_element: default_option.container, //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                chunk_size: '4mb', //分块上传时，每片的体积
                auto_start: true, //选择文件后自动上传，若关闭需要自己绑定事件触发上传
                unique_names: true,
                init: isEditor == 1 ? default_option.init : default_option.wangEditor
            });
        },
        printLog : function (title, info) {
            window.console && console.log(title, info);
        },
        /**
         * 多图上传
         */
        ImageUploads:function(options){
            var default_option = {
                demoListView: $('#demoList'), //显示图片信息地方
                elem : '#testList', //点击选择图片按钮
                bindAction : '#testListAction', //开始上传按钮
                fileName : 'img',
            };
            $.extend(default_option, options);
            var demoListView = default_option.demoListView
                ,uploadListIns = upload.render({
                elem: default_option.elem
                ,url: custom.url('admin/Api/uploadImg')
                ,accept: 'file'
                ,multiple: true
                ,auto: false
                ,bindAction: default_option.bindAction
                ,choose: function(obj){
                    var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
                    //读取本地文件
                    obj.preview(function(index, file, result){
                        var tr = $(['<tr id="upload-'+ index +'">'
                            ,'<td>'+ file.name +'</td>'
                            ,'<input type="hidden" name="'+default_option.fileName+'[]" id="lsy-'+index+'" />'
                            ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
                            ,'<td>等待上传</td>'
                            ,'<td class="yl-'+index+'"><img src="" alt="" width="80" height="80"></td>'
                            ,'<td>'
                            ,'<button class="layui-btn layui-btn-mini demo-reload layui-hide">重传</button>'
                            ,'<button class="layui-btn layui-btn-mini layui-btn-danger demo-delete">删除</button>'
                            ,'</td>'
                            ,'</tr>'].join(''));

                        //单个重传
                        tr.find('.demo-reload').on('click', function(){
                            obj.upload(index, file);
                        });

                        //删除
                        tr.find('.demo-delete').on('click', function(){
                            delete files[index]; //删除对应的文件
                            tr.remove();
                            uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
                        });

                        demoListView.append(tr);
                    });
                }
                ,done: function(res, index, upload){
                    if(res.code == 0){ //上传成功
                        $('#lsy-'+index).val(res.data.src);
                        $('#lsy-'+index).siblings('td.yl-'+index).find('img').attr('src', res.data.src);
                        var tr = demoListView.find('tr#upload-'+ index)
                            ,tds = tr.children();
                        tds.eq(2).html('<span style="color: #5FB878;">上传成功</span>');
                        tds.eq(3).html(''); //清空操作
                        return delete this.files[index]; //删除文件队列已经上传成功的文件
                    }
                    this.error(index, upload);
                }
                ,error: function(index, upload){
                    var tr = demoListView.find('tr#upload-'+ index)
                        ,tds = tr.children();
                    tds.eq(2).html('<span style="color: #FF5722;">上传失败</span>');
                    tds.eq(3).find('.demo-reload').removeClass('layui-hide'); //显示重传
                }
            });
        },

                        //封装自定义lyer.msg(),
        /*
        参数 options 对象
            基本和后台传回前台数据吻合
            { msg : 需要提示的内容 bol : 确定弹出窗口的样式 }
            time : 弹出显示时间 默认2000 既2秒
            isParents : 是否是刷新父级页面　默认是２秒后刷新页面
            callback : 回调方法
         */
        dMsg : function(options, isParents, time, callback){
            //1为刷新本页面 2为刷新父级页面
            var parentsResearch = isParents == 1 ? isParents : 2;
            var default_option = {
                msg : 'error',
                bol : false,
            };
            $.extend(default_option, options);
            default_option.typeObj = {
                icon : default_option.bol === true ? 1 : 2,
                time : time? time : 2000,
            };

            var dialog = layer.msg(default_option.msg, default_option.typeObj);
            if( default_option.bol === true )
            {
                setTimeout(function () {
                    if( parentsResearch == 1 )
                    {
                        window.location.reload();
                    }
                    else{
                        window.parent.location.reload();
                    }
                }, default_option.typeObj.time);
            }
            if( typeof callback === 'function' )
            {
                callback();
            }
        },
        
        wangEditorInit:function (options) {
            var default_option = {
                initId : 'div1', //初始化富文本id
                textareaId : 'message', //同步显示编辑框id
                menus:[
                    'head',  // 标题
                    'bold',  // 粗体
                    'italic',  // 斜体
                    'underline',  // 下划线
                    'strikeThrough',  // 删除线
                    'foreColor',  // 文字颜色
                    'backColor',  // 背景颜色
                    'link',  // 插入链接
                    'list',  // 列表
                    'justify',  // 对齐方式
                    'quote',  // 引用
                    'emoticon',  // 表情
                    'image',  // 插入图片
                    'table',  // 表格
                    'video',  // 插入视频
                    'code',  // 插入代码
                    'undo',  // 撤销
                    'redo'  // 重复
                ],
                emotions : [
                    {
                        // tab 的标题
                        title: '默认',
                        // type -> 'emoji' / 'image'
                        type: 'image',
                        // content -> 数组
                        content: [
                            {
                                alt: '[坏笑]',
                                src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/50/pcmoren_huaixiao_org.png'
                            },
                            {
                                alt: '[舔屏]',
                                src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/pcmoren_tian_org.png'
                            }
                        ]
                    },
                    {
                        // tab 的标题
                        title: 'emoji',
                        // type -> 'emoji' / 'image'
                        type: 'emoji',
                        // content -> 数组
                        content: ['😀', '😃', '😄', '😁', '😆']
                    }
                ]

            };
            $.extend(default_option, options);

            var E = window.wangEditor
            var editor = new E('#'+default_option.initId);
            var $text1 = $('#'+default_option.textareaId);
            editor.customConfig.qiniu = true;
            editor.customConfig.menus = default_option.menus;  //菜单
            editor.customConfig.onchange = function (html) {
                // 监控变化，同步更新到 textarea
                $text1.val(html)
            }
            editor.create()
            // 初始化 textarea 的值
            $text1.val(editor.txt.html())
            if( $.inArray( 'image', default_option.menus) >= 0 )
            {
                custom.QiniuUpload({
                    browse_button: editor.imgMenuId,//上传选择的点选按钮
                    container: editor.toolbarElemId,//上传区域DOM ID，默认是browser_button的父元素，
                    drop_element: editor.textElemId,//拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                    editor:editor,
                },2);
            }
        }
    };
    //复选框选择事件 全选事件
    form.on('checkbox(layTableAllChoose)', function (data) {
        if (data.elem.checked) {
            $('tbody .layui-form-checkbox').addClass('layui-form-checked');
        }
        else {
            $('tbody .layui-form-checkbox').removeClass('layui-form-checked');
        }
    });
    exports('custom',custom);

})