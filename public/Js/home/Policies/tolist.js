$(function () {

// 政策法规 翻页效果
    $('.flip').each(function(){
        var _that = $(this);
        _that.find('a').on('click',function(){
            var _this = $(this);
            if( _this.hasClass('pages') )
            {
                _this.addClass('on').siblings().removeClass('on');
            }
            if( _this.hasClass('nextpages') )
            {
                //下一页样式
                if( _that.find('a.on').next().hasClass('pages') )
                {
                    _that.find(' a.on').removeClass('on').next('a.pages').addClass('on');
                    _that.find('.lastpages').show();
                }

            }
            if( _this.hasClass('lastpages') )
            {
                if( _that.find('a.on').prev().hasClass('pages') )
                {
                    _that.find('a.on').removeClass('on').prev('a.pages').addClass('on');
                }
            }
            var url = _this.attr('data-href');
            var sort_id = _that.attr('data-sort');
            $.get(url, {sort:sort_id}, function (html) {
                _that.prev().html(html);
            })
            if( $('.flip a').hasClass('lastpages') && $('.flip a').hasClass('lastpages') && $('.flip a').hasClass('active') ) {
                $('.lastpages, .nextpages, .flip a.active').removeClass('on')
            }
        })
    });

});