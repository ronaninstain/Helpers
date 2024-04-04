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
        while ($related_courses_query->have_posts()) {
            $related_courses_query->the_post();
?>
            <?php
            $courseID = get_the_ID();
            $units = count(bp_course_get_curriculum_units($courseID));
            $courseImage = get_the_post_thumbnail_url($courseID, 'medium');
            $courseLink = get_the_permalink($courseID);
            $courseName = get_the_title();
            $courseStudents = get_post_meta($courseID, 'vibe_students', true);
            $average_rating = get_post_meta($courseID, 'average_rating', true);
            $countRating = get_post_meta($courseID, 'rating_count', true);
            $shortDes = get_the_excerpt();
            $product_ID = get_post_meta($courseID, 'vibe_product', true);
            $sitetUrl = get_site_url();
            ?>
            <!-- #1 Courses Card Start  -->
            <div class="a2n_course-card">
                <div class="a2n-thumb">
                    <img src="<?php echo $courseImage; ?>" alt="courseImg" />
                </div>
                <div class="a2n-course-details">
                    <p class="a2n-post_date">
                        <i class="fas fa-clock"></i><?php the_modified_date(); ?>
                    </p>
                    <p class="a2n-curriculum">
                        <i class="fas fa-book"></i><?php echo $units; ?> Curriculum
                    </p>
                    <p class="a2n-started-users">
                        <i class="fas fa-user"></i><?php echo $courseStudents; ?> Students
                    </p>
                </div>
                <div class="a2n-course__contents">
                    <div class="a2n-details-inner">
                        <div class="a2n-metadata-holder">
                            <h5>
                                <a href="<?php echo $courseLink; ?>"><?php echo $courseName; ?></a>
                            </h5>
                            <?php echo $shortDes; ?>
                        </div>
                    </div>
                    <div class="a2n-bottom-data">
                        <div class="a2n-coursedetail-price-details">
                            <span class="a2n-course__price">
                                <!-- price replace start  -->
                                <?php bp_course_credits(); ?>
                                <!-- price replace end  -->
                            </span>
                        </div>
                        <div class="a2n-ratings-container">
                            <p class="a2n-ratings">
                                <svg viewBox="0 0 1000 200" class="rating">
                                    <defs>
                                        <polygon id="star" points="100,0 131,66 200,76 150,128 162,200 100,166 38,200 50,128 0,76 69,66 "></polygon>
                                        <clipPath id="stars">
                                            <use xlink:href="#star"></use>
                                            <use xlink:href="#star" x="20%"></use>
                                            <use xlink:href="#star" x="40%"></use>
                                            <use xlink:href="#star" x="60%"></use>
                                            <use xlink:href="#star" x="80%"></use>
                                        </clipPath>
                                    </defs>
                                    <rect class="rating__background" clip-path="url(#stars)"></rect>
                                    <!-- Change the width of this rect to change the rating -->
                                    <rect width="<?php echo $average_rating ? 20 * $average_rating : 0; ?>%" class="rating__value" clip-path="url(#stars)"></rect>
                                </svg>
                            </p>
                            <p class="a2n-overall-ratings"><?php echo $countRating; ?></p>
                        </div>
                        <div class="a2n-coursedetail-cart-details">
                            <a href="<?php echo $sitetUrl;  ?>/cart/?add-to-cart=<?php echo $product_ID; ?>" class="a2n-button">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  #1 Courses Card end  -->
<?php
        }
        wp_reset_query();
    } else {
        echo 'No course found';
    }

    $output = ob_get_clean();

    return $output;
}
add_shortcode('courseCards', 'courseCards');
