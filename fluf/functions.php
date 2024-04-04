<?php
if (!defined('VIBE_URL'))
    define('VIBE_URL', get_template_directory_uri());


//Social Shares
include_once 'includes/socials/socialShare.php';
//Related Courses
include_once 'includes/related_courses/relatedCourses.php';

/* for add-to-cart ajax in course page start by shoive */

function enqueue_custom_scripts()
{
    // css by shoive
    wp_enqueue_style('single-course', get_theme_file_uri('/assets/css/singleCourse.css'), false, time(), 'all');
    wp_enqueue_style('commonCss', get_theme_file_uri('/assets/css/common.css'), false, time(), 'all');

    //js
    wp_enqueue_script('custom-ajax-script', get_theme_file_uri('/assets/js/custom-ajax-script.js'), array('jquery'), time(), true);

    // Localize the script with the necessary data
    wp_localize_script('custom-ajax-script', 'customAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function add_to_cart_ajax()
{
    $data = $_POST['data'];
    $product_id = $data['product_id'];
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        WC()->cart->add_to_cart($product_id);

        // You can perform additional actions here if needed

        wp_die(); // Always die in functions echoing Ajax content
    }
}

add_action('wp_ajax_add_to_cart_ajax', 'add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart_ajax', 'add_to_cart_ajax');


/* for add-to-cart ajax in course page end by shoive */

add_action('wp_footer', 'my_custom_wc_button_script');
function my_custom_wc_button_script()
{
?>
    <script>
        jQuery(document).ready(function($) {
            var ajaxurl = "<?php echo esc_attr(admin_url('admin-ajax.php')); ?>";

            jQuery(document).on('click', '.xs-add-to-cart-button', function(e) {
                var id = $(this).data("product-id");
                if ($(this).prop("checked") == true) {
                    var $this = $(this);
                    if ($this.is(':disabled')) {
                        return;
                    }

                    var data = {
                        action: 'xs_add_to_cart',
                        product_id: id
                    };
                    $.post(ajaxurl, data, function(response) {
                        if (response.success) {
                            $this.prop("checked", true);
                            $this.addClass("on-cart");
                            $(document.body).trigger('added_to_cart');
                        }
                    }, 'json');
                } else if ($(this).prop("checked") == false) {
                    $('a.remove[data-product_id="' + id + '"]').trigger('click');
                    $this.prop("checked", false);
                    $(document.body).trigger('added_to_cart');
                }
            })
        });
    </script>
<?php
}




/**
 * course directory course loop section modift by filter hook,
 * because its not a template so not possible to override course loop section without filter hook,
 * its wplms theme official instruction wplms theme support forum
 */
add_filter('bp_course_single_item_view', function ($x) {
    global $post;

    $course_id = get_the_ID();
    $product_id = get_post_meta($course_id, 'vibe_product', true);
    $vibe_students = get_post_meta($course_id, 'vibe_students', true);
    $average_rating = get_post_meta($course_id, 'average_rating', true);
    $course_classes = apply_filters('bp_course_single_item', 'course_single_item course_id_' . $post->ID . ' course_status_' . $post->post_status . ' course_author_' . $post->post_author, get_the_ID());
    $count = get_post_meta(get_the_ID(), 'rating_count', true);
    $units = bp_course_get_curriculum_units($course_id);

    $duration = $total_duration = 0;
    if ($units != "") {
        foreach ($units as $unit) {
            $duration = get_post_meta($unit, 'vibe_duration', true);
            $total_duration =  $total_duration + $duration;
        }
        $hours = floor($total_duration / 60);
        $minutes = $total_duration % 60;
        if ($hours > 0) {
            $hours_text = $hours . 'hr';
        }
        if ($minutes > 0) {
            $minutes_text = $minutes . 'm';
        }
    }
?>
    <li class="<?php echo $course_classes; ?>">
        <div class="a2n_course-card">
            <div class="courses_container">
                <div id="courses_content">
                    <?php
                    bp_course_avatar();
                    ?>
                    <div class="courses_items">
                        <h4 class="courses_title">
                            <a href="<?php echo get_the_permalink($course_id) ?>">
                                <?php echo get_the_title(); ?>
                            </a>
                        </h4>
                        <div class="inner_items">
                            <p>
                                <img src="https://coursecloud.org/wp-content/uploads/2023/11/Frame-83.svg" alt="" />
                                <?php echo $vibe_students . " Students"; ?>
                            </p>
                            <p>
                                <img src="https://coursecloud.org/wp-content/uploads/2023/11/Group-42.svg" alt="" />
                                <?php echo $hours_text . " " . $minutes_text ?>
                            </p>
                        </div>
                        <h5 class="courses_ratings">
                            <?php if (!empty($average_rating)) { ?>
                                <span><i class="fa fa-star" aria-hidden="true"></i> <?php echo $average_rating; ?></span>
                                <?php
                                if ($count > 999) {
                                    echo "(" . ($count / 1000) . 'k' . ")";
                                } else {
                                    echo "(" . $count . ")";
                                }
                                ?>
                            <?php } ?>
                        </h5>

                        <div class="courses_end">
                            <div class="price-div">
                                <?php
                                if (!bp_is_my_profile()) {
                                    bp_course_credits();
                                } else {
                                    the_course_button($course_id);
                                }
                                ?>
                            </div>
                            <div class="btn-div">
                                <?php
                                if (!bp_is_my_profile()) {
                                ?>
                                    <a href="<?php echo esc_url(get_home_url() . '/cart/' . '?add-to-cart=' . esc_attr($product_id)); ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart  add-to-cart-btn main_button" data-product_id="<?php echo $product_id; ?>" data-product_sku="" aria-label="Add" rel="nofollow">
                                        Buy Now
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="courses_bottom-shape"></div>
            </div>
        </div>
    </li>
<?php
    return 1;
});
add_filter('woocommerce_price_trim_zeros', '__return_true');

/* enabling custom fields id ACF plugin is activated by Shoive Start */

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

/* enabling custom fields id ACF plugin is activated by Shoive end */
