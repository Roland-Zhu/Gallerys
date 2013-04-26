<?php $this->load->view('inc/header_show'); ?>
  <body>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/list.js"></script>
    <div class="wrapper">
      <div id="galleria" class="bgimg_list">
      <?php foreach($albums[0]['images'] as $img):?>
        <img tosrc="<?php echo base_url() . 'uploads/' . $img->name;?>" />
        <div class="desc"></div>
      <?php endforeach;?>
    </div>
      <div class="back-mask" id="back-mask"></div>
      <div class="post-content" style="display:none" id="post-content-holder"></div>
      <div class="log-h" id="logo">
        <a href="" class="logo">
        <img src="<?php echo base_url() . 'images/'?>potrait.jpg" alt="aladdin" width="90" style="width: 84px; height: 84px;">
        </a>
      </div>
      <div id="line_type_wrap">
        <ul id="list_wrap">
          <?php foreach ($albums as $album):?>
          <li id="<?php echo $album['id']?>" url="<?php echo base_url() . 'show/album/' . $album['id'];?>" class="list_unit clearfix photo">
            <h2 class="unit_title clearfix">
              <a class="photo" title="<?php echo $album['name']?>" href="<?php echo base_url() . 'show/album/' . $album['id'];?>">
              <?php echo $album['name']?>
              <span class="unit_subtitle">
              <span class="date"><?php echo date('M m Y', strtotime($album['created_at']))?></span>
              </span>
              </a>
            </h2>
            <div class="arrow_unit_gallery"><s></s></div>
            <div class="round_unit_gallery"></div>
            <div class="unit_gallery_wrap">
              <ul class="unit_gallery clearfix">
                <?php foreach ($album['images'] as $image):?>
                <li class="gallery_unit">
                  <a href="<?php echo base_url() . 'show/album/' . $album['id'];?>">
                  <img src="<?php echo base_url() . 'uploads/' . $image->raw_name . '_thumb' . $image->file_ext; ?>" alt="<?php echo $album['name']?>">
                  </a>
                </li>
                <?php endforeach;?>
              </ul>
            </div>
          </li>
          <?php endforeach;?>
        </ul>
        <div id="infscr-loading" style="display: none;">
          <div class="infi-dot"></div>
          <div class="infi-dot"></div>
          <div class="infi-dot"></div>
        </div>
      </div>
      <div class="line_type_mask" id="line_type_mask"></div>
      <div class="ajaxloading" style="display: none;"></div>
      <div class="ajaxloading_back_layer" style="display: none;"></div>
      <!-- <div id="footer">
        <div class="share" id="search-foot">
          <a id="search" class="searchcss social_active">
            <form id="search_form" name="" method="get" class="search-form_header" action="./aladdin_files/aladdin.htm">   
              <input type="text" onblur="if (this.value == &#39;&#39;) {this.value = &#39;&#39;;}" onfocus="if (this.value == &#39;&#39;) {this.value = &#39;&#39;;}" id="s" name="q" value="" class="textboxsearch"> 
              <input type="submit" value="" class="submitsearch" name="">
            </form>
          </a>
        </div>
        <div id="navi" class="menu-a-container">
          <ul>
            <li><a href="./aladdin_files/aladdin.htm" target="_blank">首页</a></li>
            <li><a href="http://zsspanda.diandian.com/archive" target="_blank">存档</a></li>
            <li><a target="_blank" href="http://zsspanda.diandian.com/inbox">私信</a></li>
            <li>
              <a href="http://zsspanda.diandian.com/submit" target="_blank">投稿</a>
            </li>
            <li>
              <a id="foot_rss" target="_blank" href="http://zsspanda.diandian.com/rss">订阅</a>
            </li>
            <li id="tags">
              <a href="http://zsspanda.diandian.com/#" onclick="return false;">标签</a>
              <div class="menu-list" style="display: none; top: -10px;">
              </div>
            </li>
          </ul>
        </div>
        <div id="copyright">©<a href="./aladdin_files/aladdin.htm">aladdin</a></div>
      </div> -->
    </div>
  </body>
</html>