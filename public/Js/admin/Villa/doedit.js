layui.use(['form','custom'], function() {
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;


    common.ImageUploads({
        demoListView: $('#wg-detail'), //显示图片信息地方
        elem: '#wg-list', //点击选择图片按钮
        bindAction: '#wg-start-btn', //开始上传按钮
        fileName: 'wg-input',
    });
    common.ImageUploads({
        demoListView: $('#lb-detail'), //显示图片信息地方
        elem: '#lb-list', //点击选择图片按钮
        bindAction: '#lb-start-btn', //开始上传按钮
        fileName: 'lb-input',
    });
    common.ImageUploads({
        demoListView: $('#sn-detail'), //显示图片信息地方
        elem: '#sn-list', //点击选择图片按钮
        bindAction: '#sn-start-btn', //开始上传按钮
        fileName: 'sn-input',
    });
    common.ImageUploads({
        demoListView: $('#xj-detail'), //显示图片信息地方
        elem: '#xj-list', //点击选择图片按钮
        bindAction: '#xj-start-btn', //开始上传按钮
        fileName: 'xj-input',
    });
    common.ImageUploads({
        demoListView: $('#jg-detail'), //显示图片信息地方
        elem: '#jg-list', //点击选择图片按钮
        bindAction: '#jg-start-btn', //开始上传按钮
        fileName: 'jg-input',
    });
    common.ImageUploads({
        demoListView: $('#mj-detail'), //显示图片信息地方
        elem: '#mj-list', //点击选择图片按钮
        bindAction: '#mj-start-btn', //开始上传按钮
        fileName: 'mj-input',
    });

    common.imgUpload({
        bthObj: '#img-upload-b', //点击上传按钮
        imgObj: '#img-upload-b', //图片预览img对象
        inputObj: '#input-form-b',  //上传成功，表单放置对象
    });


    $(".delete-img").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');
            $.post('/admin/Villa/doImgDel', {id: id}, function (result) {
                if (result.bol) {
                    layer.msg('删除成功');
                    _this.parents('tr').remove();
                }
                else {
                    layer.msg('删除失败');
                }
            })

            return false;

        });

    });





})