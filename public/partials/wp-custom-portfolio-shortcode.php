<?php

/**
 * Provide a public-facing view for the plugin
 *
 * @link       https://github.com/rahuldevphp
 * @since      1.0.0
 *
 * @package    Wp_Custom_Portfolio
 * @subpackage Wp_Custom_Portfolio/public/partials
 */

// Shortcode Function
function wp_custom_portfolio_post_list_shortcode_callback($atts) {

    $post_type = WP_CUSTOM_PORTFOLIO_POST_TYPE;    
    ob_start();

    $atts = shortcode_atts(array(
        'posts_per_page' => 5,
        'featured_image' => false,
        'pagination' => true,
    ), $atts);

    $query_args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $atts['posts_per_page'],
    );

    $query = new WP_Query($query_args);
    $html ='';
    if ($query->have_posts()) {
        $html .='<div class="wp-custom-portfolio-post-list" id="wp_custom_portfolio_post_list">';

        while ($query->have_posts()) {
            $query->the_post();
            
            global $post;
            $post_id = $post->ID;
            $hide_section ='';
            $text_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'name'; 
            $image_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'image';
            $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
            $post_content = get_the_content($post_id);            
            $text_name_value = get_post_meta($post_id, $text_name, true);
            $image_url = get_post_meta($post_id, $image_name, true);     

            $html .='<div class="portfolio-item" data-image="'.$featured_image_url.'" data-image-logo="'.$image_url.'">';
            $html .='<h3>' . get_the_title() . '</h3>';
            
            if( $atts['featured_image'] == 'false' ){
                $hide_section = 'hide-section';
            }
            $html .='<img src ="'.$featured_image_url.'" alt="" class="'.$hide_section.'">';
            $html .='<img src ="'.$image_url.'" alt="" class="hide-section">';
            $html .='<p class="text-name hide-section">'.$text_name_value.'</p>
                    <p class="description hide-section">'.$post_content.'</p>
                  </div>';
        }

        $html .='</div>';

        // Load More Button
        if ( $query->found_posts > $atts['posts_per_page'] && $atts['pagination'] == 'true' ) {

            $load_more_text = 'Load More';
            $total_pages    = ceil($query->found_posts / $atts['posts_per_page']);
            $current_page   = 1;

            if (isset($_GET['paged'])) {
                $current_page = absint($_GET['paged']);
            }

            $next_page = $current_page + 1;

            if ($next_page <= $total_pages) {
                $html .='<div id="load-more-container">';
                $html .='<button id="load-more-button" data-current-page="' . $current_page . '" data-total-pages="' . $total_pages . '"  data-featured-image="' . $atts['featured_image'] . '" >' . $load_more_text . '</button>';
                $html .='</div>';
            }
        }
        
        $html .='<div class="portfolio-popup-overlay">
                  <div class="portfolio-popup-content">
                        <img src="" alt="Project Image" class="portfolio-popup-image">
                        <h3 class="portfolio-popup-title"></h3>
                        <p class="portfolio-popup-text-name"></p>
                        <p class="portfolio-popup-description"></p>
                        <img src="" alt="image" class="portfolio-popup-image-logo">
                        <button class="close-popup">Close</button>
                      </div>
                </div>';

        echo $html;        
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('wp_custom_portfolio', 'wp_custom_portfolio_post_list_shortcode_callback');

// AJAX Load More Function
function wp_custom_portfolio_load_more() {

    $post_type = WP_CUSTOM_PORTFOLIO_POST_TYPE; 

    $current_page  = isset($_POST['current_page']) ? absint($_POST['current_page']) : 1;
    $total_pages   = isset($_POST['total_pages']) ? absint($_POST['total_pages']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : 5;
    $featured_image = isset($_POST['featured_image']) ? $_POST['featured_image'] : true;

    if ($current_page >= $total_pages) {
        wp_die();
    }

    $query_args = array(
        'post_type'      => $post_type, // Replace with your custom post type
        'posts_per_page' => $posts_per_page,
        'paged'          => $current_page + 1,
    );

    $query = new WP_Query($query_args);
    $html ='';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();            
            
             global $post;
            $post_id = $post->ID;
            $hide_section ='';
            $text_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'name'; 
            $image_name = WP_CUSTOM_PORTFOLIO_META_PREFIX.'image';
            $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
            $post_content = get_the_content($post_id);            
            $text_name_value = get_post_meta($post_id, $text_name, true);
            $image_url = get_post_meta($post_id, $image_name, true);     

            $html .='<div class="portfolio-item" data-image="'.$featured_image_url.'" data-image-logo="'.$image_url.'">';
            $html .='<h3>' . get_the_title() . '</h3>';
            
            if( $featured_image == 'false' ){
                $hide_section = 'hide-section';
            }
            $html .='<img src ="'.$featured_image_url.'" alt="" class="'.$hide_section.'">';
            $html .='<img src ="'.$image_url.'" alt="" class="hide-section">';
            $html .='<p class="text-name hide-section">'.$text_name_value.'</p>
                    <p class="description hide-section">'.$post_content.'</p>
                  </div>';

        }
    }
    echo $html;
    wp_reset_postdata();

    wp_die();
}
add_action('wp_ajax_wp_custom_portfolio_load_more', 'wp_custom_portfolio_load_more');
add_action('wp_ajax_nopriv_wp_custom_portfolio_load_more', 'wp_custom_portfolio_load_more');






