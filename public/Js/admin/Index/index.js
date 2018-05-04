

//注意：导航 依赖 element 模块，否则无法进行功能性操作
layui.use(['element','layer','util','custom','upload'], function(){
    var $ = layui.jquery;
    var element = layui.element;
    var layer = layui.layer
        ,common = layui.custom
        ;

    element.on('nav(test)',function (elem) {
        var tit = elem.children('a').html();
        window.addTab(elem,tit);
    })


    // 根据导航栏text获取lay-id
    function getTitleId(card, title) {
        var id = -1;
        $(document).find(".layui-tab[lay-filter=" + card + "] ul li").each(function () {
            if (title === $(this).find('span').html()) {
                id = $(this).attr('lay-id');
            }
        });
        return id;
    };
    // 添加TAB选项卡
    window.addTab = function (elem, tit, url) {
        var card = 'card';                                           // 选项卡对象
        var title = tit ? tit : elem.children('a').html();            // 导航栏text
        var src = url ? url : elem.children('a').attr('href-url');  // 导航栏跳转URL
        var id = new Date().getTime();                             // ID
        var flag = getTitleId(card, title);                          // 是否有该选项卡存在
        // 大于0就是有该选项卡了
        if (flag > 0) {
            id = flag;
        } else {
            if (src) {
                //新增
                element.tabAdd(card, {
                    title: '<span>' + title + '</span>'
                    , content: '<iframe src="' + src + '" frameborder="0"></iframe>'
                    , id: id
                });
                // 关闭弹窗
                layer.closeAll();
            }
        }
        // 切换相应的ID tab
        element.tabChange(card, id);
        // 提示信息
        // layer.msg(title);
    };

    $('.edit-info').click(function () {
        common.dialog({url:common.url('admin/Member/editInfo'),title:'基本资料',area:[ '40%','80%' ]});
    });

});
