<?php
/*
*	Plugin Name: Andrew's Plugin
*	Description: This is a simple announcement plugin
*	Author: Andrew Ong
*
*/

define('AndrewPlugin', plugin_dir_url( __FILE__ ));
	
// CREATING A CUSTOM POST TYPE 
function create_custom_post_type(){
   
	$labels = array(
		'name' => _x( 'APA', 'post type general name' ),
		'singular_name' => _x( 'Announcement', 'post type singular name' ),
		'add_new' => _x( 'Add New', 'Announcement' ),
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

    register_post_type('annonuncements', $args);
}
add_action('init','create_custom_post_type');

//DISPLAYING ANNOUNCEMENT
function display_announcement(){
	global $wpdb;

	$announcements = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'annonuncements' AND post_status = 'publish'");
	//HTML output
	if($announcements) :
		?>
			<div style="margin: 30px 50px; color:white;" id="announcements" class="hidden"> 
				<div class="wrapper">
					<a class="close" href="#" id="close"><?php _e('Announcements:'); ?></a>                    
					<div class="APAannouncements">
					<?php
					foreach ($announcements as $announcement) {
					?>                        
						<?php echo do_shortcode(wpautop(($announcement->post_content))); ?>
					<?php
					}
					?>
					</div>
				</div>
			</div>
		<?php
	endif;
}
add_action('wp_head', 'display_announcement');

