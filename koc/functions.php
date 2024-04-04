<?php
if (!defined('VIBE_URL'))
    define('VIBE_URL', get_template_directory_uri());
include_once 'sakib/api/get_course_progress.php';
//by Shoive
include_once 'includes/relatedCourse.php';



if (function_exists('bp_get_signup_allowed')) {
    include_once 'includes/bp-custom.php';
}
// single course css

function kbc_css()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    //by shoive
    wp_enqueue_style('singleCourse24', get_theme_file_uri('/assets/css/singleCourse24.css'), false, time(), 'all');
}
add_action("wp_enqueue_scripts", "kbc_css");
