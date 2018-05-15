layui.use(['layer','custom'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom;

    $(".find-ali-status").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');


            var url = '/admin/Orbuilding/logistics?id=' + id;

            var title = '填写运单号';


            common.dialog({url: url, area: ['30%', '40%'], title: title});
        });
    });
    $(".detail").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');


            var url = '/admin/Orbuilding/detail?id=' + id;

            var title = '填写运单号';


            common.dialog({url: url, area: ['30%', '40%'], title: title});
        });
    });
    $(".detail_set").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');


            var url = '/admin/Orbuilding/details?id=' + id;

            var title = '修改运单号';


            common.dialog({url: url, area: ['30%', '40%'], title: title});
        });
    });
});









