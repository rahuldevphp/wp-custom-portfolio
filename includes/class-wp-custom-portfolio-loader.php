<?php

/**
 * Main file loader
 *
 * @link       https://github.com/rahuldevphp
 * @since      1.0.0
 *
 * @package    Wp_Custom_Portfolio
 * @subpackage Wp_Custom_Portfolio/includes
 */

class Wp_Custom_Portfolio_Loader {
	
	public function __construct() {

		$this->includes_files();
	}

	public function includes_files()
	{	
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-custom-portfolio-ajax.php';	

		$this->admin_files_load();
		$this->public_files_load();
	}

	public function admin_files_load()
	{
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-custom-portfolio-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wp-custom-portfolio-meta-box.php';
	}

	public function public_files_load()
	{
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-custom-portfolio-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-custom-portfolio-shortcode.php';
	}	

}

$loader = new Wp_Custom_Portfolio_Loader();