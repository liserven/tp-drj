$(function () {


//链接socket
    var ws = new WebSocket('ws://39.106.45.102:2346');
    ws.onopen = function(){
        ws.send('auth:'+config.uid+':1');
    }

    ws.onmessage = function(e){
        $('.xiaoxi_num').removeClass('display-none');
        var xiaoxi_num = $('.xiaoxi_num').text();
        xiaoxi_num++;
        $('.xiaoxi_num').text(xiaoxi_num);
    }
})