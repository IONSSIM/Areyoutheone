<?php
/*
Plugin Name: ana-announcements
Plugin URI:  http://wordpress/venti-plugin/announcements
Description: A basic plugin for announcements
Author: Ananya
Author URI: http://www.venti.com
License: GPL2
*/

//Define constant to store plugin path
define('ANA_ANNCMT_PLUGIN', plugin_dir_url( __FILE__ ));

//Custom Post Type
function ana_register_announcements() {
 
    $labels = array(
        'name' => _x( 'Announcements', 'post type general name' ),
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
    register_post_type('announcements', $args);
}
add_action('init', 'ana_register_announcements');

//Meta Box
function ana_add_metabox() {
    add_meta_box( 'ana_metabox_id', 'Scheduling', 'ana_metabox', 'announcements', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'ana_add_metabox' );

//Adding Fields
function ana_metabox( $post ) {
    $values = get_post_custom( $post->ID );
    $start_date = isset( $values['ana_start_date'] ) ? esc_attr( $values['ana_start_date'][0] ) : '';
    $end_date = isset( $values['ana_end_date'] ) ? esc_attr( $values['ana_end_date'][0] ) : '';
    wp_nonce_field( 'ana_metabox_nonce', 'metabox_nonce' );
    ?>
    <p>
        <label for="start_date">Start date</label>
        <input type="text" name="ana_start_date" id="ana_start_date" value="<?php echo $start_date; ?>" />
    </p>
    <p>
        <label for="end_date">End date</label>
        <input type="text" name="ana_end_date" id="ana_end_date" value="<?php echo $end_date; ?>" />
    </p>
    <?php
}

/*
// Attempt to get announcemnts on top ==> unsuccessful ==> remove css & js files from folder before zipping to send

function announcement_show() {
	$logged_in = 'yes';
	wp_enqueue_style( 'announcement', ANA_ANNCMT_PLUGIN . 'css/anouncement.css');
	if(!is_user_logged_in()) {
		wp_enqueue_script( 'jquery-coookies', ANA_ANNCMT_PLUGIN . 'js/jquery.cookie.js', array( 'jquery' ) );
		$logged_in = 'no';
	}
	wp_enqueue_script( 'announcement', ANA_ANNCMT_PLUGIN . 'js/notifications.js', array( 'jquery' ) );
	wp_localize_script( 'announcement', 'notices_ajax_script', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'logged_in' => $logged_in
		)
	);	
}
add_action('wp_enqueue_scripts', 'announcement_show');
    
*/

?>

