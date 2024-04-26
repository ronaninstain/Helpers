<?php
//Header File
if (!defined('ABSPATH')) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php
    wp_head();
    ?>
</head>
<style>
    header.sleek.transparent.fix {
        background: #39a1b8;
    }
</style>

<body <?php body_class(); ?>>

    <style>
        .r-koc-4-spiner-h {
            z-index: 111;
            position: absolute;
            background: white;
            height: 100%;
            left: 0;
            top: 0;
            width: 100%;
            background: linear-gradient(270deg, #ffffff, #acd3f9);
            background-size: 400% 400%;

            -webkit-animation: AnimationName 2s ease infinite;
            -moz-animation: AnimationName 2s ease infinite;
            animation: AnimationName 2s ease infinite;
        }


        @-webkit-keyframes AnimationName {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        @-moz-keyframes AnimationName {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        @keyframes AnimationName {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .r-koc-4-spiner-h .loader-text {
            background-image: linear-gradient(to right,
                    #141e45 10%,
                    #1e2128 50%,
                    #141e45 60%);

            display: inline-block;
            font-size: 10px;
            font-weight: bold !important;
            letter-spacing: 1px;
            line-height: normal;
            text-transform: uppercase;
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-fill-color: transparent;
            -webkit-animation: textclip 1.5s linear infinite;
            animation: textclip 1.5s linear infinite;
        }

        .r-koc-4-spiner-h .loader-text:before,
        .r-koc-4-spiner-h .loader-text:after {
            box-sizing: border-box;
            content: "";
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 10em;
            height: 10em;
            transform-style: preserve-3d;
            transform-origin: 50%;
            transform: rotateY(50%);
            perspective-origin: 50% 50%;
            perspective: 340px;
            -webkit-mask-image: url(https://www.kingstonopencollege.co.uk/wp-content/uploads/2024/04/download-1.svg);
            mask-image: url(https://www.kingstonopencollege.co.uk/wp-content/uploads/2024/04/download-1.svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 10em 10em;
            mask-size: 10em 10em;
            background-color: #141e45;
            margin: auto;
        }

        @keyframes rotateBefore {
            from {
                transform: rotateX(60deg) rotateY(45deg) rotateZ(0deg);
            }

            to {
                transform: rotateX(60deg) rotateY(45deg) rotateZ(-360deg);
            }
        }

        @keyframes rotateAfter {
            from {
                transform: rotateX(240deg) rotateY(45deg) rotateZ(0deg);
            }

            to {
                transform: rotateX(240deg) rotateY(45deg) rotateZ(360deg);
            }
        }

        .r-koc-4-spiner-h .loader-text:before {
            transform: rotateX(60deg) rotateY(45deg) rotateZ(45deg);
            animation: 750ms rotateBefore infinite linear reverse;
            box-sizing: border-box !important;
        }

        .r-koc-4-spiner-h .loader-text:after {
            transform: rotateX(240deg) rotateY(45deg) rotateZ(45deg);
            animation: 750ms rotateAfter infinite linear;
            box-sizing: border-box !important;
        }


        body.loaded .r-koc-4-spiner-h {
            display: none;
        }



        /* Header Css Starts */


        
    </style>
    <div class="r-koc-4-spiner-h">
        <span class="loader-text"></span>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hide loader when page content is fully loaded
            document.body.classList.add("loaded");
        });
    </script>
    <div id="global" class="global">
        <?php
        get_template_part('mobile', 'sidebar');
        ?>
        <div class="pusher">
            <?php
            $fix = vibe_get_option('header_fix');
            ?>
                <header class="srs_pr_element">
                    <div class="srs_navbar_up_part">
                        <div class="srs_icon_sec">
                            <a href="https://www.facebook.com/kingstonopencollege">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/facebook.svg'; ?>" alt="icon" />
                            </a>
                            <a href="https://www.linkedin.com/company/kingston-open-college">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/linkedin.svg'; ?>" alt="icon" />
                            </a>
                            <a href="https://www.pinterest.co.uk/KingstonOpenCollege/">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/pinterest.svg'; ?>" alt="icon" />
                            </a>
                            <a href="https://www.instagram.com/kingstonopencollege/">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/instagram.svg'; ?>" alt="icon" />
                            </a>
                        </div>
                        <h5 class="srs_quote">
                        Want to learn something new –
                            <a href="/all-courses/"> We’ll Show You. </a>
                        </h5>
                        <div class="srs_name_sec">
                            <?php
                            if (function_exists('bp_loggedin_user_link') && is_user_logged_in()) :
                            ?>
                                <h5 class="srs_userName">Welcome, <a href="<?php bp_loggedin_user_link(); ?>" class="vbplogin"><span><?php bp_loggedin_user_fullname(); ?></span></a></h5>
                            <?php else : ?>
                                <h5 class="srs_userNameLogin">Welcome, Please<a href="#login" rel="nofollow" class=" vbplogin"><span><?php _e(' Log in', 'vibe'); ?></span></a></h5>
                            <?php
                            endif;
                            ?>
                            <?php
                            $style = vibe_get_login_style();
                            if (empty($style)) {
                                $style = 'default_login';
                            }
                            ?>
                            <div id="vibe_bp_login" class="<?php echo vibe_sanitizer($style, 'text'); ?>">
                                <?php
                                vibe_include_template("login/$style.php");
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="srs_navbar_btm_part">
                        <nav class="srs_navbar_pr">
                            <div class="srs_logo">
                                <?php

                                if (is_home()) {
                                    echo '<h1 id="logo">';
                                } else {
                                    echo '<h2 id="logo">';
                                }

                                $url = apply_filters('wplms_logo_url', VIBE_URL . '/assets/images/logo.png', 'header');
                                if (!empty($url)) {
                                ?>

                                    <a href="<?php echo vibe_site_url('', 'logo'); ?>"><img src="<?php echo vibe_sanitizer($url, 'url'); ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
                                <?php

                                }
                                if (is_home()) {
                                    echo '</h1>';
                                } else {
                                    echo '</h2>';
                                } ?>
                            </div>
                            <ul class="srs_nav_items">
                                <li class="srs_close_nav">

                                </li>
                                <li class="srs_nav_item">
                                    <a class="srs_nav_link" href="/">
                                        <span>Home </span>
                                    </a>
                                </li>
                                <li class="srs_nav_item">
                                    <a class="srs_nav_link" href="/course-cat/regulated-courses/">
                                        <span>Regulated Courses </span>
                                    </a>
                                </li>
                                <li class="srs_nav_item">
                                    <a class="srs_nav_link" href="/course-cat/personal-development/">
                                        <span>Endorsed Courses </span>
                                    </a>
                                </li>
                                <li class="srs_nav_item">
                                    <a class="srs_nav_link srs_courses_btn" href="#">
                                        <span>All Courses
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/down.png'; ?>" alt="icon" />
                                        </span>
                                    </a>
                                    <div class="srs_mega_menu">
                                        <div class="srs_inner_items_all srs_all_courses_child">

                                            <ul class="srs_inner_item_sec">
                                                <ul class="srs_close_nav_2">
                                                    <li class="srs_cross_menu_close"></li>
                                                    <li class="srs_sub_menu_close"></li>
                                                </ul>
                                                <?php
                                                $taxonomy = 'course-cat';
                                                $terms = get_terms(array(
                                                    'taxonomy'   => $taxonomy,
                                                    'hide_empty' => false,
                                                    'orderby'    => 'count',
                                                    'order'      => 'DESC',
                                                    'number'     => 5,
                                                ));
                                                $categories = get_categories(array(
                                                    'taxonomy' => $taxonomy,
                                                    'hide_empty' => false,
                                                ));
                                                ?>
                                                <h4 class="srs_course_title">Popular Categories</h4>
                                                <?php
                                                foreach ($terms as $term) {
                                                ?>
                                                    <li class="srs_inner_item">
                                                        <a href="<?php echo get_term_link($term); ?>">
                                                            <span><?php echo $term->name; ?></span>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>

                                            </ul>
                                            <ul class="srs_inner_item_sec">
                                                <h4 class="srs_course_title">Featured Courses</h4>
                                                <?php
                                                foreach ($categories as $category) {
                                                    $category_id = $category->term_id;
                                                    if (($category_id == 2504 || $category_id == 3583 || $category_id == 3584 || $category_id == 201 || $category_id == 1191) && $category->count > 0) {
                                                ?>
                                                        <li class="srs_inner_item">
                                                            <a href="<?php echo get_category_link($category_id); ?>">
                                                                <span> <?php echo $category->name; ?> </span>
                                                            </a>
                                                        </li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <li class="srs_inner_item">
                                                    <a class="srs_all_courses_btn" href="/all-courses/">
                                                        <span> All Courses</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="srs_inner_item_sec">

                                                <a href="/course/criminal-law-police-2/">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/Criminal Law.webp'; ?>" alt="course Image" />
                                                </a>
                                            </ul>
                                            <ul class="srs_inner_item_sec">
                                                <a href="/course/focus-awards-level-5-diploma-in-education-and-training-det/">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/Level 5 DET.webp'; ?>" alt="course Image" />
                                                </a>
                                            </ul>
                                            <ul class="srs_inner_item_sec">
                                                <a href="/course/focus-awards-level-4-certificate-for-higher-level-teaching-assistants-rqf/">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/HLTA.webp'; ?>" alt="course Image" />
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="srs_nav_item">
                                    <a class="srs_nav_link srs_explore_btn" href="#">
                                        <span>Explore More
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/down.png'; ?>" alt="icon" />
                                        </span>
                                    </a>
                                    <div class="srs_mega_menu">
                                        <ul class="srs_inner_items srs_explore_sec">
                                            <ul class="srs_close_nav_2">
                                                <li class="srs_cross_menu_close2"></li>
                                                <li class="srs_sub_menu_close2"></li>
                                            </ul>

                                            <li class="srs_inner_item">
                                                <a href="/career-advice/">
                                                    <span> Career Advice </span>
                                                </a>
                                            </li>
                                            <li class="srs_inner_item">
                                                <a href="/taster/">
                                                    <span> Tester Module </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                            <div class="srs_cart_sec">
                                <a class="srs_search" id="new_searchicon" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                                    
                                <circle class="si0" cx="43.4" cy="42.4" r="35.4"></circle><line class="si0" x1="68.7" y1="67.7" x2="94" y2="93"></line></svg>
                                </a>
                                <?php

                                if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))  || (function_exists('vibe_check_plugin_installed') && vibe_check_plugin_installed('woocommerce/woocommerce.php')) && $show_cart) {
                                    global $woocommerce;
                                ?>
                                    <div class="srs_cart_sec_child">
                                        <a class="srs_cart smallimg vbpcart" href="#">
                                        <span >
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path class="ci0" d="M74.1,93.7H25.9c-5.8,0-10.3-4.8-9.9-10.4l4.5-53.1c0.2-2.5,2.3-4.5,4.8-4.5h49.4c2.5,0,4.6,1.9,4.8,4.5 L84,83.3C84.4,88.9,79.8,93.7,74.1,93.7z"></path><path class="ci0" d="M35.4,40.3V16c0-5.4,4.3-9.7,9.7-9.7h9.7c5.4,0,9.7,4.3,9.7,9.7v24.3"></path></svg>
                                            
                                                <?php echo (($woocommerce->cart->cart_contents_count) ? '<em>' . $woocommerce->cart->cart_contents_count . '</em>' : ''); ?>
                                            </span>

                                        </a>
                                        <div class="woocart">
                                            <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <a href="/all-courses/" class="r-custom-4-button-h">
                                    <div class="koc-buttn">
                                        <span class="label-up">Get Started</span>
                                        <span class="label-up">Get Started</span>
                                    </div>
                                </a>
                                <span class="srs_about_popup"><i><svg class="srs_shiny_effect" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background: new 0 0 100 100" xml:space="preserve">
                                            <g class="hambar-one">
                                                <rect x="1" y="38.6" width="98" height="2.5"></rect>
                                                <rect x="110" y="38.6" width="98" height="2.5"></rect>
                                            </g>
                                            <g class="hambar-two">
                                                <rect x="1" y="58.9" width="98" height="2.5"></rect>
                                                <rect x="110" y="58.9" width="98" height="2.5"></rect>
                                            </g>
                                        </svg></i></span>
                                <a href="#" class="srs_nav_open">
                                    <i></i>
                                </a>
                            </div>
                        </nav>
                    </div>
                    <div class="srs_about_us">
                        <div class="srs_about_us_sec">
                            <h3 class="srs_title">About Us</h3>
                            <img class="srs_img" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/about image.jpg'; ?>" alt="about image" />
                            <p class="srs_des">
                                Continually underwhelm 24/7 leadership with interactive total linkage.
                                Intrinsicly create visionary bandwidth vis-a-vis next-generation
                                collaboration.
                            </p>
                            <a href="<?php echo get_site_url(); ?>/about-us/" class="r-custom-4-button-h">
                                <div class="koc-buttn">
                                    <span class="label-up">Know More</span>
                                    <span class="label-up">Know More</span>
                                </div>
                            </a>
                            <div class="srs_social">
                                <h3 class="srs_title">We Are Social</h3>
                                <div class="srs_icon_div">
                                    <p class="srs_icon_text">Follow Us:</p>
                                    <div>
                                        <a class="srs_icon" href="https://www.facebook.com/kingstonopencollege">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/fb icon.png'; ?>" alt="" />
                                        </a>
                                    </div>
                                    <div>
                                        <a class="srs_icon" href="https://www.instagram.com/kingstonopencollege/">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/insta icon.png'; ?>" alt="" />
                                        </a>
                                    </div>
                                    <div>
                                        <a class="srs_icon" href="https://www.pinterest.co.uk/KingstonOpenCollege/">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/twitter icon.png'; ?>" alt="" />
                                        </a>
                                    </div>
                                    <div>
                                        <a class="srs_icon" href="https://www.linkedin.com/company/kingston-open-college">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/linkedin icon.png'; ?>" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="srs_contact">
                                <h3 class="srs_title">Contact Us</h3>
                                <div class="srs_contact_info">
                                    <div class="srs_call">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/call.png'; ?>" alt="" />
                                        <p><a href="tel:020 39232763">020 39232763</a></p>
                                    </div>
                                    <div class="srs_email">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/header/email.png'; ?>" alt="" />
                                        <p><a href="mailto:Info@kingstonopencollege.co.uk">
                                                Info@kingstonopencollege.co.uk</a></p>
                                    </div>
                                </div>
                            </div>
                            <button class="srs_close_about">
                                x
                            </button>
                        </div>

                    </div>
                    <div class="srs_overlay">

                    </div>
                </header>
            
