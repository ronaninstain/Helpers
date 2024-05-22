<?php

function oneEdu_card_shortcode($atts)
{
  $atts = shortcode_atts(
    array(
      'id' => '',
      'category' => ''
    ),
    $atts
  );

  ob_start();

  $course_ids = $atts['id'];
  $category = $atts['category'];

  $arg = array(
    "post_type" => "course",
    "posts_per_page" => 6,
    "post_status" => "publish",
  );

  if (!empty($course_ids)) {
    $course_ids = explode(",", $course_ids);
    $arg['post__in'] = $course_ids;
  }

  if (!empty($category) && empty($course_ids)) {
    $category_ids = explode(",", $category);
    $arg['tax_query'] = array(
      array(
        'taxonomy' => 'course-cat',
        'field' => 'term_id',
        'terms' => $category_ids,
      ),
    );

  }

  $loop = new WP_Query($arg);

  if ($loop->have_posts()) {
    ?>
    <div class="srs_cards_pr">
      <?php
      // Start the Loop
      while ($loop->have_posts()) {
        $loop->the_post();
        $course_ID = get_the_ID();
        $course_img = get_the_post_thumbnail_url($course_ID, "medium");
        $average_rating = get_post_meta($course_ID, 'average_rating', true);
        $countRating = get_post_meta($course_ID, 'rating_count', true);
        $course_title = get_the_title($course_ID);
        $courseStudents = get_post_meta($course_ID, 'vibe_students', true);
        $courseLink = get_the_permalink($course_ID);
        $product_ID = get_post_meta($course_ID, 'vibe_product', true);
        $add_to_cart_url = wc_get_cart_url() . '?add-to-cart=' . $product_ID;
        ?>
        <div class="srs_card_pr">
          <div class="srs_img_wrapper">
            <a href="<?php echo $courseLink ?>">
              <img src="<?php echo $course_img; ?>" alt="course image" />
            </a>
          </div>
          <div class="srs_content_wrapper">
            <a class="srs_title" href="<?php echo $courseLink ?>">
              <?php echo $course_title; ?>
            </a>
            <div class="srs_meta_data">
              <div class="srs_student_count">
                <img src="<?php echo site_url(); ?>/wp-content/uploads/2024/05/bi_people-fill.png"
                  alt="student image" />
                <p><?php echo $courseStudents; ?> Students</p>
              </div>
              <?php if (is_numeric($average_rating)) {
                $percentage = ($average_rating / 5) * 100;
              } ?>
              <div class="rating_count">
                <div class="srs-ratings-container bp_blank_stars">
                  <div style="width: <?php echo $percentage; ?>%" class="bp_filled_stars"></div>
                </div>
                <p>(<?php echo $countRating; ?>)</p>
              </div>
            </div>
            <div class="srs_price_container">
              <?php bp_course_credits(); ?>
              <a class="srs_btn" href="<?php echo $add_to_cart_url ?>">Buy Now</a>
            </div>
          </div>
        </div>
        <?php
      }
      wp_reset_query();
      ?>
    </div>
    <?php
  } else {
    echo "No Course Found";
  }

  return ob_get_clean();
}

add_shortcode('oneEdu_card', 'oneEdu_card_shortcode');
