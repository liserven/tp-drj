$(function() {
	// body...
	$('.return_back').on('click', function(){
		window.history.go(-1);  
	})

	$('.collect').click(function () {
		if($(this).attr('src') == './src/image/collect_icon.png'){
			$(this).attr('src', './src/image/oncollect_icon.png');
			confirm('已收藏');
		} else {
			$(this).attr('src', './src/image/collect_icon.png');
			confirm('已取消收藏');
		}
	})
	$('.tosign').click(function(){
		$('#fade').show();
		$('body').css({ 
	         "overflow-x":"hidden",
	         "overflow-y":"hidden"       
	     });
	})
	$('.wait').click(function(){
		$('#fade').hide();
		$('body').css({ 
             "overflow-x":"auto",
             "overflow-y":"auto"        
        });
	})
	$('.current_class').removeClass('swiper-pagination-fraction');


    var $width = $('.status_1 button').width();
    $('.status_1 button').height($width);

    $('.graredenvelope').click(function(){
        confirm("我的！都是我的！！");
    })
	
	$('.receive_packet').click(function () {
		var phone = $('.receive_phone').val();
		var packets_id = $(".packets_id").val();
		if( phone.length == 0 )
		{
			alert('手机号不能为空');
		}
		$.post('/api/v1/receive_packet', {phone: phone, packet_id : packets_id}, function (result) {
			if(result.bol)
			{
				alert('领取成功');
			}
			else{
				alert('领取失败');
			}
        })
    });

    var wigth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    console.log(wigth)
    if(wigth>400){
        phoneType = "iphone6 plus";
    }else if(wigth>370){
        phoneType = "iphone6";
    }else if(wigth>315){
        phoneType = "iphone5 or iphone5s";
        $('.redpacketop ul li:first-child p').css({
			'font-size':'1.4rem',
			'padding': '0 1rem'
		})
        $('.redpacketop ul li.status_2 input').css({
			'padding':'0.5rem 0',
			'font-size':'1.4rem'
		})
		$('.redpacketop ul li.status_2 button').css({
			'font-size':'1.5rem',
			'margin':'1rem 0 0 1.5rem'
		})
		$('.redpacketop ul li.status_2').css({
			'padding-top': '3rem'
		})
    }else{
        phoneType = "iphone 4s";
    }
})