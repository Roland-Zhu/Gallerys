<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $this->config->item('site_title'); ?></title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/0.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/1.css">
  
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/Gallery.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mousewheel.js"></script>
  <script type="text/javascript">
  var viewingPost = false;
  var playDelay = "6000";
  </script>
    <style type="text/css">
      .rich-content{
      font-size: 12px;
      }
    </style>
    <!--[if lt IE 8]> 
    <style type="text/css">
      .unit_excerpt .player{
      float:left;
      padding-left: 0;
      }
    </style>
    <![endif]-->
</head>
