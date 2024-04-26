<?php
if (!defined('VIBE_URL'))
    define('VIBE_URL', get_template_directory_uri());

//by Shoive
include_once 'includes/blcourses/blSingle.php';


function enqueCss()
{
    //by shoive
    wp_enqueue_style('bulkSingle', get_theme_file_uri('/assets/css/blSingle.css'), false, time(), 'all');
}
add_action("wp_enqueue_scripts", "enqueCss");
