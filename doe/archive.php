<?php
if (!defined('ABSPATH')) exit;
get_header(vibe_get_header());
?>

<!-- Blog hero area start  -->
<div style="background: url(<?php echo get_theme_file_uri() . '/assets/imgs/blogs/blog-banner.webp' ?>);" class="a2n_blog_area">
    <div class="a2n_section_container">
        <div class="hero_content">
            <h2><?php
                if (is_month()) {
                    single_month_title(' ');
                } elseif (is_year()) {
                    echo get_the_time('Y');
                } else if (is_category()) {
                    echo single_cat_title();
                } else if (is_tag()) {
                    single_tag_title();
                } else {
                    post_type_archive_title();
                }
                ?></h2>
            <h6>
                Elevate Your Skills, Ignite Your Career: Discover John Academy's
                Learning Universe
            </h6>
            <form class="a2n_search_form" id="a2n_blog_search" action="">
                <input type="hidden" name="post_type" value="post">
                <input type="text" class="a2n_search" name="s" placeholder="Search the blog....." value="<?php echo get_search_query(); ?>" />
                <button type="submit" class="a2n_submit">Search</button>
            </form>
            <?php
            //get_search_form(); 
            ?>
        </div>
        <div class="a2n-blog__container">
            <div class="blog_tip">
                <h3>Blog of the Month</h3>
            </div>
            <?php
            $popularArg = array(
                'post_type' => 'post',
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                "posts_per_page" => 1
            );
            $popularPost = new WP_Query($popularArg);
            while ($popularPost->have_posts()) :  $popularPost->the_post();
            ?>
                <div class="a2n-inner__items">
                    <div class="a2n_item">
                        <h2><?php the_title(); ?></h2>
                        <div class="inner_br">
                            <?php
                            // Display categories for the current post
                            $categories = get_the_category();
                            if ($categories) {
                                foreach ($categories as $category) {
                                    echo '<span>' . esc_html($category->name) . '</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="a2n_item">
                        <a class="a2n_blog_btn" href="<?php the_permalink(); ?>">Read More</a>
                    </div>
                </div>
                <p>
                    <?php the_excerpt(); ?>
                </p>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>

        </div>
    </div>
</div>
<!-- Blog hero area end  -->

<!-- Blog Card area start  -->
<div class="a2n_blog-card_area">
    <div class="a2n_section_container">
        <!-- blog card container  -->
        <div class="a2n_blog-card_container">
            <?php

            if (have_posts()) : while (have_posts()) : the_post();
                    $blogID = get_the_ID();
                    $blogImage = get_the_post_thumbnail_url($blogID, 'medium');
            ?>
                    <div class="a2n_blog-card">
                        <div class="blog_start">
                            <img src="<?php echo $blogImage; ?>" alt="blog" />
                        </div>
                        <div class="b_card-contents">
                            <div class="b_card-title">
                                <h2>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </div>
                            <div class="inner_br b_inner_br">
                                <?php
                                // Display categories for the current post
                                $categories = get_the_category();
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        echo '<span>' . esc_html($category->name) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            ?>
        </div>
        <!-- blog paginatitions  -->
        <div class="a2n_paginations" id="a2n_blog-paginations">
            <?php pagination(); ?>
        </div>
    </div>
</div>
<!-- Blog Card area end  -->

<?php
get_footer(vibe_get_footer());
?>