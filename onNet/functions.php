<?php
if (!defined('VIBE_URL'))
    define('VIBE_URL', get_template_directory_uri());

// By Shoive
include_once 'includes/courseCard.php';
include_once 'includes/courseCard2.php';








/*
Under the all PHP code added by Numan
*/
// Added cacche removal 
if (site_url() == "https://hfonline.wpengine.com") {
    define("VERSION", time());
} else {
    define("VERSION", wp_get_theme()->get("VERSION"));
}

function health_custom_js_css()
{

    //by shoive
    wp_enqueue_style('single-23', get_theme_file_uri('/assets/css/single-23.css'), false, time(), 'all');
    wp_enqueue_style('courseCards', get_theme_file_uri('/assets/css/coursecards.css'), false, time(), 'all');
    wp_enqueue_style('commonCss', get_theme_file_uri('/assets/css/common.css'), false, time(), 'all');
    wp_enqueue_style('bundleCourses', get_theme_file_uri('/assets/css/bundleCourses.css'), false, time(), 'all');
    wp_enqueue_style('header-style24', get_stylesheet_directory_uri() . '/assets/css/header.css', array(), time(), 'all');
    wp_enqueue_script('header-script24', get_stylesheet_directory_uri() . '/assets/js/header.js', array('jquery'), time(), true);
}
add_action("wp_enqueue_scripts", "health_custom_js_css");

// Enqueue Owl Carousel CSS
function enqueue_owl_carousel_styles()
{
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_owl_carousel_styles');

// Enqueue Owl Carousel JavaScript
function enqueue_owl_carousel_script()
{
    // Deregister the default jQuery script bundled with WordPress
    wp_deregister_script('jquery');

    // Enqueue the jQuery library from CDN
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true);

    // Enqueue the Owl Carousel JavaScript
    wp_enqueue_script('owl-carousel-script', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '2.3.4', true);
}
add_action('wp_enqueue_scripts', 'enqueue_owl_carousel_script');
