<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$hook['post_controller'][] = array(
                                'class'    => 'Hooks',
                                'function' => 'session_check',
                                'filename' => 'authentication.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );