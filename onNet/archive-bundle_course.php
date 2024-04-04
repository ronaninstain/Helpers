<?php get_header(vibe_get_header()); ?>
<section style="background-image: url(<?php echo  get_stylesheet_directory_uri() . '/assets/img/bundleCourses/BG_hero.webp' ?>)" class="srs_hero_sec_bundle">
    <div class="srs_content_pr">
        <h4 class="srs_sub_heading">FALL IN LOVE WITH LEARNING</h4>
        <h4 class="srs_heading">Bundle Courses</h4>
        <h4 class="srs_des">Start learning with us and achieve higher value certificates. Start learning now, this is your perfect place to start.</h4>
    </div>
</section>
<section class="srs_bundle_course_sec">
    <div class="srs_cards_parent">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
        ?>

                <?php
                $bundleID = get_the_ID();
                $bundleImg = get_the_post_thumbnail_url($bundleID, 'medium');
                $bundleNumber = get_field("bundle_items_quantity_text");
                $ProductID = get_field("product_id");
                $regular_price = get_post_meta($ProductID, '_regular_price', true);
                $sale_price = get_post_meta($ProductID, '_sale_price', true);
                $current_currency = get_woocommerce_currency_symbol();
                $bundleTags = get_field('bundle_tags');
                ?>
                <div class="srs_card_pr">
                    <div class="srs_img_wrapper">
                        <?php
                        if (has_post_thumbnail()) {
                        ?>
                            <img src="<?php echo $bundleImg; ?>" alt="courseimg">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo  get_stylesheet_directory_uri() . '/assets/img/bundleCourses/dummyimg.png' ?>" alt="courseImg">
                        <?php
                        }
                        ?>
                        <div class="srs_img_under">
                            <div class="srs_sev_course_wraper">
                                <?php if ($bundleNumber) {
                                ?>
                                    <p>
                                        <?php echo $bundleNumber; ?>
                                    </p>
                                <?php
                                } ?>

                            </div>
                            <div class="srs_star_wrapper">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.17237 10.97L11.0255 13.418L10.003 8.80417L13.4072 5.69987L8.92436 5.29952L7.17237 0.948242L5.42037 5.29952L0.9375 5.69987L4.34174 8.80417L3.31922 13.418L7.17237 10.97Z" fill="#FFB800" />
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.17237 10.97L11.0255 13.418L10.003 8.80417L13.4072 5.69987L8.92436 5.29952L7.17237 0.948242L5.42037 5.29952L0.9375 5.69987L4.34174 8.80417L3.31922 13.418L7.17237 10.97Z" fill="#FFB800" />
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.17237 10.97L11.0255 13.418L10.003 8.80417L13.4072 5.69987L8.92436 5.29952L7.17237 0.948242L5.42037 5.29952L0.9375 5.69987L4.34174 8.80417L3.31922 13.418L7.17237 10.97Z" fill="#FFB800" />
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.17237 10.97L11.0255 13.418L10.003 8.80417L13.4072 5.69987L8.92436 5.29952L7.17237 0.948242L5.42037 5.29952L0.9375 5.69987L4.34174 8.80417L3.31922 13.418L7.17237 10.97Z" fill="#FFB800" />
                                </svg>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.17237 10.97L11.0255 13.418L10.003 8.80417L13.4072 5.69987L8.92436 5.29952L7.17237 0.948242L5.42037 5.29952L0.9375 5.69987L4.34174 8.80417L3.31922 13.418L7.17237 10.97Z" fill="#FFB800" />
                                </svg>
                            </div>
                        </div>

                    </div>
                    <div class="srs_content_wrapper">
                        <h4 class="srs_title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                        <?php
                        if ($bundleTags) {
                            $tagsArray = explode(', ', $bundleTags);
                        ?>

                            <ul class="srs_tag">
                                <?php foreach ($tagsArray as $tag) : ?>
                                    <li>
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/bundleCourses/charm_tick.svg'; ?>" alt="icon" />
                                        <?php echo esc_html($tag); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        <?php
                        }
                        ?>
                    </div>
                    <div class="srs_price_wrapper">
                        <?php
                        if ($ProductID) {
                        ?>
                            <div class="srs_price">
                                <?php
                                if ($regular_price) {
                                ?>
                                    <del>
                                        <?php echo $current_currency . $regular_price; ?>
                                    </del>
                                <?php
                                }
                                if ($sale_price) {
                                ?>
                                    <p>
                                        <?php echo $current_currency . $sale_price; ?>
                                    </p>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="srs_btn">
                            <a href="<?php echo get_site_url();  ?>/cart/?add-to-cart=<?php echo $ProductID; ?>">
                                Add To Cart
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            the_posts_pagination();
        else :
            ?>
            <h2>no bundles found!</h2>
        <?php
        endif;
        ?>
    </div>
</section>


<?php get_footer(vibe_get_footer()); ?>