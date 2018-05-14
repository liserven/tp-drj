layui.use(['layer','custom','form'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom;



    $(".forbidden").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');
            $.post('/admin/Consumer/forbidden', {id: id}, function (result) {
                if (result.bol) {
                    common.dMsg({
                        msg: '成功',
                        bol: true
                    }, 1);
                }
                else {
                    common.dMsg({
                        msg: '失败',
                        bol: false
                    }, 1);
                }
            })

            return false;

        });

    });
    $(".forbiddenr").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');
            $.post('/admin/Consumer/forbiddenr', {id: id}, function (result) {
                if (result.bol) {
                    common.dMsg({
                        msg: '成功',
                        bol: true
                    }, 1);
                }
                else {
                    common.dMsg({
                        msg: '失败',
                        bol: false
                    }, 1);
                }
            })

            return false;

        });

    });

    $(".getUserAddress").each(function(e){
        var _this = $(this);
        _this.click(function () {
            var id = document.getElementById("id").value
            var url = '/admin/Consumer/getUserAddress?id='+id;
            var name = _this.attr('name');
            var title = '查询 <strong style="color:#f60"> '+name+' </strong>详细情况';
            common.dialog({url:url, area:[ '50%','60%' ], title:title});
        });
    });

    });
