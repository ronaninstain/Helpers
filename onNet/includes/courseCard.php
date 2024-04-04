<?php

function courseCards($atts)
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
            'posts_per_page' => 6,
            'post__in' => $c_id
        );
    } else {
        $args = array(
            'post_type' => 'course',
            'posts_per_page' => 3,
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
        echo '<div class="col-md-4 col-sm-6 col-xs-12">';

        while ($related_courses_query->have_posts()) {
            $related_courses_query->the_post();
        ?>
            <?php
            $courseID = get_the_ID();
            $courseStudents = get_post_meta($courseID, 'vibe_students', true);
            $units = bp_course_get_curriculum_units($courseID);
            $duration = $total_duration = 0;
            $curriculums = bp_course_get_curriculum($courseID);

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

            $courseStudents = get_post_meta($courseID, 'vibe_students', true);
            $average_rating = get_post_meta($courseID, 'average_rating', true);
            $courseImage = get_the_post_thumbnail_url($courseID, 'medium');
            $courseLink = get_the_permalink($courseID);
            ?>

            <!-- Default card -->
            <div class="dis-course-card">
                <a href="<?php echo $courseLink; ?>" class="dis-course-thumbnail">
                    <img src="<?php echo $courseImage ?>" alt="The Course Thumbnail">
                </a>

                <a href="<?php echo $courseLink; ?>">
                    <h4><?php bp_course_name(); ?></h4>
                </a>

                <div class="dis-course-info">
                    <p>
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2024/02/students.png" alt="students">
                        <?php echo $courseStudents; ?>
                    </p>

                    <p><?php echo  $average_rating; ?></p>
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

                <div class="dis-course-bottom">
                    <h6>
                        <?php bp_course_credits(); ?>
                    </h6>

                    <h5 class="dis-course-btn">
                        <a href="<?php echo $courseLink; ?>">View More</a>
                    </h5>
                </div>
            </div>

<?php
        }
        echo '</div>';
        wp_reset_query();
    } else {
        echo 'No course found';
    }

    $output = ob_get_clean();

    return $output;
}
add_shortcode('courseCards', 'courseCards');
