<?php

function courseCards2($atts)
{
    ob_start();

    $course_id = $atts['courseid'];

    $currentID = get_queried_object_id();

    $current_course_terms = get_the_terms($currentID, 'course-cat');

    $current_course_term_ids = array();

    if ($current_course_terms) {
        foreach ($current_course_terms as $term) {
            $current_course_term_ids[] = $term->term_id;
        }
    }

    if (!empty($course_id)) {
        $course_ids = $course_id;
        $course_ids = (explode(",", $course_ids));

        $c_id = array();

        if ($course_ids) {
            foreach ($course_ids as $course_id) {
                $c_id[] = $course_id;
            }
        }

        $args = array(
            'post_type' => 'course',
            'posts_per_page' => 12,
            'post__in' => $c_id
        );
    } else {
        $args = array(
            'post_type' => 'course',
            'posts_per_page' => 5,
            'post__not_in' => array(get_the_ID()),
            'tax_query' => array(
                array(
                    'taxonomy' => 'course-cat',
                    'field' => 'id',
                    'terms' => $current_course_term_ids,
                ),
            ),
        );
    }

    $related_courses_query = new WP_Query($args);

    if ($related_courses_query->have_posts()) {
?>
        <?php

        while ($related_courses_query->have_posts()) {
            $related_courses_query->the_post();
        ?>
            <?php
            $courseID = get_the_ID();
            $units = bp_course_get_curriculum_units($courseID);
            $duration = $total_duration = 0;

            foreach ($units as $unit) {

                $duration = get_post_meta($unit, 'vibe_duration', true);

                if (empty($duration)) {
                    $duration = 0;
                }

                if (get_post_type($unit) == 'unit') {
                    $unit_duration_parameter = apply_filters('vibe_unit_duration_parameter', 60, $unit);
                } elseif (get_post_type($unit) == 'quiz') {

                    $unit_duration_parameter = apply_filters('vibe_quiz_duration_parameter', 60, $unit);
                }
                $total_duration =  $total_duration + $duration * $unit_duration_parameter;
            }

            $courseDuration =  tofriendlytime(($total_duration));
            $taxonomy = 'course-cat';
            $terms = wp_get_post_terms($courseID, $taxonomy, array('fields' => 'all'));
            $courseImage = get_the_post_thumbnail_url($courseID, 'medium');
            $courseLink = get_the_permalink($courseID);
            $courseStds =  get_post_meta($courseID, 'vibe_students', true);
            $average_rating = get_post_meta($courseID, 'average_rating', true);
            ?>
            <div class="srs_course_card">
                <div class="srs_img_wrapper">
                    <a href="<?php echo  $courseLink; ?>"><img src="<?php echo $courseImage ?>" alt="courseImage" /></a>
                    <div class="srs_timing">
                        <i aria-hidden="true" class="far fa-clock"></i>
                        <?php echo $courseDuration; ?>
                    </div>
                </div>
                <div class="srs_content_wrapper">
                    <ul>
                        <?php
                        foreach (array_slice($terms, 0, 1) as $term_single) {
                        ?>
                            <li><a href="<?php echo esc_url(get_term_link($term_single)); ?>"><?php echo esc_html($term_single->name); ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <h5 class="srs_name"><?php bp_course_name(); ?></h5>
                </div>

                <div class="stdsAndrattings">
                    <div class="s-icon">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/11/profile.png" alt="stds" class="img-icon">
                        <span>
                            <?php echo $courseStds; ?>
                        </span>
                    </div>
                    <div class="rating_sh_content">
                        <div class="sh_rating">
                            <div class="sh_rating-upper" style="width:<?php echo $average_rating ? 20 * $average_rating : 0; ?>%">
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                            </div>
                            <div class="sh_rating-lower">
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
        }
        wp_reset_query();
    } else {
        echo 'No course found';
    }

    $output = ob_get_clean();

    return $output;
}
add_shortcode('courseCards2', 'courseCards2');
