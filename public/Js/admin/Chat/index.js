
layui.use(['layer', 'custom'], function () {
    var layer = layui.layer, $ = layui.jquery, common = layui.custom;
    $(window).click(function () {
        layer.msg('dsaads');
        $(this).addClass('hui-back');
        $(this).siblings('li').removeClass('hui-back');
    });

});
