$(function () {

    $('.country-box a').each(function (e) {
        var _this = $(this);
        _this.click(function () {
            var data = {
                country : _this.text(),
                city : $('.city-box a.on').attr('data-city'),
                project :$('.pro-box a.on').attr('data-city'),
                title :$('.title-box a.on').find('span').text(),
            };
        });
    });



    $('.city-box a').each(function (e) {
        var _this = $(this);
        _this.click(function () {
            var where = {
                country : $('.country-box a.on').text(),
                city : $('.city-box a.on').attr('data-city'),
                project :$('.pro-box a.on').attr('data-city'),
                title :$('.title-box a.on').find('span').text(),
            };
            var url = '/getexpert';
            $.get( url, where, function(html){
                $('.recommendationcontent').html(html);
            } )
        });
    });

    $('.pro-box a').each(function (e) {
        var _this = $(this);
        _this.click(function () {
            var where = {
                country : $('.country-box a.on').text(),
                city : $('.city-box a.on').attr('data-city'),
                project :$('.pro-box a.on').attr('data-city'),
                title :$('.title-box a.on').find('span').text(),
            };
            var url = '/getexpert';
            $.get( url, where, function(html){
                $('.recommendationcontent').html(html);
            } )
        });
    });

    $('.title-box a').each(function (e) {
        var _this = $(this);
        _this.click(function () {
            var where = {
                country : $('.country-box a.on').text(),
                city : $('.city-box a.on').attr('data-city'),
                project :$('.pro-box a.on').attr('data-city'),
                title :$('.title-box a.on').find('span').text(),
            };
            var url = '/getexpert';
            $.get( url, where, function(html){
                $('.recommendationcontent').html(html);
            } )
        });
    });

});