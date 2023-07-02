<?php
/**
 * Plugin Name:       WP Custom Portfolio
 * Plugin URI:        https://github.com/rahuldevphp
 * Description:       The Custom Portfolio Plugin
 * Version:           1.0.0
 * Author:            Rahul Prajapati
 * Author URI:        https://github.com/rahuldevphp
 * Text Domain:       wp-custom-portfolio
 * Domain Path:       /languages
 */
/**
 * user this shortcode [wp_custom_portfolio pagination=true  posts_per_page="6" featured_image=false]
 * */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( ! defined( 'WP_CUSTOM_PORTFOLIO_VERSION' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_VERSION', '1.0.0' ); // Version of plugin
}

if( ! defined( 'WP_CUSTOM_PORTFOLIO_NAME' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_NAME', 'wp_custom_portfolio' ); // Plugin name
}
if( ! defined( 'WP_CUSTOM_PORTFOLIO_DIR' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'WP_CUSTOM_PORTFOLIO_URL' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( ! defined( 'WP_CUSTOM_PORTFOLIO_POST_NAME' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_POST_NAME', 'Portfolio' ); // Plugin post type Name
}
if( ! defined( 'WP_CUSTOM_PORTFOLIO_POST_TYPE' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_POST_TYPE', 'wp_custom_portfolio' ); // Plugin post type
}

if( ! defined( 'WP_CUSTOM_PORTFOLIO_CAT_NAME' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_CAT_NAME', 'Portfolio Type' ); // Plugin cat name
}

if( ! defined( 'WP_CUSTOM_PORTFOLIO_CAT' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_CAT', 'wp_custom_portfolio_cat' ); // Plugin post type cat
}
if( ! defined( 'WP_CUSTOM_PORTFOLIO_META_PREFIX' ) ) {
    define( 'WP_CUSTOM_PORTFOLIO_META_PREFIX', '_wp_custom_portfolio_' ); // Plugin metabox prefix
}

/**
 * Activation Hook
 * Register plugin activation hook.
 */
function activate_wp_custom_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-portfolio-activator.php';
	Wp_Custom_Portfolio_Activator::activate();
}

/**
 * Deactivation Hook
 * Register plugin deactivation hook.
 */
function deactivate_wp_custom_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-portfolio-deactivator.php';
	Wp_Custom_Portfolio_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_custom_portfolio' );
register_deactivation_hook( __FILE__, 'deactivate_wp_custom_portfolio' );

function wp_custom_portfolio_load_textdomain() {
    $plugin_domain = 'wp-custom-portfolio';
    $plugin_dir = plugin_dir_path( __FILE__ );

    // Load the translation files
    load_plugin_textdomain( $plugin_domain, false, $plugin_dir . '/languages/' );
}
add_action( 'plugins_loaded', 'wp_custom_portfolio_load_textdomain' );


/**
 * load main files
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-portfolio-loader.php';