<?php
if (!defined('VIBE_URL'))
    define('VIBE_URL', get_template_directory_uri());
//by Shoive
include_once 'includes/setProductLimit.php';







function health_custom_js_css()
{

    if (is_cart()) {

        wp_enqueue_style('cart-cs', get_stylesheet_directory_uri() . '/assets/css/cs-cart.css', true, 4.2);
    }




    wp_enqueue_style('single-course-bundle', get_stylesheet_directory_uri() . '/css/single-bundle-course.css', null, 4.2);

    if (is_singular('course')) {
        wp_enqueue_style('singleCourse24', get_stylesheet_directory_uri() . '/assets/css/singleCourse24.css', null, 4.2);

        wp_enqueue_script('singleCourse', get_stylesheet_directory_uri() . '/assets/js/singleCourse.js', NULL, 4.2, true);
    }
}
add_action("wp_enqueue_scripts", "health_custom_js_css");
