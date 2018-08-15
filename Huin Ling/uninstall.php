<?php

/**
*Trigger this file on Plugin uninstall
*
* @package LingerinoPlugin
*/

if(! defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

//Clear Database stored data
$announcements = get_posts(array('post_type' => 'announcement', 'numberposts' => -1));

foreach($anouncements as $announcement) {
	wp_delete_post($announcement->ID, false)
}
?>