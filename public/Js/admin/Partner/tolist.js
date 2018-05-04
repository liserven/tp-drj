layui.use(['layer','custom'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom;
        


    $(".find-ali-status").each(function(e){
        var _this = $(this);
        _this.click(function () {
            var url = '';
            var trade_no = '';
            var name = _this.attr('name');
            var title = '查询 <strong style="color:#f60"> '+name+' </strong>付款情况';
            var pay_type = _this.attr('pay-type');
            if(pay_type == 'wx')
            {

            }

            if( pay_type == 'zfb' )
            {
                trade_no = _this.siblings('.'+pay_type).val();
                url = '/find_ali_status?trade_no='+trade_no;
            }
            common.dialog({url:url, area:[ '30%','40%' ], title:title});
        });
    });
    $(".img-detail").click(function () {
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: '516px',
            skin: 'layui-layer-nobg', //没有背景色
            shadeClose: true,
            content: $(this).next()
        });
    });
    $(".aggry").each(function (e) {
        var _this = $(this);
        _this.click(function(){

            var id = _this.attr('data-id');
            $.post('/admin/Partner/aggry', { id:id}, function (result) {
                if( result.bol)
                {
                    layer.msg('成功');

                }
                else{
                    layer.msg('失败');
                }
            } )

            return false;

        });


    });

});

