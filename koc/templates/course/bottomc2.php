<?php
if (!defined('ABSPATH')) exit;
do_action('wplms_single_course_content_end');
?>
</div>
<!-- <h1>bottom 2 child theme</h1> -->
<div class="col-md-4">
  <?php bp_course_avatar(); ?>
  <div class="widget pricing" id="course-pricing">
    <div class="singleprice-custom">
      <?php
      $product_id = get_post_meta(get_the_id(), 'vibe_product', true);
      $product = wc_get_product($product_id);
      ?>
      <?php


      $user_id = get_current_user_id();
      $course_id = get_the_ID();
      $course_check = wplms_user_course_check($user_id, $course_id);
      //var_dump($course_check );
      if (!$course_check) {
          ?>
          <div class="singleprice-divtwo">
              <div class="single-regular-price-new"><span class="single-del-price">
              <?php bp_course_credits(); ?>
              </div>
          </div>
          <?php
      }

      ?>

    


    </div>
    <?php
    if (class_exists('ACF')) :
      if (get_field('course_material')) : ?>
        <ul class="single-course-meterial">
          <h5 class="singlesidebar-title">Course Material</h5>
          <?php while (the_repeater_field('course_material')) : ?>
            <li><i class="fa fa-check" aria-hidden="true"></i> <?php the_sub_field('material_items'); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
    <?php the_course_button(); ?>
    <div class="clear-pay">
      <?php 
         $product_id = get_post_meta(get_the_id(), 'vibe_product', true);
        //  $product = wc_get_product($product_id);
        //  var_dump($product);
      ?>
      <a href="<?php echo site_url().'/cart/?add-to-cart='.$product_id; ?>">
        <img src="https://static.afterpay.com/button/checkout-with-clearpay/black-on-mint.svg" alt="clear pay">
      </a>
      
      <p>Enrol now, pay later in easy instalments(Interest free) with Clearpay.</p>
    </div>
    <div class="enq_butn">
      <!-- <a href="https://www.kingstonopencollege.co.uk/contact-us/">ENQUIRE NOW</a> -->
      <a href="#link-enquirenow-popup">ENQUIRE NOW</a>
    </div>
  </div>
  <div class="course-requirement widget pricing">
    <?php
    if (class_exists('ACF')) :
      if (get_field('course_requirements')) : ?>
        <h5 class="singlesidebar-title">Course Requirements</h5>
        <ul>
          <?php while (the_repeater_field('course_requirements')) : ?>
            <li><i class="fa fa-check" aria-hidden="true"></i> <?php the_sub_field('course_requirements'); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <div class="course-tag widget pricing">
    <div class="custom-tagscustom">
      <h5 class="singlesidebar-title">Tags</h5>
      <?php
      $course_id = get_the_ID();
      $terms = get_the_terms($course_id, 'coursetag');
      if (!empty($terms)) {

        $category = array();
        $cat = "";
        echo '<ul class="course-tagsul">';
        foreach ($terms as $term) {
          echo '<li class="course_tags">' . $term->name . '</li>';
        }
        echo '</ul>';

        $course_category = implode(',', $category);
      }
      ?>
    </div>
  </div>

  <div class="course-audience widget pricing">
    <?php
    if (class_exists('ACF')) :
      if (get_field('course_target_audience')) : ?>
        <h5 class="singlesidebar-title">Target Audience</h5>
        <ul>
          <?php while (the_repeater_field('course_target_audience')) : ?>
            <li><i class="fa fa-check" aria-hidden="true"></i> <?php the_sub_field('course_target_audience'); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </div>


  <div class="cs_widgets">
    <?php
    $sidebar = apply_filters('wplms_sidebar', 'coursesidebar', get_the_ID());
    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) :
    ?>
    <?php endif; ?>
  </div>
</div>
</div><!-- .row -->
</div><!-- .container -->
</div><!-- #buddypress -->
</section>