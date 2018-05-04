layui.use(['layer','custom'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom;

    //添加
    $('.add').click(function () {
        common.dialog({url:'doAdd', area:[ '700px','550px' ]});
    });

    //修改
    $('.edit').click(function () {
        var id = $(this).parents('tr').attr('data-id');
        common.dialog({url:'doEdit/id/'+id, area:[ '700px','550px' ]});
    });

});

