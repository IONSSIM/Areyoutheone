<?php
/**
*
* admin/partials/wp-moud-admin-display.php
*
**/

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://lostwebdesigns.com
 * @since      1.0.0
 *
 * @package    Wp_moud
 * @subpackage Wp_moud/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <h2 class="nav-tab-wrapper">Announcement Management</h2>

    <br><br/>
    <form method="post" name="cleanup_options" action="options.php">

        <?php
        //Grab all options      
        $options = get_option($this->plugin_name);

        // Cleanup
        $cleanup = $options['cleanup'];
        $comments_css_cleanup = $options['comments_css_cleanup'];
        $gallery_css_cleanup = $options['gallery_css_cleanup'];
        $body_class_slug = $options['body_class_slug'];
        $jquery_cdn = $options['jquery_cdn'];
        $cdn_provider = $options['cdn_provider'];

        // New Login customization vars
        $login_logo_id = $options['login_logo_id'];
        $login_logo = wp_get_attachment_image_src( $login_logo_id, 'thumbnail' );
        $login_logo_url = $login_logo[0];
        $login_background_color = $options['login_background_color'];
        $login_button_primary_color = $options['login_button_primary_color'];

        ?>

        <?php
        settings_fields( $this->plugin_name );
        do_settings_sections( $this->plugin_name );
        ?>


        <!-- BUTTON REDIRECTS TO NEW ANN -->
        <fieldset>
            <legend class="screen-reader-text"><span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span></legend>
            <label for="<?php echo $this->plugin_name;?>-login_logo">
                <input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name;?>[login_logo_id]" value="<?php echo $login_logo_id; ?>" />
                <input id="" type="button" class="button" value="<?php _e( 'Add New Announcement', $this->plugin_name); ?>" onclick="window.location.href='admin.php?page=wp-moud/admin/partials/wp-moud-admin-display2.php'" />
                <span><?php esc_attr_e('', $this->plugin_name);?></span>
            </label>


        </fieldset>
        <!--        add existing announcements here-->
    </form>

    <br><br/>




</div>