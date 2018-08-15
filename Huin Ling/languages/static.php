<?php
/**
* @package LingerinoPlugin
*/
/*
Plugin Name: Lingerino Plugin
Plugin URI: http://lingerino.com/plugin
Description: This is my new creation so stay updated!
Version: 1.0.0
Author: Huin Ling "Ling" Siow
Author URI: http://ling.com
License: GPLv2 or later
Text Domain: lingerino-plugin 
Domain Path: /languages/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA.

Copyright 2005-2015 Automattic, Inc.
 */
 
defined('ABSPATH') or die('Hey, what are you doing?');

class LingerinoPlugin
{
public static function register() {
	add_action('admin_enqueue_scripts', array('LingerinoPlugin', 'enqueue'));
}

protected function create_post_type() {
	add_action('init', array($this, 'custom_post_type'));
}

function activate() {
	//generated a CPT
	$this->custom_post_type();
	//flush rewrite rules
	flush_rewrite_rules();
}

function deactivate() {
	//flush rewrite rules
	flush_rewrite_rules();
}

function custom_post_type() {
	register_post_type('announcement', ['public' => true, 'label' => 'Announcements']);
}

static function enqueue() {
	//enqueue all our scripts
	wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
	wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
}
}

if(class_exists('LingerinoPlugin')) {
		//$lingerinoPlugin = new LingerinoPlugin();
		//$lingerinoPlugin->register();
		LingerinoPlugin::register();
}

//activation
//register_activation_hook(__FILE__, array('$lingerinoPlugin', 'activate'));

//deactivation
//register_deactivation_hook(__FILE__, array('$lingerinoPlugin', 'deactivate'));

