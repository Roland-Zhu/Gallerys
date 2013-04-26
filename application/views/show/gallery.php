<?php $this->load->view('inc/header_show'); ?>
  <body style="overflow: hidden;">
  <script type="text/javascript" src="<?php echo base_url(); ?>js/content.js"></script>
    <div class="wrapper">
      <div class="post-content" style="" id="post-content-holder">
		<div id="pag-holder" style="display:none">
			<div id="prevUrl" url="<?php echo $prev_url;?>"></div>
			<div id="nextUrl" url="<?php echo $next_url;?>"></div>
		</div>
        <div class="post-content" id="post-content" url="http://zsspanda.diandian.com">
          <div id="galleria_posts" class="galleria_posts">
          <?php foreach($images as $image):?>
            <img tosrc="<?php echo base_url() . 'uploads/' . $image->name;?>" alt="" style="display: none;">
            <div class="desc" style="display: none;"><?php echo $image->caption;?></div>
          <?php endforeach;?>
          </div>
          <div class="gallery_tip display_switch" style="opacity: 1; margin-top: -85px; left: 0px; overflow: hidden;" hided="0">
            <div class="tip-i">
              <div class="gallery_tip_wrap">
                <h1><?php echo $current_album->name?></h1>
                <div class="description rich-content">
                  <div class="desc-i">
                    <div id="desc-inner" style=""><?php echo $image->caption;?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="gallery_toolbar" style="display: block; right: 15px;">    
            <a href="javascript:;" class="gallery_play gallery_pause"></a>
            <a href="javascript:;" class="tip"></a>
            <a href="javascript:;" class="galleria-image-nav-left"></a>
            <a href="javascript:;" class="galleria-image-nav-right"></a>
            <a href="javascript:;" class="gallery_back" title="返回相册"></a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>