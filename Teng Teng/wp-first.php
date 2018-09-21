<?php

define('SIMPLE_ANNOUNCEMENTS_PATH', plugin_dir_url( __FILE__ ));
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.tttay.com
 * @since             1.0.0
 * @package           Wp_First
 *
 * @wordpress-plugin
 * Plugin Name:       First
 * Plugin URI:        https://github.com/ttay/wp-create-and-display-announcements
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Tay Teng Teng
 * Author URI:        www.tttay.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-first
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-first-activator.php
 */
function activate_wp_first() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-first-activator.php';
	Wp_First_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-first-deactivator.php
 */
function deactivate_wp_first() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-first-deactivator.php';
	Wp_First_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_first' );
register_deactivation_hook( __FILE__, 'deactivate_wp_first' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-first.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
	
function run_wp_first() {
	$plugin = new Wp_First();
	$plugin->run();
						}
	function sap_register_announcements() {
 
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
run_wp_first();

function sap_add_metabox() {
    add_meta_box( 'sap_metabox_id', 'Scheduling', 'sap_metabox', 'announcements', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'sap_add_metabox' );
?>
function sap_metabox( $post ) {
    $values = get_post_custom( $post->ID );
    $start_date = isset( $values['sap_start_date'] ) ? esc_attr( $values['sap_start_date'][0] ) : '';
    $end_date = isset( $values['sap_end_date'] ) ? esc_attr( $values['sap_end_date'][0] ) : '';
    wp_nonce_field( 'sap_metabox_nonce', 'metabox_nonce' );
    ?>
    <p>
        <label for="start_date">Start date</label>
        <input type="text" name="sap_start_date" id="sap_start_date" value="<?php echo $start_date; ?>" />
    </p>
    <p>
        <label for="end_date">End date</label>
        <input type="text" name="sap_end_date" id="sap_end_date" value="<?php echo $end_date; ?>" />
    </p>
    <?php
function sap_metabox_save( $post_id ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;
 
    if( !isset( $_POST['metabox_nonce'] ) || !wp_verify_nonce( $_POST['metabox_nonce'], 'sap_metabox_nonce' ) )
        return $post_id;
 
    if( !current_user_can( 'edit_post' ) )
        return $post_id;
 
    // Make sure data is set
    if( isset( $_POST['sap_start_date'] ) ) {
 
        $valid = 0;
        $old_value = get_post_meta($post_id, 'sap_start_date', true);
 
        if ( $_POST['sap_start_date'] != '' ) {
 
            $date = $_POST['sap_start_date'];
            $date = explode( '-', (string) $date );
            $valid = checkdate($date[1],$date[2],$date[0]);
        }
 
        if ($valid)
            update_post_meta( $post_id, 'sap_start_date', $_POST['sap_start_date'] );
        elseif (!$valid && $old_value)
            update_post_meta( $post_id, 'sap_start_date', $old_value );
        else
            update_post_meta( $post_id, 'sap_start_date', '');
    }
 
    if ( isset( $_POST['sap_end_date'] ) ) {
 
        if( $_POST['sap_start_date'] != '' ) {
 
            $old_value = get_post_meta($post_id, 'sap_end_date', true);
 
            $date = $_POST['sap_end_date'];
            $date = explode( '-', (string) $date );
            $valid = checkdate($date[1],$date[2],$date[0]);
        }
        if($valid)
            update_post_meta( $post_id, 'sap_end_date', $_POST['sap_end_date'] );
        elseif (!$valid && $old_value)
            update_post_meta( $post_id, 'sap_end_date', $old_value );
        else
            update_post_meta( $post_id, 'sap_end_date', '');
    }
}
add_action( 'save_post', 'sap_metabox_save' );
?>
