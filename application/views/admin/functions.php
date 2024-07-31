<?php

if(!function_exists('get_head')):
	function get_head(){
		ob_start();
		include_once('includes/header/head.php');
		return ob_get_clean();
	}
endif;

if(!function_exists('get_header')):
	function get_header(){
		ob_start();
		include_once('includes/header/header.php');
		return ob_get_clean();
	}
endif;

if(!function_exists('get_register_header')):
	function get_register_header(){
		ob_start();
		include_once('includes/header/register-header.php');
		return ob_get_clean();
	}
endif;

if(!function_exists('get_menu_bar')):
	function get_menu_bar(){
		ob_start();
		include_once('includes/header/menu-bar.php');
		return ob_get_clean();
	}
endif;

if(!function_exists('get_top_bar')):
	function get_top_bar(){
		ob_start();
		include_once('includes/header/top-bar.php');
		return ob_get_clean();
	}
endif;

if(!function_exists('get_scripts')):
	function get_scripts(){
		ob_start();
		include_once('includes/footer/scripts.php');
		return ob_get_clean();
	}
endif;

if(!function_exists('get_footer')):
	function get_footer(){
		ob_start();
		include_once('includes/footer/footer.php');
		return ob_get_clean();
	}
endif;
?>