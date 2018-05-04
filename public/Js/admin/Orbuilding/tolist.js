layui.use(['layer','custom'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom;

    $(".find-ali-status").each(function(e){
        var _this = $(this);
        _this.click(function () {
            var url = '';

            var title = '填写运单号';


            common.dialog({url:url, area:[ '30%','40%' ], title:title});
        });
    });



});
