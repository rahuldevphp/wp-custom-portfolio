<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/rahuldevphp
 * @since      1.0.0
 *
 * @package    Wp_Custom_Portfolio
 * @subpackage Wp_Custom_Portfolio/public
 */
class Wp_Custom_Portfolio_Public {

	public $plugin_name = WP_CUSTOM_PORTFOLIO_NAME;
	public $version = WP_CUSTOM_PORTFOLIO_VERSION;

	public function __construct() {
		
	}

	/**
	 * Register the style and JavaScript for the public area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles_and_script() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-custom-portfolio-public.css', array(), $this->version, 'all' );
	
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-custom-portfolio-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'wp_custom_portfolio_ajax', array(
                    'ajax_url'      => admin_url('admin-ajax.php')
                ));

	}

	public function add_hooks()
	{			
		add_action('wp_enqueue_scripts', array($this,'enqueue_styles_and_script'));		

	}

}

$public = new Wp_Custom_Portfolio_Public();
$public->add_hooks();