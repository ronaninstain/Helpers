<?php

// course shortcode function 

function a2n_courses_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'id' => '',
        ),
        $atts
    );
    ob_start();

    $a2n_course_id = $atts['id'];
    if (!empty($a2n_course_id)) {
        $a2n_course_ids = $a2n_course_id;
        $a2n_course_ids = (explode(",", $a2n_course_ids));
        $course_id = array();
        if ($a2n_course_ids) {
            foreach ($a2n_course_ids as $a2n_course_id) {
                $course_id[] = $a2n_course_id;
            }
        }
        $args = array(
            'post_type' => 'course',
            'posts_per_page' => 12,
            'post__in' => $course_id,
            'post_status' => 'published',
        );
    }
    $fetch = new WP_Query($args);
    if ($fetch->have_posts()) {
        while ($fetch->have_posts()) {
            $fetch->the_post();

            $course_ID = get_the_ID();
            $course_title = get_the_title($course_ID);
            $course_img = get_the_post_thumbnail_url($course_ID, "large");
            $average_rating = get_post_meta($course_ID, 'average_rating', true);
            $units = bp_course_get_curriculum_units($course_ID);
            $durations = $total_durations = 0;

            foreach ($units as $unit) {
                $durations = get_post_meta($units, 'vibe_durations', true);
                if (empty($durations)) {
                    $durations = 0;
                }
                if (get_post_type($unit) == 'unit') {
                    $unit_durations_parameter = apply_filters('vibe_unit_duration_parameter', 60, $unit);
                } elseif (get_post_type($unit) == 'quize') {
                    $unit_durations_parameter = apply_filters('vibe_unit_duration_parameter', 60, $unit);
                }
                $total_durations = $total_durations + $durations * $unit_durations_parameter;
            }
            $course_students = get_post_meta($course_ID, 'vibe_students', true);
            $course_link = get_the_permalink($course_ID);
            $product_ID = get_post_meta($course_ID, 'vibe_product', true);
            $add_to_cart_url = wc_get_cart_url() . '?add-to-cart=' . $product_ID;

?>

            <div class="a2n-course_card">
                <div class="a2n-course__img">
                    <img src="<?php echo $course_img ?>" alt="" />
                </div>
                <div class="a2n-course__contents">
                    <div class="course_title">
                        <a href="<?php
                                    echo esc_attr($course_link);
                                    ?>">
                            <?php
                            echo esc_html($course_title);
                            ?>
                        </a>
                    </div>
                    <div class="course_details">
                        <div class="course_ratings">
                            <?php
                            if (is_numeric($average_rating)) {
                                $percentage = ($average_rating / 5) * 100;
                                echo '<div class="star-ratings">
                                <div class="fill-ratings" style="width:' . $percentage . '%;">
                                  <span>★★★★★</span>
                                </div>
                                <div class="empty-ratings">
                                  <span>★★★★★</span>
                                </div>
                              </div>';
                            }

                            ?>


                        </div>

                        <div class="course_students">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/imgs/students.svg" alt="user" />
                            <h5>
                                <?php echo $course_students ?> Students
                            </h5>
                        </div>
                    </div>
                    <div class="course_price">
                        <div class="price">
                            <?php
                            bp_course_credits();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="a2n-course__footer">
                    <a class="a2n-view_btn" href="<?php
                                                    echo $course_link;
                                                    ?>">View Details</a>
                    <a class="a2n-cart_btn" href="<?php
                                                    echo $add_to_cart_url ?>">Add to Cart</a>
                </div>
            </div>

<?php
        }
        wp_reset_query();
    } else {
        echo "no course found";
    }
    return ob_get_clean();
}
add_shortcode('a2n_courses', 'a2n_courses_shortcode');
