layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;



    common.imgUpload({
        bthObj : '#img-upload-1', //点击上传按钮
        imgObj : '#img-upload-1', //图片预览img对象
        inputObj : '#input-form-1',  //上传成功，表单放置对象
    });





});