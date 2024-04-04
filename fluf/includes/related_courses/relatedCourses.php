<?php

/* Related Courses short-code by Shoive Start */

function sh_23_singleCourse_add_related_course_for_single_course()
{
    $currentID = get_queried_object_id();

    $current_course_terms = get_the_terms($currentID, 'course-cat');

    $current_course_term_ids = array();

    if ($current_course_terms) {
        foreach ($current_course_terms as $term) {
            $current_course_term_ids[] = $term->term_id;
        }
    }

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

    $related_courses_query = new WP_Query($args);

    if ($related_courses_query->have_posts()) {
        echo '<div class="listBox">';
        while ($related_courses_query->have_posts()) {
            $related_courses_query->the_post();
?>
            <?php
            $courseID = get_the_ID();
            $average_rating = get_post_meta($courseID, 'average_rating', true);
            $countRating = get_post_meta($courseID, 'rating_count', true);

            $product_ID = get_post_meta($courseID, 'vibe_product', true);
            ?>

            <ul>
                <li>
                    <div class="sh_23_singleCourse_top_courses">
                        <div class="sh_23_singleCourse_thumb">
                            <a href="<?php the_permalink(); ?>" class="sh_23_singleCourse_thumbimg">
                                <?php
                                if (has_post_thumbnail()) {
                                ?>
                                    <img src="<?php echo get_the_post_thumbnail_url($courseID, 'small') ?>" alt="relatedcourseimage">
                                <?php
                                } else {
                                    echo '<img src="https://dummyimage.com/600x400/7d797d/ffffff" alt="alt image" />';
                                }
                                ?>
                            </a>
                        </div>
                        <div class="sh_23_singleCourse_details">
                            <div class="sh_23_singleCourse_title_box"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                            <div class="the_review_box">
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
                                <div class="the_ratings_details">
                                    <?php
                                    echo '<span>' . $average_rating . '</span>';
                                    echo '(' . $countRating . ' reviews)';
                                    ?>
                                </div>
                            </div>
                            <div class="sh_23_singleCourse_footer">
                                <div class="the-sh-add-to-cart-button-23-single">
                                    <a href="<?php echo get_site_url();  ?>/cart/?add-to-cart=<?php echo $product_ID; ?>">Add to Cart</a>
                                    <a href="<?php the_permalink(); ?>" class="seeMorebtn">See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
<?php
        }
        echo '</div>';
        wp_reset_query();
    } else {
        echo 'No course found';
    }
}
add_shortcode('related_course', 'sh_23_singleCourse_add_related_course_for_single_course');

/* Related Courses short-code by Shoive End */