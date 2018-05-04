layui.use(['form','custom'], function(){
    var form = layui.form
        , $  = layui.jquery
        , common = layui.custom;


    common.ImageUploads({
        demoListView: $('#zs-detail'), //显示图片信息地方
        elem : '#zs-list', //点击选择图片按钮
        bindAction : '#zs-start-btn', //开始上传按钮
        fileName : 'zs-input',
    });
    common.ImageUploads({
        demoListView: $('#lb-detail'), //显示图片信息地方
        elem : '#lb-list', //点击选择图片按钮
        bindAction : '#lb-start-btn', //开始上传按钮
        fileName : 'lb-input',
    });

    common.imgUpload({
        bthObj : '#img-upload-1', //点击上传按钮
        imgObj : '#img-upload-1', //图片预览img对象
        inputObj : '#input-form-1',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-b', //点击上传按钮
        imgObj : '#img-upload-b', //图片预览img对象
        inputObj : '#input-form-b',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-c', //点击上传按钮
        imgObj : '#img-upload-c', //图片预览img对象
        inputObj : '#input-form-c',  //上传成功，表单放置对象
    });

    
    var screen = 2;
    $("#add_screen").click(function () {
        html = '<div class="layui-form-item screen_box_t"><label class="layui-form-label">规格</label><div class="layui-block" >\n' +
            '                <div class="layui-col-md2">\n' +
            '                    <img src="" id="img-upload-'+screen+'" class="screen-img" alt="">\n' +
            '                    <input type="hidden" name="img[]" id="input-form-'+screen+'">\n' +
            '                </div>\n' +
            '                <div class="layui-input-inline gg">\n' +
            '                    <input name="size[]" placeholder="例80*80-黄-风格" autocomplete="off" class="layui-input" type="text">\n' +
            '                </div>\n' +
            '                <div class="layui-input-inline gg">\n' +
            '                    <input name="stock[]" placeholder="库存" autocomplete="off" class="layui-input" type="text">\n' +
            '                </div>\n' +
            '                <div class="layui-input-inline gg">\n' +
            '                    <input name="price[]" placeholder="价格" autocomplete="off" class="layui-input" type="text">\n' +
            '                </div>\n' +
            '            </div></div>';
        $(".screen_box").append(html);
        common.imgUpload({
            bthObj : '#img-upload-'+screen+'', //点击上传按钮
            imgObj : '#img-upload-'+screen+'', //图片预览img对象
            inputObj : '#input-form-'+screen+'',  //上传成功，表单放置对象
        });
        screen++
        return false;
    });

    $("#del_screen").click(function () {
        if($(".screen_box").find(".screen_box_t").length > 1)
        {
            $(".screen_box").find(".screen_box_t:last-child").remove();
        }
        else{
            layer.msg("务必添加一个规格");
        }
        screen--;
        return false;
    });


    //三级联动
    form.on("select(sort)", function(data){
        var value =$("select#culm option:selected").attr('data-id')

        var url = common.url('admin/Clum/getSortByPid');
        $.get(url , { id : value}, function(result ){
            $('.two-sort').html(result);
            form.render(); //更新全部
            var value =$("select.two-sort option:selected").attr('data-id')
            var url = common.url('admin/Clum/getSet');

            $.get(url , { id : value}, function(result ){
                $('#addiv').html(result);
                form.render(); //更新全部
            });
            form.on("select(two-sort)", function(data){
                var value =$("select.two-sort option:selected").attr('data-id')
                var url = common.url('admin/Clum/getSet');
                $.get(url , { id : value}, function(result ){
                    $('#addiv').html(result);
                    form.render(); //更新全部
                });
            });
        });
    });




})








