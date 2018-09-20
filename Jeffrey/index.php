<?php

/*
Plugin Name: Jeffrey's Announcements
Description: This is a simple announcement plugin i created.
Version: 1.0.0
*/

//Define a constant for file path

define('ANNOUNCEMENT_PATH', plugin_dir_url( __FILE__ ));




//custom posts
function register_announcements(){
    $labels = array(
		'name' => _x( 'Test Announcements', 'post type general name' ),
		'singular_name' => _x( 'Announcement', 'post type singular name' ),
		'add_new' => _x( 'Add New test', 'Announcement' ),
		'add_new_item' => __( 'Add New Announcement' ),
		'edit_item' => __( 'Edit Announcement' ),
		'new_item' => __( 'New Announcement' ),
		'view_item' => __( 'View Announcement' ),
		'search_items' => __( 'Search Announcements' ),
		'not_found' =>  __( 'No Announcements found' ),
		'not_found_in_trash' => __( 'No Announcements found in Trash' ),
		'parent_item_colon' => ''
	);

 	$args = array(
     	'labels' => $labels,
     	'singular_label' => __('Announcement', 'simple-announcements'),
     	'public' => true,
	  	'capability_type' => 'post',
     	'rewrite' => false,
     	'supports' => array('title', 'editor'),
     );
 	register_post_type('announcements', $args);

}


add_action('init', 'register_announcements');


//display announcement
function j_display_announcements(){
    global $wpdb;
    
    $announcements = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_type ='announcements' AND post_status = 'publish'");

    
if($announcements) :
        ?>
            <div id="announcements" style="color:white;margin-left:500px";> 
                    <?php
                    foreach ($announcements as $announcement) {
                                           
                         echo do_shortcode(wpautop(($announcement->post_content))); 
                    
                    }
                    ?>
                    
            </div>
        <?php
	endif;
}
add_action('wp_head', 'j_display_announcements');

    