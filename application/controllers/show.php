<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Copyright (c) 2012, Aaron Benson - GalleryCMS - http://www.gallerycms.com
 * 
 * GalleryCMS is a free software application built on the CodeIgniter framework. 
 * The GalleryCMS application is licensed under the MIT License.
 * The CodeIgniter framework is licensed separately.
 * The CodeIgniter framework license is packaged in this application (license.txt) 
 * or read http://codeigniter.com/user_guide/license.html
 * 
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 * 
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 * 
 */
class Show extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('album_model');
    $this->load->model('image_model');
  }
  
  /**
   * Displays list of albums for regular users. Admins can see all albums.
   */
  public function index()
  {
  	$album_data = $this->album_model->paginate(10,0);

  	$this->load->model('user_model');
    for ($i = 0; $i < count($album_data); $i++)
    {
      $album_data[$i]['user'] = $this->user_model->find_by_id($album_data[$i]['user_id'])->email_address;
      $album_data[$i]['images'] = $this->image_model->get_last_ten_by_album_id($album_data[$i]['id']);
    }
    $data = array();
    $data['albums'] = $album_data;
    
    $this->load->view('show/index', $data);
  }
  
  /**
   * ajax get list data
   */
  public function ajaxList()
  {
  	$query = $_GET['query'];
  	$limit = $query['limit'];
  	$offset = $query['offset'];
  	$data = $this->album_model->paginate($limit,$offset);
  	$this->load->model('user_model');
  	for ($i = 0; $i < count($data); $i++)
  	{
  		$data[$i]['user'] = $this->user_model->find_by_id($data[$i]['user_id'])->email_address;
  		$data[$i]['images'] = $this->image_model->get_last_ten_by_album_id($data[$i]['id']);
  	}
  	
  	$string = '';
  	foreach ($data as $album)
  	{
  		$string .= '<li id="'.$album['id'].'" url="'.base_url().'/show/album/'.$album['id'].'" class="list_unit clearfix photo"><h2 class="unit_title clearfix"><a class="photo" title="'.$album['name'].'" href="'.base_url().'/show/album/'.$album['id'].'">'.$album['name'].'<span class="unit_subtitle"><span class="date">'.date('M m Y', strtotime($album['created_at'])).'</span></span></a></h2><div class="arrow_unit_gallery"><s></s></div><div class="round_unit_gallery"></div><div class="unit_gallery_wrap"><ul class="unit_gallery clearfix">';
  				foreach ($album['images'] as $image)
  	          		{
  	                $string .= '<li class="gallery_unit"><a href="'.base_url().'/show/album/'.$album['id'].'"><img src="' . base_url() . 'uploads/' . $image->raw_name . '_thumb' . $image->file_ext . '" alt="'.$album['name'].'"></a></li>';
  	          		}
  	               $string .= '</ul></div></li>';
  	}
  	
  	print_r($string);
  }
  
  
  /**
   * Displays images for selected album. 
   *
   * @param type $album_id 
   */
  public function album($album_id)
  {
    $data = array();
    $current_album = $this->album_model->find_by_id($album_id);
    $prev_album = $this->album_model->find_prev_album($current_album->created_at);
    $next_album = $this->album_model->find_next_album($current_album->created_at);
    $data['current_album'] = $current_album;
    $data['prev_url'] = empty($prev_album) ? base_url() : base_url() . 'show/album/' . $prev_album->id;
    $data['next_url'] = empty($next_album) ? base_url() : base_url() . 'show/album/' . $next_album->id;;
    $data['images']    = $this->image_model->get_images_by_album_id($album_id);
    $this->load->view('show/gallery', $data);
  }
}
