<?php

/**
 * Provide a post meta box for the plugin
 *
 *
 * @link       https://github.com/rahuldevphp
 * @since      1.0.0
 *
 * @package    Wp_Custom_Portfolio
 * @subpackage Wp_Custom_Portfolio/admin/partials
 */


// Add Meta Box for Custom Text
function register_portfolio_custom_meta_box_callback() {

    add_meta_box(
        WP_CUSTOM_PORTFOLIO_META_PREFIX.'custom_meta_box', // Unique ID
        'Portfolio Custom Meta', // Box title
        'render_portfolio_custom_text_box', // Callback function
        WP_CUSTOM_PORTFOLIO_POST_TYPE, // Post type
        'normal', // Context
        'default' // Priority
    );

}
add_action( 'add_meta_boxes', 'register_portfolio_custom_meta_box_callback' );

// Render Meta Box content
function render_portfolio_custom_text_box( $post ) {

    $text_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'name';    
    $image_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'image';    
    // Retrieve current text value from post meta
    $text_value = get_post_meta( $post->ID, $text_name, true );
    $image_url = get_post_meta($post->ID, $image_name, true);
    
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for=<?php echo $text_name; ?>><?php _e('Name','wp-custom-portfolio'); ?></label>
            </th>
            <td>
                <input type="text" name="<?php echo $text_name; ?>" id="<?php echo $text_name; ?>" value="<?php echo esc_attr( $text_value ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for=<?php echo $image_name; ?>><?php _e('Upload Image','wp-custom-portfolio'); ?></label>
            </th>
            <td>                
                <input type="text" id="custom_image_upload" name=<?php echo $image_name; ?> value="<?php echo esc_attr($image_url); ?>" readonly>
                <input type="button" id="custom_image_button" class="button" value="Upload Image">
                <div id="custom_image_preview"> 
                    <?php if (!empty($image_url)) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="Custom Image">
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    </table>

    <?php
}

// Save Meta Box value
function portfolio_save_custom_meta_callback( $post_id ) {

    $text_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'name'; 
    $image_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'image'; 
    if ( isset( $_POST[$text_name] ) ) {
        $name = sanitize_text_field( $_POST[$text_name] );
        update_post_meta( $post_id, $text_name, $name );
    }

    if (isset($_POST[$image_name])) {
        $image_url = sanitize_text_field($_POST[$image_name]);
        update_post_meta($post_id, $image_name, $image_url);
    }

}
add_action( 'save_post_'.WP_CUSTOM_PORTFOLIO_POST_TYPE, 'portfolio_save_custom_meta_callback' );



function add_menu_section() {

     add_submenu_page(
        'edit.php?post_type='.WP_CUSTOM_PORTFOLIO_POST_TYPE, // Parent menu slug (edit.php?post_type=custom_post_type)
        'Settings', // Submenu page title
        'Settings', // Submenu label
        'manage_options', // Required capability to access the submenu
        'edit.php?post_type='.WP_CUSTOM_PORTFOLIO_POST_TYPE, // Submenu slug
        'custom_post_type_settings' // Callback function to display the submenu content
    );
    
    add_options_page(
        'Custom Menu Section',
        'Custom Menu',
        'edit.php?post_type=wp_custom_portfolio',
        'wp_custom_portfolio', // Use the same slug as your custom post type
        'custom_post_type_settings' // Callback function to display the settings page
    );
}
add_action( 'admin_menu', 'add_menu_section' );

function custom_post_type_settings() {
    ?>
    <div class="wrap">
        <h1><?php _e(WP_CUSTOM_PORTFOLIO_POST_NAME. ' Settings Details','wp-custom-portfolio'); ?></h1>
        <p>This is the settings page for the custom post type.</p>
        <p>Short Details : </p>
        <p>[wp_custom_portfolio pagination=true  posts_per_page="6" featured_image=false]</p>
    </div>
    <?php
}

?>