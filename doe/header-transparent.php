<?php
//Header File
if (!defined('ABSPATH')) {
  exit;
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <?php
  wp_head();
  ?>
</head>

<body <?php body_class(); ?>>
  <div id="global" class="global">
    <?php
    get_template_part('mobile', 'sidebar');
    ?>
    <div class="pusher">
      <?php
      $fix = vibe_get_option('header_fix');
      ?>
      <header>
        <nav class="navbar_pr">
          <div class="navbar sticky">
            <?php

            if (is_home()) {
              echo '<h1 id="logo">';
            } else {
              echo '<h2 id="logo">';
            }

            $url = apply_filters('wplms_logo_url', VIBE_URL . '/assets/images/logo.png', 'header');
            if (!empty($url)) {
            ?>

              <a class="logo" href="<?php echo vibe_site_url('', 'logo'); ?>"><img src="<?php echo vibe_sanitizer($url, 'url'); ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
            <?php

            }
            if (is_home()) {
              echo '</h1>';
            } else {
              echo '</h2>';
            } ?>

            <div class="menu-btn" id="srsMenuBtn" style="background-color:#FF7235;">
              <div class="menu-btn__lines"></div>
            </div>

            

            <ul class="menu-items">
              <li class="srs_first_child">
                <a href="#" class="menu-item first-item expand-btn">All courses
                  <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/arrow.png'; ?>" alt="arrow">
                </a>
                <div class="mega-menu sample">
                  <?php
                  $taxonomy = 'course-cat';
                  $terms = get_terms(array(
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'number'     => 6,
                  ));
                  ?>
                  <div class="content">
                    <div class="srs_mega_menu_item_pr">
                      <h4 class="srs_mega_heading">Popular Courses</h4>
                      <ul class="srs_mega_menu_items">
                        <?php foreach ($terms as $term) : ?>
                          <li>
                            <a href="<?php echo get_term_link($term); ?>" class="srs_mega_menu_item"><?php echo $term->name; ?></a>
                            <ul>
                              <?php
                              $args = array(
                                'post_type'      => 'course',
                                'posts_per_page' => 18,
                                'tax_query'      => array(
                                  array(
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'term_id',
                                    'terms'    => $term->term_id,
                                  ),
                                ),
                              );
                              $courses_query = new WP_Query($args);
                              if ($courses_query->have_posts()) :
                                while ($courses_query->have_posts()) : $courses_query->the_post(); ?>
                                  <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                              <?php endwhile;
                                wp_reset_postdata();
                              else :
                                echo '<li>No courses found</li>';
                              endif;
                              ?>
                            </ul>
                          </li>
                        <?php endforeach; ?>
                        <li><a href="<?php echo site_url(); ?>/all-courses/" class="srs_mega_menu_item">View All Courses</a></li>
                      </ul>
                    </div>
                    <div class="srs_brand_sec">
                      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/UKRPL.webp'; ?>" alt="Brand">
                      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/cpd.webp'; ?>" alt="Brand">
                      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/CiQ.webp'; ?>" alt="Brand">
                      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/Incensu.webp'; ?>" alt="Brand">

                    </div>
                  </div>
                </div>
              </li>
              <li><a href="/hot-deal" class="menu-item first-item srs_hot_deals">
                  Hot Deals
                  <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/fire_1f525.png'; ?>" alt="arrow">

                </a></li>
              <li><a href="/lifetime-prime-membership" class="menu-item first-item srs_prime_membership">Prime Membership</a></li>

              <li class="menu-item last-item srs_explore_more">
                <a href="#" class="menu-item expand-btn2">Explore more

                  <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/arrow.png'; ?>" alt="arrow">
                </a>
                <ul class="srs_explore_more_dropDown">
                  <li><a href="/quality-licence-scheme-endorsed/">
                      Quality Licence Scheme Endorsed
                    </a></li>
                  <li>
                    <a href="/student-id-card/">
                      Student ID
                    </a>
                  </li>
                  <li><a href="/subscription/">
                      Get Unlimited Access to All Our Courses
                    </a></li>
                  <li><a href="/career-exclusive/">
                      Career Bundle
                    </a></li>
                  <li>
                    <a href="/enrolment-letter">
                      Enrollment Letter
                    </a>
                  </li>
                  <li><a href="/certificate/">
                      Order Your Certificate
                    </a></li>
                  <li><a href="/refer-a-friend/">
                      Learn &amp; Earn Program
                    </a></li>
                  <li><a href="/prime/">
                      Prime Membership
                    </a></li>
                </ul>
              </li>
              <div class="header__search-input">
                <div class="search-container" id="foy-search-suggestion">
                  <form method="GET" action="<?php echo get_site_url(); ?>" id="header-search-form">
                    <input type="text" name="s" placeholder="Search Courses ..." class="autocomplete_field" id="autoCompleteOne" value="" autocomplete="off">
                    <input type="hidden" name="post_type" value="course">
                    <button type="submit" id="search_iconOne" class="btn btn-warning btn-fla" aria-label="Search">
                      <span class="fa fa-search" style="pointer-events: none;"></span>
                    </button>
                  </form>
                </div>
              </div>
              <!-- <form id="search" class="menu-item first-item srs_search_field" action="">
                <input type="hidden" name="post_type" value="course">
                <input type="text" class="s" id="s" name="s" placeholder="Search over 1900+ courses" value="">
                <button type="submit" class="sbtn">
                  <img src="<?php echo get_stylesheet_directory_uri() . "/assets/imgs/header/Vector (13).svg" ?>" alt="search">
                </button>
              </form> -->
            </ul>
            <ul class="cart_login_part">

              <?php
              $show_cart = apply_filters('wplms_header_show_cart', 1);
              if (function_exists('bp_loggedin_user_link') && is_user_logged_in()) :
              ?>

                <li class="log_btn"><a href="<?php bp_loggedin_user_link(); ?>" class="smallimg vbplogin">
                    <span>
                      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/user.svg'; ?>" alt="user">


                      <p><?php bp_loggedin_user_fullname(); ?></p>
                    </span></a></li>
                <?php

                if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))  || (function_exists('vibe_check_plugin_installed') && vibe_check_plugin_installed('woocommerce/woocommerce.php')) && $show_cart) {
                  global $woocommerce;
                ?>
                  <li><a class="smallimg vbpcart"><span class="">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/cartjh.svg'; ?>" />
                        <?php echo (($woocommerce->cart->cart_contents_count) ? '<em>' . $woocommerce->cart->cart_contents_count . '</em>' : ''); ?></span></a>
                    <div class="woocart">
                      <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
                    </div>
                  </li>
                <?php
                }
                ?>

              <?php
              else :
              ?>

                <li class="log_btn"><a href="#login" rel="nofollow" class=" vbplogin"><span><img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/user.svg'; ?>" alt="user">
                      <p><?php _e('LOGIN', 'vibe'); ?></p>
                    </span></a></li>
                <?php
                if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))  || (function_exists('vibe_check_plugin_installed') && vibe_check_plugin_installed('woocommerce/woocommerce.php')) && $show_cart) {
                  global $woocommerce;
                ?>
                  <li><a class=" vbpcart"><span class=""><img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/cartjh.svg'; ?>" /> <?php echo (($woocommerce->cart->cart_contents_count) ? '<em>' . $woocommerce->cart->cart_contents_count . '</em>' : ''); ?></span></a>
                    <div class="woocart"><?php woocommerce_mini_cart(); ?></div>
                  </li>
                <?php
                }
                ?>

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
            </ul>
          </div>
          <div class="srs_mobile_mega">
            <div class="srs_mega_menu_item_pr">
              <div class="srs_heading_sec">
                <h4 class="srs_mega_heading">Popular Courses</h4>
                <img width="16" height="16" class="srs_cross" src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/cross.png'; ?>" alt="cross">
              </div>
              <ul class="srs_mega_menu_items">
                <?php foreach ($terms as $term) : ?>
                  <li>
                    <a href="# <?php //echo get_term_link($term); 
                                ?>" class="srs_mega_menu_item"><?php echo $term->name; ?></a>
                    <ul>
                      <?php
                      $args = array(
                        'post_type'      => 'course',
                        'posts_per_page' => 18,
                        'tax_query'      => array(
                          array(
                            'taxonomy' => $taxonomy,
                            'field'    => 'term_id',
                            'terms'    => $term->term_id,
                          ),
                        ),
                      );
                      $courses_query = new WP_Query($args);
                      if ($courses_query->have_posts()) :
                        while ($courses_query->have_posts()) : $courses_query->the_post(); ?>
                          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                      <?php endwhile;
                        wp_reset_postdata();
                      else :
                        echo '<li>No courses found</li>';
                      endif;
                      ?>
                    </ul>
                  </li>
                <?php endforeach; ?>
                <li><a href="<?php echo site_url(); ?>/all-courses/" class="srs_mega_menu_item">View All Courses</a></li>
              </ul>

            </div>
            <div class="srs_brand_sec">
              <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/UKRPL.webp'; ?>" alt="Brand">
              <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/cpd.webp'; ?>" alt="Brand">
              <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/CiQ.webp'; ?>" alt="Brand">
              <img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/header/Incensu.webp'; ?>" alt="Brand">
            </div>
          </div>
        </nav>
      </header>

