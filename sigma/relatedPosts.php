<section class="relatedBlogs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="relatedHeading">
                    Related Articles
                </h2>
                <?php
                $currentID = get_queried_object_id();
                $current_post_terms = get_the_terms($currentID, 'category'); // Change 'CAT' to 'category'
                
                $current_post_term_ids = wp_list_pluck($current_post_terms, 'term_id'); // get term IDs
                
                $recent_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post__not_in' => array($currentID),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $current_post_term_ids,
                        ),
                    ),
                );
                $recent_posts = new WP_Query($recent_args);

                if ($recent_posts->have_posts()):
                    while ($recent_posts->have_posts()):
                        $recent_posts->the_post();
                        ?>
                        <div class="srs_blog_card_pr">
                            <div class="srs_img_wrapper">
                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="srs_blog_content">
                                <div class="srs_blog_categories">
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) {
                                        $count = 0;
                                        $total_categories = count($categories);
                                        foreach ($categories as $category) {
                                            echo '<a href="' . get_category_link($category->term_id) . '"  class="srs_cat_text" title="' . esc_attr(sprintf(__("%s", "vibe"), $category->name)) . '">' . $category->cat_name . '</a>';
                                            $count++;
                                            if ($count >= 2) {
                                                break;
                                            } elseif ($count < $total_categories && $count < 2) {
                                                echo ' ,';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <h4 class="srs_title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                                <div class="srs_details">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a class="srs_btn" href="<?php the_permalink(); ?>">
                                    Read More
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0.449219 7.1543H12.4492M12.4492 7.1543L6.94922 0.654297M12.4492 7.1543L6.94922 13.6543"
                                            stroke="#151424" stroke-width="1.5" />
                                    </svg>

                                </a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else:
                    echo '<p>No related articles found.</p>'; // Fallback message
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>