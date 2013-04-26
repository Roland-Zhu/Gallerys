(function(){
	var Gallery = function(target, _config){
		arguments.callee.id = arguments.callee.id || 0;
		var uuid = arguments.callee.id++;
		var config = {
			"autoplay" 	: true,
			"delay"	   	: 6000,
			"autoreplay": true,
			"enableClick": false,
			"nextUrl"	: "",
			"prevUrl"	: "",
			"loading"	: "",
			"change"	: function(){}
		};
		$.extend(config, _config);
		var imgs = $('img', target).hide(), desc = $('.desc', target).hide();
		$(target).show();

		var	maxHeight = $(target).height(), maxWidth = $(target).width(),
			$imgFirstId = "IMAGE1_" + uuid, $imgSecondId = "IMAGE2_" + uuid,
			imgFirstId = "#" + $imgFirstId, imgSecondId = "#" + $imgSecondId,
			timer, current = 0;

		if(imgs.length == 0){
			$(target).hide();
		}else{
			$(target).show();
		}

		function updateConfig(_conf){
			$.extend(config, _conf);
		}

		function preload(src, callback, fl){
			callback = callback || function(){};
			var img = new Image();
			img.onload = function(){
				var re = src.match(/(\d+)_(\d+)\..+?$/);
				if(re){
					var w = re[1], h = re[2];
				}else{
					var w = img.width, h = img.height;
				}
				if(!fl){
					alignPhoto(src, w, h, callback);
				}else{
					callback(src, w, h);
				}
			}
			img.src = src;
		}

		function _getPosByWH(w, h){
			var mT, mL;
			if(w >= maxWidth){
				if(h < maxHeight){
					w = maxHeight / h * w;
					h = maxHeight;
				}
			}else{
				h = maxWidth / w * h;
				w = maxWidth;
				_getPosByWH(w, h);
			}
			var mT = (maxHeight - h) / 2,
				mL = (maxWidth - w) / 2;

			return [w, h, mT, mL];
		}
		function alignPhoto(src, w, h, callback){
			var re = _getPosByWH(w, h);
			callback("<img id='"+ $imgFirstId +"' src='"+src+"' style='width:" +re[0]+ 
				   "px;height:" +re[1]+ "px;top:" +re[2]+
				   "px;left:"+ re[3] +"px;z-index:" + 1 + 
				   ";display:none;position:absolute;'/>");
		}

		function update(){
			var img1 = $(imgFirstId), img2 = $(imgSecondId);
			maxHeight = $(target).height(), maxWidth = $(target).width();
			if(img1.length != 0){
				preload(img1[0].src, function(src, w, h){
					var re = _getPosByWH(w, h);
					img1.css({
						"width"		 : re[0],
						"height"	 : re[1],
						"top" 		 : re[2],
						"left"		 : re[3]
					});
				}, true);
			}
			if(img2.length != 0){
				preload(img2[0].src, function(src, w, h){
					var re = _getPosByWH(w, h);
					img2.css({
						"width"		 : re[0],
						"height"	 : re[1],
						"top" 		 : re[2],
						"left"		 : re[3]
					});
				});
			}
		}

		
		function start(){
			if(!config.autoplay) return;
			stop();
			timer = setTimeout(function(){
				current++;
				if(current == imgs.length){
					current = 0;
				}
				play(current);
			}, config.delay);
		}
		function stop(){
			clearTimeout(timer);
		}
		function play(index){
			stop();
			$(imgFirstId).remove();
			if(index == imgs.length){
				if(config.autoreplay){
					index = 0;
				}else{
					redirectNext();
					return;
				}
			}
			if(index == -1){
				if(config.autoreplay){
					index = imgs.length - 1;
				}else{
					redirectPrev();
					return;
				}
			}
			if(!imgs[index]) return;
			var src = $(imgs[index]).attr("tosrc");
            // if(typeof(src) == 'undefined') return;
            // alert(src);
			preload(src, function(data){
				$(data).appendTo(target);
				$(imgSecondId).fadeOut();
				$(imgFirstId).fadeIn();
				start();
				config.change(desc[current].innerHTML);
			});
			current = index++;
			if(index == imgs.length){
				index = 0;
			}
			preload($(imgs[index]).attr("tosrc"));
		}
		$(config.loading).show();
		preload($(imgs[0]).attr("tosrc"), function(data){
			$(config.loading).hide();
			$(data).appendTo(target);
			$(imgFirstId).css({
				"z-index" : 2
			}).attr("id", $imgSecondId).fadeIn();
			start();
			config.change(desc[0].innerHTML);
		});

		if(config.enableClick){
			$(target).on("click", function(){
				play(++current);
			});
		}

		function redirectNext(){
			if(config.nextUrl){
				window.location.href = config.nextUrl;
			}
		}
		function redirectPrev(){
			if(config.prevUrl){
				window.location.href = config.prevUrl;
			}
		}
		this.playNext 	= function(){
			play(++current);
		};
		this.playPrev 	= function(){
			play(--current);
		};
		this.start 	= start;
		this.stop 	= stop;
		this.update = update;
		this.updateConfig = updateConfig;
		$(window).on("resize", update);
	};
	window.Gallery = Gallery;
})();