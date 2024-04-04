<?php
if (!defined('VIBE_URL'))
    define('VIBE_URL', get_template_directory_uri());


function current_month_year_shortcode()
{
    date_default_timezone_set('Your/Timezone');
    // $currentMonthYear = date('F Y');
    $currentMonthYear = date('M Y');

    return $currentMonthYear;
}
add_shortcode('current_month_year', 'current_month_year_shortcode');




/* by Shoive start */
include_once 'includes/courseCards.php';
// include all functions 
include_once get_stylesheet_directory() . '/inc/top-course_function.php';
include_once get_stylesheet_directory() . '/inc/postViews.php';

// count post views
include_once get_stylesheet_directory() . '/inc/bundle-course_function.php';


/* by Shoive end */

require_once get_stylesheet_directory() . '/mha-resources/functions-dashboard.php';
require_once get_stylesheet_directory() . '/mha-resources/ajax-handler.php';



add_action('wp_enqueue_scripts', 'wplms_child_theme_enqueue_style');
function wplms_child_theme_enqueue_style()
{

    // by Shoive
    wp_enqueue_script('commonJS', get_stylesheet_directory_uri() . '/assets/js/common.js', array('jquery'), time(), true);



    //by Shoive
    wp_enqueue_style('singleCourse24', get_stylesheet_directory_uri() . '/assets/css/singleCourse24.css', true, time());
    wp_enqueue_style('commomCss', get_stylesheet_directory_uri() . '/assets/css/common.css', true, time());
    wp_enqueue_style('blogCss', get_stylesheet_directory_uri() . '/assets/css/blogs.css', true, time());

    // Enqueue top-course stylesheet
    wp_enqueue_style("top-course", get_stylesheet_directory_uri() . "/assets/css/top_course.css", null, time());

    // Enqueue career-bundle stylesheet
    wp_enqueue_style("career-bundle", get_stylesheet_directory_uri() . "/assets/css/career_bundle.css", null, time());
    wp_enqueue_style("custom-header", get_stylesheet_directory_uri() . "/assets/css/header.css", null, time());
}
