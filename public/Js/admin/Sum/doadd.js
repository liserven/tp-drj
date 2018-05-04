layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
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

    var areaID = 0;
    function selectArea(type){
        areaID = $("#select-"+type+" option:selected").val();
        if(areaID == 0){
            if(type == 1){
                $("#select-2").html("<option value='0'>请选择分类</option>");
                $("#select-3").html("<option value='0'>请选择分类</option>");
                areaID = 0;
            }
            if(type == 2){
                $("#select-3").html("<option value='0'>请选择分类</option>");
                areaID = $("#select-1").val();
            }
            if(type == 3){
                areaID = $("#select-2").val();
            }
            return;
        }
        if(type ==3){
            return ;
        }
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'areaID':areaID,'type':type},
            url:'/admin/Clum/changeArea3',
            success:function(data){
                if(data.status == 1){
                    if(type == 1){
                        $("#select-2").html(data.data);
                        $("#select-3").html("<option value='0'>请选择分类</option>");
                    }
                    if(type == 2){
                        $("#select-3").html(data.data);
                    }
                }
            }
        })
    }

});