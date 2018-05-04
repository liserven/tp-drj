
layui.use(['layer', 'custom','layedit'], function () {
    var layer = layui.layer, $ = layui.jquery, common = layui.custom
        ,layedit = layui.layedit;
    var index = layedit.build('content',{height:60,tool: ['face']}); //建立编辑器

    $('#chat-default').click(function () {
            $.get(common.url('admin/Chat/index'),{},function (html) {
                $('#chat-dialog').html(html);
                $('#chat-dialog').toggle(800);

                $('.f-list').click(function () {
                    $(this).addClass('hui-back');
                    $(this).siblings('li').removeClass('hui-back');
                });
                $('.go-out-chat').click(function () {
                    $('#chat-dialog').hide(800);
                });

                $('.group-list').click(function () {
                    if( $(this).next('div.friend-list').is(":hidden") )
                    {
                        $(this).find('i.group-conf-r').html('&#xe625;');
                        $(this).siblings('li').find('i.group-conf-r').html('&#xe623;');
                    }
                    else{

                        $(this).find('i.group-conf-r').html('&#xe623;');
                        $(this).siblings('li').find('i.group-conf-r').html('&#xe623;');
                    }
                    $(this).next('div.friend-list').toggle();
                    $(this).siblings('li').next('div.friend-list').hide();
                });


            });
    });
    
    /*发送信息内容*/
    $('.submit-btn-b').click(function(){
        //监听端口 发送内容
    });

});
