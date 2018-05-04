layui.use(['form'], function () {
    var $ = layui.jquery
        ,form = layui.form
    ;
    form.on('checkbox(check-all)', function (data) {
        var check = data.elem.checked;
        if( check )
        {
            var child = $(data.elem).parents('.layui-elem-field').find('input[type="checkbox"]');
            child.each(function(index, item){
                item.checked = data.elem.checked;
            });
        }
        else{
            var child = $(data.elem).parents('.layui-elem-field').find('input[type="checkbox"]');
            child.each(function(index, item){
                item.checked = data.elem.checked;
            });
        }
        form.render('checkbox');
    })
    form.on('checkbox(check-one)', function (data) {
        var check = data.elem.checked;
        if( check )
        {
            var child = $(data.elem).parents('.layui-elem-field').find('input[type="checkbox"].check-all');
            child.each(function(index, item){
                item.checked = data.elem.checked;
            });
        }
        else{
            var child = $(data.elem).parents('.layui-elem-field').find('input[type="checkbox"].check-one');
            var check = true;
            child.each(function(index, item){
                if(item.checked)
                {
                    check = false;
                }
            });

            if( check )
            {
                var child = $(data.elem).parents('.layui-elem-field').find('input[type="checkbox"].check-all');
                child.each(function(index, item){
                    item.checked = data.elem.checked;
                });
            }

        }
        form.render('checkbox');
    })

});