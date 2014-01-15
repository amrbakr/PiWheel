<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		$config['upload_path'] = getcwd().'/application/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000000000000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
 ?>