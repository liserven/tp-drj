layui.use(['layer','custom'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom,
        form = layui.form




    $(".changes").each(function (e) {
        var _this = $(this);
        _this.click(function(){

            var content = _this.attr('data-id');

            $.post('/api/v1/jpush', {content:content}, function (result) {
                if( result.bol)
                {
                    common.dMsg({
                        msg: '推送成功',
                        bol: true
                    },1);
                }
                else{
                    common.dMsg({
                        msg: '推送失败',
                        bol: false
                    },1);
                }
            } )

            return false;

        });


    });

















});