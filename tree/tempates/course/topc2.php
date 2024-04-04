<?php
if (!defined('ABSPATH')) exit;
?>

<!-- Course hero section start  -->
<?php
$courseID = get_the_ID();
$courseStudents = get_post_meta($courseID, 'vibe_students', true);
$average_rating = get_post_meta($courseID, 'average_rating', true);
$countRating = get_post_meta($courseID, 'rating_count', true);
$terms = get_the_terms($courseID, 'level');
$product_id = get_post_meta($courseID, 'vibe_product', true);
$price = get_post_meta($product_id, '_regular_price', true);
$sale = get_post_meta($product_id, '_sale_price', true);
$totalDiscount = (100 - ((100 * $sale) / $price));
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

$sub_title_meta = get_post_meta($courseID, '_course_sub_title_filed', true);

function get_number_of_quizzes($courseID)
{
    $units = bp_course_get_curriculum_units($courseID);
    $quizCount = 0;
    foreach ($units as $unit) {
        if (get_post_type($unit) == 'quiz') {
            $quizCount++;
        }
    }
    return $quizCount;
}
$quiz_count = get_number_of_quizzes($courseID);
?>
<div class="a2n_c-hero_section">
    <div class="container">
        <!-- <div class="row">
					<div class="col-md-12">
						<div class="a2n-breadcrumb">
							<?php //vibe_breadcrumbs(); 
                            ?>
						</div>
					</div>
				</div> -->
        <div class="row">
            <div class="col-sm-8">
                <h2 class="a2n-c_h-title">
                    <?php bp_course_name(); ?>
                </h2>
                <h3 class="a2n_cr-text a2n_cr-text1">
                    <?php
                    /*   if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                        ?>
                                <a href="<?php echo home_url(); ?>/level/<?php echo $term->slug; ?>" rel="tag"><?php echo $term->name; ?></a>
                                <?php
                                break;
                            }
                        } */
                    ?><?php echo $sub_title_meta != "" ? $sub_title_meta : " CPDUK Accredited | 50% OFF Certificate & Transcript" ?>
                </h3>
                <h4 class="a2n_cr-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                        <path d="M7.58245 7.02264L7.79258 7.02355C10.6345 7.04856 12.2495 7.59164 12.2495 9.09394C12.2495 10.5609 10.7057 11.1226 7.99739 11.1727L7.58245 11.1765C4.60978 11.1765 2.91542 10.6442 2.91542 9.10518C2.91542 7.56446 4.61658 7.02264 7.58245 7.02264ZM7.58245 7.99126C5.17906 7.99126 3.94937 8.38292 3.94937 9.10518C3.94937 9.8224 5.17632 10.2079 7.58245 10.2079C9.98512 10.2079 11.2155 9.81585 11.2155 9.09394C11.2155 8.3768 9.9882 7.99126 7.58245 7.99126ZM12.4372 6.62032C12.7968 6.64356 13.1506 6.6914 13.4816 6.76138C14.2184 6.89653 14.7722 7.15535 15.0294 7.6603C15.2188 8.03333 15.2188 8.46708 15.0294 8.84109C14.774 9.34412 14.2296 9.59942 13.4864 9.74259C13.2067 9.79646 12.9334 9.62775 12.8759 9.36575C12.8183 9.10376 12.9984 8.84769 13.2781 8.79382C13.7277 8.7072 14.0226 8.56892 14.0955 8.4255C14.1515 8.31482 14.1515 8.18623 14.096 8.07687C14.0222 7.93199 13.7248 7.79301 13.2687 7.70917C12.9754 7.64733 12.6738 7.60654 12.366 7.58665C12.0812 7.56825 11.8662 7.33701 11.8858 7.07017C11.9055 6.80332 12.1523 6.60192 12.4372 6.62032ZM3.28552 7.07017C3.30516 7.33701 3.09018 7.56825 2.80534 7.58665C2.57449 7.60157 2.34711 7.62824 2.11814 7.66791L1.88845 7.71196C1.44669 7.79298 1.14962 7.93187 1.07588 8.07712C1.02001 8.18662 1.02001 8.31444 1.07657 8.42558C1.14917 8.56903 1.44376 8.70723 1.89325 8.79382C2.17292 8.84769 2.35301 9.10376 2.2955 9.36575C2.23799 9.62775 1.96466 9.79646 1.68499 9.74259C0.941479 9.59936 0.397086 9.34398 0.142785 8.84148C-0.0475617 8.46747 -0.0475617 8.03294 0.142585 7.66024C0.381781 7.18914 0.880113 6.9322 1.53331 6.79238L1.67561 6.76418C2.0208 6.6914 2.37453 6.64356 2.7342 6.62032C3.01904 6.60192 3.26587 6.80332 3.28552 7.07017ZM7.58245 0.228027C9.344 0.228027 10.7589 1.55356 10.7589 3.2038C10.7589 4.85453 9.34411 6.18017 7.58245 6.18017C5.82079 6.18017 4.40598 4.85453 4.40598 3.2038C4.40598 1.55356 5.82091 0.228027 7.58245 0.228027ZM11.4819 0.836243C12.872 0.836243 13.9994 1.89192 13.9994 3.19404C13.9994 4.49616 12.872 5.55183 11.4819 5.55183C11.1964 5.55183 10.9649 5.335 10.9649 5.06752C10.9649 4.80004 11.1964 4.58321 11.4819 4.58321C12.3011 4.58321 12.9654 3.96111 12.9654 3.19404C12.9654 2.42697 12.3011 1.80487 11.4819 1.80487C11.1964 1.80487 10.9649 1.58803 10.9649 1.32056C10.9649 1.05308 11.1964 0.836243 11.4819 0.836243ZM3.68944 0.836243C3.97496 0.836243 4.20641 1.05308 4.20641 1.32056C4.20641 1.58803 3.97496 1.80487 3.68944 1.80487C2.87029 1.80487 2.20595 2.42697 2.20595 3.19404C2.20595 3.96111 2.87029 4.58321 3.68944 4.58321C3.97496 4.58321 4.20641 4.80004 4.20641 5.06752C4.20641 5.335 3.97496 5.55183 3.68944 5.55183C2.29936 5.55183 1.17199 4.49616 1.17199 3.19404C1.17199 1.89192 2.29936 0.836243 3.68944 0.836243ZM7.58245 1.19665C6.39195 1.19665 5.43993 2.08852 5.43993 3.2038C5.43993 4.31961 6.39187 5.21155 7.58245 5.21155C8.77304 5.21155 9.72497 4.31961 9.72497 3.2038C9.72497 2.08852 8.77296 1.19665 7.58245 1.19665Z" fill="#64748B" />
                    </svg>
                    <?php echo $courseStudents; ?> Students enrolled on this course
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                            <path d="M8.17139 0.702148L9.9675 6.23001H15.7798L11.0776 9.64642L12.8737 15.1743L8.17139 11.7579L3.4691 15.1743L5.26522 9.64642L0.562934 6.23001H6.37527L8.17139 0.702148Z" fill="#F3C643" />
                        </svg>
                        <b><?php echo $average_rating; ?></b> (<?php echo $countRating; ?> Reviews)
                    </span>
                </h4>
                <h4 class="a2n_cr-text a2n_cr-text2">
                    <img src="https://www.janets.org.uk/wp-content/uploads/2024/01/Clock.png" alt="clock" />
                    Last updated <?php the_modified_date(); ?>
                </h4>
            </div>
        </div>
    </div>
