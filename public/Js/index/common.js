/**
 * Created by lishenyang on 2017/12/1.
 */
layui.use(['laypage','laydate','form'], function() {
    var $ = layui.$;
    var form = layui.form;
    var module = config.cNAme;
    window.url = function (str, bol, opns) {
        var strs = typeof ( opns ) != 'undefined' && opns.length > 0 ? str + "/" + opns : str;
        return bol ? config.gurl + str : config.curl + '/' + str;
    }

    function doDel() {
        $('.doDel').click(function () {
            var id = $(this).attr('data_id');
            var module = config.cNAme;
            var url = window.url('index/'+module+'/doDel');
            layer.confirm('可要想清楚哟,删除无法恢复！！！', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post(url, {id:id}, function (result) {
                    if( result.bol )
                    {
                        layer.msg(result.msg,{time:2000});
                        setTimeout(function () {
                            window.location.reload();
                        },1000)
                    }
                    else{
                        layer.msg(result.msg,{time:2000});
                    }
                });
            });

        });
    }

    doDel();

    form.on('submit(add_vote)', function(data){
        var module = config.cNAme;
        var add_vote = window.url('index/'+module+'/doAdd');
        $.post( add_vote, data.field, function( result ){
            if( result.bol )
            {
                layer.msg(result.msg,{time:2000});
                window.location.href = window.url('index/'+module+'/toList');
            }
            else{
                layer.msg(result.msg,{time:2000});
            }
        });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });

    form.on('submit(edit)', function(data){
        var module = config.cNAme;
        var actionName = module == 'Config' ? 'doEdit' : 'toList';

        var add_vote = window.url('index/'+module+'/doEdit');
        $.post( add_vote, data.field, function( result ){
            if( result.bol )
            {
                layer.msg(result.msg,{time:2000});
                window.location.href = window.url('index/'+module+'/'+actionName);
            }
            else{
                layer.msg(result.msg,{time:2000});
            }
        });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });


    function doEdit()
    {
        $('.do_edit').click(function () {
            var id = $(this).attr('data-id');
            var url = window.url('index/'+module+'/doEdit/id/'+id);
            console.log(url);
            var index = layer.open({
                type: 2,
                title: '编辑',
                content: url,
                area: ['400px', '250px']
            });
        });
    }
    doEdit();
});