<?php

/*
	Plugin Name: Extra Post Types
	Plugin URI: http://standnow.org/code
	Description: Extra Post Types built specifically for We Choose Peace, a project of STAND.
	Version: 0.1
	Author: Matthew Heck
	Original Author: Kelly Mears
	Original Author URI: http://kellymears.me
	License: GPL2
*/

/*	
	Copyright 2012 STAND (email : info@standnow.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("stand_post_types")) {

	class stand_post_types {
		
		function __construct() {						
		
		}
		
		function register_stand_post_types() {

			register_post_type('Peace', array(
				'label' => __('Peace'),
				'singular_label' => __('Peace'),
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'menu_position' => 6,
				'capability_type' => 'post',
				'hierarchical' => true,
				'rewrite' => true,
				'query_var' => false,
				'supports' => array('comments')
			));
			
		}
		
	}
}

// Instantiate
if (class_exists("stand_post_types")) {
	$stand_post_types = new stand_post_types();
}


if(isset($stand_post_types)){
	add_action('init',  array(&$stand_post_types, 'register_stand_post_types'));
}


?>