</div>
<!-- Course hero section end  -->


<?php
$roles = (array) $user->roles;

$notAllowedRoles = array('Subscriber', 'Student');

if (is_user_logged_in()) {
    if (!in_array($user->roles, $notAllowedRoles)) {
?>
        <section class="adminbar-23-janets">
            <div class="container">
                <div class="item-nav">
                    <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                        <div id="item-body">
                            <!-- Admin nav start -->
                            <?php bp_get_options_nav(); ?>
                            <?php
                            if (function_exists('bp_course_nav_menu'))
                                bp_course_nav_menu();
                            ?>
                            <?php do_action('bp_course_options_nav'); ?>
                            <!-- Admin nav end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
?>


<!-- course tab section start  -->
<div class="a2n_c-tab_section">
    <div class="container">
        <div class="row">
            <!-- tabs  -->
            <div class="col-lg-8 a2n_c-tab_container col-md-8 col-sm-8 col-xs-12">
                <div class="a2n_c-menu">
                    <ul>
                        <li>
                            <a class="a2n_switch a2n_active" href="#a2n_overview">Overview</a>
                        </li>
                        <li>
                            <a class="a2n_switch" href="#a2n_curriculum">Curriculum</a>
                        </li>
                        <li>
                            <a class="a2n_switch" href="#a2n_reviews">Reviews</a>
                        </li>
                        <li><a class="a2n_switch" href="#a2n_faq">FAQ</a></li>
                    </ul>
                </div>
                <div class="a2n-c_tab-contents">
                    <!-- menu 1  -->
                    <div id="a2n_overview" class="a2n_tab-box">
                        <?php the_content(); ?>
                    </div>
                    <!-- menu 2  -->
                    <div id="a2n_curriculum" class="a2n_tab-box">
                        <?php
                        do_action('wplms_after_course_description');
                        ?>
                    </div>
                    <!-- menu 3  -->
                    <div id="a2n_reviews" class="a2n_tab-box">
                        <?php
                        comments_template('/course-review.php', true);
                        ?>
                    </div>
                </div>
            </div>
            <!-- sticky sidebar  -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="a2n_c-sidebar a2n_sticky-top">
                    <div class="a2n_c-inner">
                        <!-- video part  -->
                        <a class="a2n_c-video" href="#">
                            <div class="video-content">
                                <?php bp_course_avatar(); ?>
                            </div>
                        </a>
                        <div class="a2n_c-contents">
                            <div class="a2n_price-details">
                                <h3 class="price_tag"><?php bp_course_credits(); ?></h3>
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <g clip-path="url(#clip0_6_7320)">
                                            <path d="M8.87224 2.0994L14.6576 7.8848C14.8891 8.11622 15.0369 8.43763 15.0369 8.79761C15.0369 9.15116 14.8955 9.47258 14.6576 9.70399L10.1579 14.2037C9.92647 14.4352 9.81539 14.4692 9.46184 14.4692C9.10829 14.4692 8.99426 14.3258 8.99426 14.3258C8.99426 14.3258 11.6845 11.8284 13.6226 9.89035C13.7399 9.77307 13.8649 9.62239 13.9673 9.4176C14.0127 9.27266 14.0529 9.18029 14.0697 9.04215C14.0935 8.84619 14.0409 8.68746 14.0083 8.54042C13.9717 8.37603 13.8154 8.15473 13.8154 8.15473C13.8154 8.15473 10.1513 4.29779 7.96587 2.21583C7.665 1.92921 7.06579 1.72656 7.06579 1.72656H7.96587C8.31942 1.72656 8.64083 1.86798 8.87224 2.0994Z" fill="#FF0000" />
                                            <path d="M2.95599 5.00903C2.70026 5.00903 2.455 4.90745 2.27417 4.72662C2.09335 4.54579 1.99176 4.30053 1.99176 4.0448C1.99176 3.78907 2.09335 3.54381 2.27417 3.36298C2.455 3.18216 2.70026 3.08057 2.95599 3.08057C3.21172 3.08057 3.45698 3.18216 3.63781 3.36298C3.81864 3.54381 3.92022 3.78907 3.92022 4.0448C3.92022 4.30053 3.81864 4.54579 3.63781 4.72662C3.45698 4.90745 3.21172 5.00903 2.95599 5.00903ZM13.1833 7.95316L7.39789 2.16776C7.16648 1.93634 6.84507 1.79492 6.49152 1.79492H1.99176C1.27822 1.79492 0.706112 2.36703 0.706112 3.08057V7.58033C0.706112 7.93388 0.847533 8.25529 1.08538 8.4867L6.86435 14.2721C7.1022 14.5035 7.42361 14.6514 7.77716 14.6514C8.13071 14.6514 8.45212 14.5035 8.68354 14.2721L13.1833 9.77235C13.4211 9.54093 13.5626 9.21952 13.5626 8.86597C13.5626 8.50599 13.4147 8.18458 13.1833 7.95316Z" fill="#FF0000" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_6_7320">
                                                <rect width="15.4277" height="15.4277" fill="white" transform="translate(0.895302 0.440918)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span><?php echo number_format($totalDiscount, 0, '.', '') . '%' ?> OFF</span>
                                </h3>
                            </div>
                            <div class="a2n_inner-btn">
                                <div class="a2n_take-course_btn">
                                    <?php
                                    if (function_exists('sa_membeship_button')) {
                                        $course_id = get_the_ID();
                                        sa_membeship_button($course_id);
                                    } else {
                                        the_course_button();
                                    }
                                    ?>
                                </div>
                                <div class="a2n_all-courses_btn">
                                    <a class="a2n-btn" href="<?php site_url(); ?>/checkout/?add-to-cart=393651"> ALL COURSES FOR £49 </a>
                                </div>
                            </div>
                            <div class="a2n-subtitle">
                                <img src="<?php echo get_theme_file_uri() . '/assets/img/Reboot.png' ?>" alt="moneyback" />
                                <span>14-Day Money-Back Guarantee</span>
                            </div>
                            <div class="a2n_cd-widget">
                                <ul>
                                    <li><span>Level</span> <span><?php
                                                                    if ($terms && !is_wp_error($terms)) {
                                                                        foreach ($terms as $term) {
                                                                    ?>
                                                    <a href="<?php echo home_url(); ?>/level/<?php echo $term->slug; ?>" rel="tag"><?php echo $term->name; ?></a>
                                            <?php
                                                                            break;
                                                                        }
                                                                    }
                                            ?></span></li>
                                    <li><span>Certificate</span> <span>Yes</span></li>
                                    <li><span>Units</span> <span><?php echo count($units); ?></span></li>
                                    <li><span>Quizzes</span> <span><?php echo $quiz_count; ?></span></li>
                                    <li>
                                        <span>Duration</span> <span><?php echo $courseDuration; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="a2n_inner-img">
                                <ul class="mha_scj_overview">
                                    <?php if (has_term('Regulated Courses', 'course-cat', $post)) { ?>
                                        <li class="cpd_stats focus">
                                            <img src="https://www.janets.org.uk/wp-content/uploads/2023/09/focus.png" alt="focus uk">
                                        </li>
                                    <?php } elseif (has_term('Dental Courses', 'course-cat', $post)) {
                                    ?>
                                        <li class="cpd_stats">
                                            <img class="AdaCerp" src="https://www.janets.org.uk/wp-content/uploads/2023/10/ADA-CERP-logo.png" alt="ADA">
                                        </li>
                                    <?php
                                    } else { ?>
                                        <li class="cpd_stats">
                                            <img src="https://www.janets.org.uk/wp-content/uploads/2023/02/CPD-Member-Logo-1.png" alt="cpd uk">
                                        </li>
                                    <?php } ?>

                                    <?php

                                    if (has_term('Quality Licence Scheme Endorsed', 'course-cat', $post)) { ?>
                                        <li class="cpd_stats">
                                            <img src="https://www.janets.org.uk/wp-content/uploads/2022/02/QLS_Logo_Colour-1-460x276-1.png" alt="qls">
                                        </li>
                                    <?php } else { ?>
                                        <li class="Support_stats">
                                            <img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Layer-2.png" alt="Tutor support">
                                            <p>Tutor Support</p>
                                        </li>
                                    <?php }
                                    ?>
                                    <li class="Online_stats">
                                        <img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Filled-outline.png" alt="fully online">
                                        <p>Fully Online</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- course tab section end  -->

<!-- Faq section start  -->
<div id="a2n_faq" class="a2n_faq-sec">
    <!-- a2n custom accordion start  -->
    <div id="a2n_faq" class="a2n_accordion-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="a2n-faq_title">
                        <h2>Frequently asked questions</h2>
                        <p>
                            Can’t find the anwser you’re looking for ? Reach out to customer
                            support team.
                        </p>
                    </div>

                    <?php
                    // Get the repeater field data
                    $faqs = get_field('faq');
                    // echo "<pre>";
                    // var_dump($faqs);
                    // echo "<>";
                    // Check if there are FAQs available
                    if ($faqs) { ?>
                        <div class="a2n-accordion__list">

                            <?php

                            // Loop through each FAQ
                            foreach ($faqs as $faq) {
                                // Output FAQ data
                                $question = $faq['faq_title']; // Assuming 'question' is the sub-field name
                                $answer = $faq['faq_content']; // Assuming 'answer' is the sub-field name
                            ?>
                                <!-- #1 single accordion  -->
                                <div class="a2n-accordion a2n-accordion__active">
                                    <div class="a2n-accordion_head">
                                        <span class="a2n-accordion__title">
                                            <?php echo $question; ?>
                                        </span>
                                        <div class="a2n_icon_box">
                                            <span class="a2n-arrow"></span>
                                        </div>
                                    </div>
                                    <div class="a2n-accordion__content-wrap">
                                        <div class="a2n-accordion__content">
                                            <p class="a2n-acc_item">
                                                <?php echo $answer; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }


                            ?>


                        </div>
                    <?php
                    } else { ?>
                        <div class="a2n-accordion__list">
                            <!-- #1 single accordion  -->
                            <div class="a2n-accordion a2n-accordion__active">
                                <div class="a2n-accordion_head">
                                    <span class="a2n-accordion__title">
                                        Are there any prerequisites for taking the course?
                                    </span>
                                    <div class="a2n_icon_box">
                                        <span class="a2n-arrow"></span>
                                    </div>
                                </div>
                                <div class="a2n-accordion__content-wrap">
                                    <div class="a2n-accordion__content">
                                        <p class="a2n-acc_item">
                                            There are no specific prerequisites for this course, nor
                                            are there any formal entry requirements. All you need is
                                            an internet connection, a good understanding of English
                                            and a passion for learning for this course.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- #2 single accordion  -->
                            <div class="a2n-accordion">
                                <div class="a2n-accordion_head">
                                    <span class="a2n-accordion__title">
                                        Can I access the course at any time, or is there a set
                                        schedule?
                                    </span>
                                    <div class="a2n_icon_box">
                                        <span class="a2n-arrow"></span>
                                    </div>
                                </div>
                                <div class="a2n-accordion__content-wrap">
                                    <div class="a2n-accordion__content">
                                        <p class="a2n-acc_item">
                                            You have the flexibility to access the course at any time
                                            that suits your schedule. Our courses are self-paced,
                                            allowing you to study at your own pace and convenience.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- #3 single accordion  -->
                            <div class="a2n-accordion">
                                <div class="a2n-accordion_head">
                                    <span class="a2n-accordion__title">
                                        How long will I have access to the course?
                                    </span>
                                    <div class="a2n_icon_box">
                                        <span class="a2n-arrow"></span>
                                    </div>
                                </div>
                                <div class="a2n-accordion__content-wrap">
                                    <div class="a2n-accordion__content">
                                        <p class="a2n-acc_item">
                                            For this course, you will have access to the course
                                            materials for 1 year only. This means you can review the
                                            content as often as you like within the year, even after
                                            you've completed the course. However, if you buy Lifetime
                                            Access for the course, you will be able to access the
                                            course for a lifetime.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- #4 single accordion  -->
                            <div class="a2n-accordion">
                                <div class="a2n-accordion_head">
                                    <span class="a2n-accordion__title">
                                        Is there a certificate of completion provided after
                                        completing the course?
                                    </span>
                                    <div class="a2n_icon_box">
                                        <span class="a2n-arrow"></span>
                                    </div>
                                </div>
                                <div class="a2n-accordion__content-wrap">
                                    <div class="a2n-accordion__content">
                                        <p class="a2n-acc_item">
                                            Yes, upon successfully completing the course, you will
                                            receive a certificate of completion. This certificate can
                                            be a valuable addition to your professional portfolio and
                                            can be shared on your various social networks.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- #5 single accordion  -->
                            <div class="a2n-accordion">
                                <div class="a2n-accordion_head">
                                    <span class="a2n-accordion__title">
                                        Can I switch courses or get a refund if I'm not satisfied
                                        with the course?
                                    </span>
                                    <div class="a2n_icon_box">
                                        <span class="a2n-arrow"></span>
                                    </div>
                                </div>
                                <div class="a2n-accordion__content-wrap">
                                    <div class="a2n-accordion__content">
                                        <p class="a2n-acc_item">
                                            We want you to have a positive learning experience. If
                                            you're not satisfied with the course, you can request a
                                            course transfer or refund within 14 days of the initial
                                            purchase.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- #6 single accordion  -->
                            <div class="a2n-accordion">
                                <div class="a2n-accordion_head">
                                    <span class="a2n-accordion__title">
                                        How do I track my progress in the course?
                                    </span>
                                    <div class="a2n_icon_box">
                                        <span class="a2n-arrow"></span>
                                    </div>
                                </div>
                                <div class="a2n-accordion__content-wrap">
                                    <div class="a2n-accordion__content">
                                        <p class="a2n-acc_item">
                                            Our platform provides tracking tools and progress
                                            indicators for each course. You can monitor your progress,
                                            completed lessons, and assessments through your learner
                                            dashboard for the course.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- #7 single accordion  -->
                            <div class="a2n-accordion">
                                <div class="a2n-accordion_head">
                                    <span class="a2n-accordion__title">
                                        What if I have technical issues or difficulties with the
                                        course?
                                    </span>
                                    <div class="a2n_icon_box">
                                        <span class="a2n-arrow"></span>
                                    </div>
                                </div>
                                <div class="a2n-accordion__content-wrap">
                                    <div class="a2n-accordion__content">
                                        <p class="a2n-acc_item">
                                            If you encounter technical issues or content-related
                                            difficulties with the course, our support team is
                                            available to assist you. You can reach out to them for
                                            prompt resolution.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- a2n custom accordion end  -->

</div>
<!-- Faq section end  -->