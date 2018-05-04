$(function () {

    $('.information-add').click(function () {
        var url = window.url('admin/Xiaoxi/doAdd');
        var index = layer.open({
            type: 2,
            title: '添加公告',
            content: url,
        });
        layer.full(index);
    });
    $('.information-edit').click(function () {
        var id = $(this).attr('data-id');
        var url = window.url('admin/Xiaoxi/doEdit/id/'+id);
        var index = layer.open({
            type: 2,
            title: '修改公告',
            content: url,
        });
        layer.full(index);
    });

    $('.getDetail').click(function () {
        var id = $(this).attr('data-id');
        var url = window.url('admin/Information/getDetail/id/'+id);
        var index = layer.open({
            type: 2,
            title: '预览',
            content: url,
            area: ['900px', '650px']
        });
        layer.full(index);
    });
    //修改状态方法

})