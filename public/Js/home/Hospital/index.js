$(function(){
    $('.city-box a').each(function(e){
        $(this).click(function(){
            var city = $(this).attr('data-id');
            var pro = $('.pro-box a.on').attr('data-id');
            var data = {
                city:city,
                pro:pro
            };
            var url = 'gethospitalbywhere';
            $.get(url, data, function(html){
                $('.hospitallist').html(html);
            });
        });
    });

    $('.pro-box a').each(function(e){
        $(this).click(function(){
            var pro = $(this).attr('data-id');
            var city = $('.city-box a.on').attr('data-id');
            var data = {
                city:city,
                pro:pro
            };
            var url = 'gethospitalbywhere';
            $.get(url, data, function(html){
                $('.hospitallist').html(html);
            });
        });
    });



});