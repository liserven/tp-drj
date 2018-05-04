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

	let x = 1;

	function f(y = x) {
	  let x = 2;
	  console.log(y);
	}

	f() // 1
})