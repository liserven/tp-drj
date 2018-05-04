/*各种操作js*/

layui.define(['layer', 'laydate', 'form','custom'], function (exports) {
    var $ = layui.jquery
        , form = layui.form
        , common = layui.custom;

    //改变状态
    form.on('switch(eidt_status)', function(data){
        var url = 'editStatus';
        var type = $(this).attr('type-d');
        $(this).attr('type-d',type==1?2:1);
        var vale = {
            id : $(this).parents('.tbody_content').attr('data-id'),
            state : type,
        };
        if( vale.id==undefined || vale.id=='' ){
            layer.msg('参数错误', { icon:2, time:1000 });
            setTimeout(function () {
                window.location.reload();
            },1000);
        }
        var content = vale.state==2 ? '确定要禁用此数据么？' : '确定要启用此数据么？';
        layer.confirm(content, {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post(url,vale,function(dat){
                common.dMsg(dat,1);
            });
        });
        
    });

    form.on('submit(seach_phone)', function(data){
        return false;
        layer.msg('dsadsa');
        console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
        console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
        console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });


    //一条数据删除
    $(".do_del").click(function () {
        var url = 'doDel';
        var id = $(this).parents('.tbody_content').attr('data-id');
        layer.confirm('确定要删除么？', {
            btn: ['立即执行','再想想'] //按钮
        }, function(){
            $.post(url,{id:id},function (result) {
                common.dMsg(result,1);
            });
        });
    });


    //刷新
    $('.refresh').click(function () {
        window.location.reload();
    });

    //添加页面弹出


    function doDels (){
        $(".do_dels").click(function () {
            var url = $(this).attr('data-src');
            var ids = [];
            $('tbody tr').each(function (e) {
                var deleteId =$(this).find('input.delete_id');
                if( deleteId.is(":checked") )
                {
                    ids.push(deleteId.val()) ;
                }
            })
            if( ids.length == 0 )
            {
                layer.msg('无选中数据..');
                return false;
            }
            layer.confirm('确定要删除么？', {
                btn: ['立即执行','再想想'] //按钮
            }, function(){
                $.post(url,{ids:ids},function (result) {
                    if( result.bol ){
                        layer.msg(result.msg,{icon:1,time:2000});
                        window.location.reload();
                    }else{
                        layer.msg(result.msg,{icon:2,time:2000});
                    }
                });
            });

        });
    }
    doDels();


    function edit_order()
    {
        $('.edit_order').blur(function(){
            var order = $(this).val();
            var module = $(this).attr('module');
            var id = $(this).attr('data-id');
            var url = window.url('admin/'+module+'/editOrder');
            $.post(url, { id: id, order: order}, function (result) {
                if( result.bol ){
                    layer.msg(result.msg,{icon:1,time:2000});
                    window.location.reload();
                }else{
                    layer.msg(result.msg,{icon:2,time:2000});
                }
            })
        });
    }
    edit_order();


    //添加
    $('.add').click(function () {
        common.dialog({url:'doAdd', area:[ '80%','750px' ]},true);
    });

    //修改
    $('.edit').click(function () {
        var id = $(this).parents('tr').attr('data-id');
        common.dialog({url:'doEdit/id/'+id, area:[ '70%','80%' ]}, true);
    });

    //修改
    $('.examine').click(function () {
        var id = $(this).parents('tr').attr('data-id');

        layer.confirm('确定要审核么？', {
            btn: ['立即执行','再想想'] //按钮
        }, function(){
            $.post('editExamine',{id:id},function (result) {
                common.dMsg(result,1);
            });
        });
    });

    //监听提交
    form.on('submit(formDemo)', function(data){
        $.post('doAdd', data.field, function (result) {
            common.dMsg(result);
        });
        return false;
    });


    //监听提交
    form.on('submit(formEdit)', function(data){
        $.post('doEdit', data.field, function (result) {
            common.dMsg(result);
        });
        return false;
    });


    $('.edit-order').blur(function(){
        var data ={
            id : $(this).parents('tr.tbody_content').attr('data-id'),
            order:$(this).val(),
        }
        $.post('editOrder', data, function(result){
            common.dMsg(result,1);
        });
    });
});