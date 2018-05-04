layui.use(['form','custom', 'layer'], function(){
    var form = layui.form
        , $  = layui.jquery,
        layer = layui.layer
        , common = layui.custom;
   //省市二级联动并更新合伙人数量限制
    form.on("select(sort)", function(data){
        var value = data.value;
        var url = common.url('admin/District/getsortbypid');
        $.get(url , { provice_id : value}, function(result ){
            result = eval("("+result+")");
            $('.two-sort').html(result.html);
            $('.numer_input').val(result.partner_limit);
            form.render(); //更新全部

            form.on("select(two-sort)", function(data){
                var value = data.value;
                var url = common.url('admin/District/getCityLimit');
                $.get(url , { id : value}, function(result ){
                    // result = eval("("+result+")");

                    $('.numer_input').val(result);
                    form.render(); //更新全部
                });
            });
        });
    });


    //监听提交
    form.on('submit(formEdits)', function(data){

        $.post('doEdit', data.field, function (result) {

        });
        return false;
    });













})