$(function(){
    $('.sort-box a').each(function(){
        $(this).click(function(){
            var sort = $(this).attr('data-id');
            var city = $('.city-box a.on').attr('data-id');
            var data= {
                sort:sort,
                city:city
            }
            // console.log(data);
            var url = 'getmeetingbywhere';
            $.get(url, data, function(html){
                $('.meetinglist').html(html)
            })
        })
    });

    $('.city-box a').each(function(){
        $(this).click(function(){
            var city = $(this).attr('data-id');
            var sort = $('.sort-box a.on').attr('data-id');
            var data= {
                sort:sort,
                city:city
            }
            // console.log(data);
            var url = 'getmeetingbywhere';
            $.get(url, data, function(html){
                $('.meetinglist').html(html)
            })
        })
    });
})