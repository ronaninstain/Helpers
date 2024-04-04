<?php
if (!defined('ABSPATH')) exit;
//do_action('wplms_single_course_content_end');

?>
</div>
<div class="col-md-3">
	<div class="widget pricing scj_pricing_hide" id="course-pricing">
		<?php //the_course_button(); 
		?>
		<?php the_course_details(); ?>
	</div>
	<div class="students_undertaking">
		<?php
		$students_undertaking = array();
		$students_undertaking = bp_course_get_students_undertaking();
		$students = get_post_meta(get_the_ID(), 'vibe_students', true);

		echo '<strong>' . $students . __(' STUDENTS ENROLLED', 'vibe') . '</strong>';

		echo '<ul>';
		foreach ($students_undertaking as $student) {
			echo '<li>' . get_avatar($student) . '</li>';
		}
		echo '</ul>';
		?>
	</div>
	<?php
	$sidebar = apply_filters('wplms_sidebar', 'coursesidebar', get_the_ID());
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) : ?>
	<?php endif; ?>
</div>
</div><!-- .row -->
<div class="row">
	<div class="related_courses">
		<h2 class="scj_related_title"><?php _e('Related Courses', 'wplms_modern'); ?></h2>
		<?php
		global $post;
		$pid = $post->ID;
		$category_term = get_the_terms($pid, 'course-cat');
		$terms_list =  wp_list_pluck($category_term, 'slug');

		$related_args = array(
			'post_type' => 'course',
			'posts_per_page' => 3,
			'post_status' => 'publish',
			'post__not_in'      => array($pid),
			'orderby'   => 'meta_value_num',
			'order' => 'DESC',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'course-cat',
					'field' => 'slug',
					'terms' => $terms_list
				)
			),
			'meta_query' => array(
				array(
					'key'     => 'vibe_students',
				),
				array(
					'key' => 'vibe_product',
					'value'   => array(''),
					'compare' => 'NOT IN'
				)
			)
		);

		$related = new WP_Query($related_args);

		if ($related->have_posts()) {
			echo '<div class="row">';
			while ($related->have_posts()) : $related->the_post(); ?>

				<div class="col-md-4">
					<div class="mha_courseBox">
						<?php
						if (has_post_thumbnail()) {
							the_post_thumbnail('', array('class' => 'ar-crs-img'));
						} else {
							echo '<img src="' . get_stylesheet_directory_uri() . '/assets/img/428x320.jpg" class="ar-crs-img">';
						}
						?>
						<div>
							<div class="mha_courseInfo">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<h4><?php
									bp_course_credits();
									?></h4>
								<div class="mha_courseMeta">

									<?php $average_rating = get_post_meta(get_the_ID(), 'average_rating', true); ?>
									<div class="mha_rating_content">
										<div class="mha_rating">
											<div class="mha_rating-upper" style="width:<?php echo $average_rating ? 20 * $average_rating : 0; ?>%">
												<span>★</span>
												<span>★</span>
												<span>★</span>
												<span>★</span>
												<span>★</span>
											</div>

										</div>
									</div>

									<div class="d-flex mha_students">



										<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/user.svg' ?>" alt="user">
										<span><?php echo get_post_meta(get_the_ID(), 'vibe_students', true); ?> Students</span>
									</div>
								</div>
							</div>

							<div class="mha_courseBtn">
								<a href="<?php the_permalink(); ?>" class="btn_info">Course Info</a>
								<?php
								$product_ID = get_post_meta(get_the_ID(), 'vibe_product', true);
								?>
								<a href="<?php echo home_url('/cart'); ?>/?add-to-cart=<?php echo $product_ID; ?>" class="btn_info">Add to Cart</a>
							</div>
						</div>
					</div>
				</div>

		<?php
			endwhile;
			echo '</div>';
			wp_reset_query();
		} ?>

	</div>
</div>
</div><!-- .container -->
</div><!-- #buddypress -->
</section>
<section class="mha_scj_attach" id="Benefits">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="mha_scj_box">
					<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003891.png" alt="">
					<h2>Certifications</h2>
					<p>Get accredited certificates</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="mha_scj_box">
					<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003908.png" alt="">
					<h2>New skills</h2>
					<p>Add skills to your CV</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="mha_scj_box">
					<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003918.png" alt="">
					<h2>Exams</h2>
					<p>Test your skills</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="mha_scj_box">
					<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003927-1.png" alt="">
					<h2>Dedicated support</h2>
					<p>For any questions</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="mha_scj_box">
					<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003912.png" alt="">
					<h2>Set your own speed</h2>
					<p>No time limitations</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="mha_scj_box">
					<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003909.png" alt="">
					<h2>Money back guarantee</h2>
					<p>Refund upon learner's dissatisfaction</p>
				</div>
			</div>
		</div>
	</div>
</section>


<script>
	<?php $title = get_the_title(); ?>

	// function changeTitle() {
	// 	document.title = "<?php echo $title; ?>";
	// }
	// changeTitle();
</script>