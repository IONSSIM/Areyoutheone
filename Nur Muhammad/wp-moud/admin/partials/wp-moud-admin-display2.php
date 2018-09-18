<?php
/**
*
* admin/partials/wp-cbf-admin-display.php
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
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/admin/partials
 */


?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <!--    <h2 class="nav-tab-wrapper"></h2>-->


    <form method="post" name="cleanup_options" action="options.php">

        <?php
        //Grab all options      
        $options = get_option('wp-moud');

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
        settings_fields( 'wp-moud' );
        do_settings_sections( 'wp-moud' );
        ?>

        <!--    title -->
        <fieldset>
            <legend class="screen-reader-text"><span><?php esc_attr_e('Login Logo', 'wp-moud');?></span></legend>
            <label for="<?php echo 'wp-moud';?>-login_logo">
                <input type="text" name="abc"  size="100" id="term" placeholder="Enter title here">
                <span><?php esc_attr_e('', 'wp-moud');?></span>
            </label>
        </fieldset>

        <br><br/>

        <!--    text box-->
        <fieldset>
            <legend class="screen-reader-text"><span><?php esc_attr_e('Login Logo', 'wp-moud');?></span></legend>
            <label for="<?php echo 'wp-moud';?>-login_logo">
                <input type="hidden" name="" value="<?php echo $login_logo_id; ?>" />
                <textarea class="FormElement" name="term" id="term" cols="100" rows="10"></textarea>
                <span><?php esc_attr_e('', 'wp-moud');?></span>
            </label>
        </fieldset>
        
        <?php submit_button(__('Create', 'wp-moud'), 'primary','submit', TRUE); ?>

    </form>

</div>


