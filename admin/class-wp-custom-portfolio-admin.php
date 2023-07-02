<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/rahuldevphp
 * @since      1.0.0
 *
 * @package    Wp_Custom_Portfolio
 * @subpackage Wp_Custom_Portfolio/admin
 */

class Wp_Custom_Portfolio_Admin {
	
	public $plugin_name = WP_CUSTOM_PORTFOLIO_NAME;
	public $version = WP_CUSTOM_PORTFOLIO_VERSION;

	public function __construct() {
		
	}

	/**
	 * Register the style and JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles_and_script() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-custom-portfolio-admin.css', array(), $this->version, 'all' );
	
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-custom-portfolio-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_wp_custom_portfolio_callback()
	{
		$post_name = WP_CUSTOM_PORTFOLIO_POST_NAME;
		$post_type_slug = WP_CUSTOM_PORTFOLIO_POST_TYPE;

		$post_cat_name = WP_CUSTOM_PORTFOLIO_CAT_NAME;
		$post_cat_slug = WP_CUSTOM_PORTFOLIO_CAT;
		
		// Register Custom Post Type
	    $post_labels = array(
	        'name'                  => _x( $post_name.'s', 'Post Type General Name', 'wp-custom-portfolio' ),
	        'singular_name'         => _x( $post_name, 'Post Type Singular Name', 'wp-custom-portfolio' ),
	        'menu_name'             => __( $post_name.'s', 'wp-custom-portfolio' ),
	        'name_admin_bar'        => __( $post_name, 'wp-custom-portfolio' ),
	        'archives'              => __( $post_name.' Archives', 'wp-custom-portfolio' ),
	        'attributes'            => __( $post_name.' Attributes', 'wp-custom-portfolio' ),
	        'parent_item_colon'     => __( 'Parent '.$post_name.':', 'wp-custom-portfolio' ),
	        'all_items'             => __( 'All '.$post_name.'s', 'wp-custom-portfolio' ),
	        'add_new_item'          => __( 'Add New '.$post_name.'', 'wp-custom-portfolio' ),
	        'add_new'               => __( 'Add New', 'wp-custom-portfolio' ),
	        'new_item'              => __( 'New '.$post_name.'', 'wp-custom-portfolio' ),
	        'edit_item'             => __( 'Edit '.$post_name.'', 'wp-custom-portfolio' ),
	        'update_item'           => __( 'Update '.$post_name.'', 'wp-custom-portfolio' ),
	        'view_item'             => __( 'View '.$post_name.'', 'wp-custom-portfolio' ),
	        'view_items'            => __( 'View '.$post_name.'s', 'wp-custom-portfolio' ),
	        'search_items'          => __( 'Search '.$post_name.'', 'wp-custom-portfolio' ),
	        'not_found'             => __( 'Not found', 'wp-custom-portfolio' ),
	        'not_found_in_trash'    => __( 'Not found in Trash', 'wp-custom-portfolio' ),
	        'featured_image'        => __( 'Featured Image', 'wp-custom-portfolio' ),
	        'set_featured_image'    => __( 'Set featured image', 'wp-custom-portfolio' ),
	        'remove_featured_image' => __( 'Remove featured image', 'wp-custom-portfolio' ),
	        'use_featured_image'    => __( 'Use as featured image', 'wp-custom-portfolio' ),
	        'insert_into_item'      => __( 'Insert into '.$post_name.'', 'wp-custom-portfolio' ),
	        'uploaded_to_this_item' => __( 'Uploaded to this '.$post_name.'', 'wp-custom-portfolio' ),
	        'items_list'            => __( $post_name.'s list', 'wp-custom-portfolio' ),
	        'items_list_navigation' => __( $post_name.'s list navigation', 'wp-custom-portfolio' ),
	        'filter_items_list'     => __( 'Filter '.$post_name.'s list', 'wp-custom-portfolio' ),
	    );
	    $post_args = array(
	        'label'                 => __( $post_name, 'wp-custom-portfolio' ),
	        'description'           => __( $post_name.'s post type', 'wp-custom-portfolio' ),
	        'labels'                => $post_labels,
	        'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'çustom-fields' ),
	        // 'taxonomies'            => array( $post_cat_slug ),
	        'hierarchical'          => false,
	        'public'                => true,
	        'show_ui'               => true,
	        'show_in_menu'          => true,
	        'menu_position'         => 5,
	        // 'menu_icon'             => 'dashicons',
	        'show_in_admin_bar'     => true,
	        'show_in_nav_menus'     => true,
	        'can_export'            => true,
	        'has_archive'           => true,
	        'exclude_from_search'   => false,
	        'publicly_queryable'    => true,
	        'capability_type'       => 'post',
	    );
	    register_post_type( $post_type_slug, $post_args );


		// Register Custom Taxonomy
	    $cat_labels = array(
	        'name'                       => _x( $post_cat_name.'s', 'Taxonomy General Name', 'wp-custom-portfolio' ),
	        'singular_name'              => _x( $post_cat_name, 'Taxonomy Singular Name', 'wp-custom-portfolio' ),
	        'menu_name'                  => __( $post_cat_name.'s', 'wp-custom-portfolio' ),
	        'all_items'                  => __( 'All '.$post_cat_name.'s', 'wp-custom-portfolio' ),
	        'parent_item'                => __( 'Parent '.$post_cat_name, 'wp-custom-portfolio' ),
	        'parent_item_colon'          => __( 'Parent '.$post_cat_name.':', 'wp-custom-portfolio' ),
	        'new_item_name'              => __( 'New '.$post_cat_name.' Name', 'wp-custom-portfolio' ),
	        'add_new_item'               => __( 'Add New '.$post_cat_name, 'wp-custom-portfolio' ),
	        'edit_item'                  => __( 'Edit'.$post_cat_name, 'wp-custom-portfolio' ),
	        'update_item'                => __( 'Update '.$post_cat_name, 'wp-custom-portfolio' ),
	        'view_item'                  => __( 'View '.$post_cat_name, 'wp-custom-portfolio' ),
	        'separate_items_with_commas' => __( 'Separate '.$post_cat_name.'s with commas', 'wp-custom-portfolio' ),
	        'add_or_remove_items'        => __( 'Add or remove '.$post_cat_name.'s', 'wp-custom-portfolio' ),
	        'choose_from_most_used'      => __( 'Choose from the most used '.$post_cat_name.'s', 'wp-custom-portfolio' ),
	        'popular_items'              => __( 'Popular '.$post_cat_name.'s', 'wp-custom-portfolio' ),
	        'search_items'               => __( 'Search '.$post_cat_name.'s', 'wp-custom-portfolio' ),
	        'not_found'                  => __( 'Not Found', 'wp-custom-portfolio' ),
	        'no_terms'                   => __( 'No'.$post_cat_name.'s', 'wp-custom-portfolio' ),
	        'items_list'                 => __( $post_cat_name.'s list', 'wp-custom-portfolio' ),
	        'items_list_navigation'      => __( $post_cat_name.'s list navigation', 'wp-custom-portfolio' ),
	    );

	    $cat_args = array(
	        'labels'                     => $cat_labels,
	        'hierarchical'               => true,
	        'public'                     => true,
	        'show_ui'                    => true,
	        'show_admin_column'          => true,
	        'show_in_nav_menus'          => true,
	        'show_tagcloud'              => true,
	    );
	    register_taxonomy( $post_cat_slug, array( $post_type_slug ), $cat_args );

	}

	public function add_hooks()
	{			
		add_action('admin_enqueue_scripts', array($this,'enqueue_styles_and_script'));	

		add_action('init', array($this,'register_wp_custom_portfolio_callback'));	

	}

}

$admin = new Wp_Custom_Portfolio_Admin();
$admin->add_hooks();