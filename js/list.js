$(function(){
	var galleria = new Gallery("#galleria", {
		"delay" 	: playDelay,
	});
	
	//fix the bug in ie7
	function fixLayout(){
		if($.browser.msie && $.browser.version < 8 ){
			//console.log($(".unit_gallery"));
			$(".unit_gallery").each(function(i, item){
				var len = $("img", item).length;
				if(len >= 4){
					$(item).css({"width" : 360});
				}else{
					$(item).css({"width" : len * 90});
				}
			});
		}
	}
	fixLayout();

	if($("#infscr-loading").length != 0){
		var page = 1, numPer = 10, lock = false;
		function getMoreData(){
			if(lock) return;
			lock = true;
			var currentPostNumber = $(".list_unit").length;
			$("#infscr-loading").show();
			var data = {
				limit 	: numPer,
				offset	: currentPostNumber
			};
			$.get("/index.php/show/ajaxList", {
				"query" : data
			}, function(data){
				$("#infscr-loading").hide();
				$(data).appendTo("#list_wrap");
				fixLayout();
				lock = false;
			});
		}
		$(window).on("scroll", function(){
			if($(window).height() + $(window).scrollTop() + 200 > $(document).height()){
				getMoreData();
			}
		});
	}
	$(".list_unit").each(function(){
		$(this).on('click',function(){
			window.location = $(this).attr('url');
		})
	})
});