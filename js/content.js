$(function(){
	function stopGalleria(){
		galleria.stop();
	}
	function startGalleria(){
		galleria.start();
	}

	$("html, body").css({
		"overflow" : "hidden"
	});
	$("#post-content .gallery_tip").css({
		"opacity" : 0,
		"margin-top" : -$("#post-content .gallery_tip").outerHeight()/2
	}).animate({
		"left" : 0,
		"opacity" : 1
	});
	$("#post-content .gallery_toolbar").show().animate({
		"right" : 15
	}, function(){
		galleriaPosts = new Gallery("#galleria_posts", {
			autoplay: false,
			delay   : playDelay,
			prevUrl : $("#prevUrl").attr('url'),
			nextUrl : $("#nextUrl").attr('url'),
			autoreplay : false,
			enableClick: true,
			loading : ".ajaxloading, .ajaxloading_back_layer",
			change	: function(desc){
				if(desc){
					$("#desc-inner").html(desc);
					$("#desc-inner").show();
				}else{
					$("#desc-inner").hide();
				}
				$("#post-content .gallery_tip").css({
					"margin-top" : -$("#post-content .gallery_tip").outerHeight()/2
				});
			}
		});
		$("#galleria_posts").show();
		$("#post-content .galleria-image-nav-left").on("click", function(ev){
			galleriaPosts.playPrev();
		});
		$("#post-content .galleria-image-nav-right").on("click", function(ev){
			galleriaPosts.playNext();
		});
	});
	$("#post-content .tip").on("click", function(ev){
		var target = $("#post-content .gallery_tip"),
			to, toStatus;
		if(target.attr("hided") == 1){
			to = 0;
			toStatus = 0;
		}else{
			to = -460;
			toStatus = 1;
		}
		target.animate({
			"left" : to
		}, function(){
			target.attr("hided", toStatus);
		});
	});
	$("#post-content .gallery_back").on("click", function(ev){
		window.location.href = 'http://gallery.coderaladdin.com';
		ev.preventDefault();
	});
	$("#post-content .gallery_play").on("click", function(ev){
		if ( $(this).hasClass("gallery_pause") ){
			 $(this).removeClass('gallery_pause');
			 galleriaPosts.updateConfig({
				"autoplay" : true
			 });
			 galleriaPosts.start();
		}else{
			 $(this).addClass('gallery_pause');
			 galleriaPosts.updateConfig({
				"autoplay" : false
			 });
			 galleriaPosts.stop();
		}
	});
});