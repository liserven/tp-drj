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
				layer.msg(result.bol);
			}
			else{
				layer.msg(result.bol);
			}
        })
    });
})