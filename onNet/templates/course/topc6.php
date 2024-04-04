<?php
?>
<section class="sh-23-single">
	<div class="container">
		<div class="row for-col-order-change-mbl-sh-23-single">
			<div class="col-md-8 reversed-on-mbl col-sm-8">
				<div class="sh-top-23-content">
					<div class="tpilot">
						<a href="#"><img src="<?php echo get_theme_file_uri() . '/assets/img/ukhftrustpilot.png' ?>" alt="tpilot"></a>
					</div>
					<h1 class="top-course-title"><?php bp_course_name(); ?></h1>
					<div class="top-course-exerpt"><?php the_excerpt(); ?></div>
					<div class="row for-p-adjust-sh-23-inner-row">
						<?php
						$image1 = get_field('featured_image_1_');
						$image2 = get_field('featured_image_2');
						$image3 = get_field('featured_image_3');
						?>
						<div class="<?php echo (!empty($image1)) ? 'col-md-9 col-xs-9' : 'col-md-12 single-course-img'; ?>">
							<div class="course-main-avtar">
								<?php if (!empty(get_field('video_url'))) : ?>
									<?php the_field('video_url'); ?>
								<?php else : ?>
									<?php bp_course_avatar(); ?>
								<?php endif; ?>
							</div>
						</div>
						<?php
						$image1 = get_field('featured_image_1_');
						$image2 = get_field('featured_image_2');
						$image3 = get_field('featured_image_3');
						if ($image1 || $image2 || $image3) {
						?>
							<div class="col-md-3 col-xs-3">
								<div class="features-images">
									<img src="<?php echo esc_url($image1); ?>" alt="<?php echo esc_attr($image1['alt']); ?>" />
									<img src="<?php echo esc_url($image2); ?>" alt="<?php echo esc_attr($image2['alt']); ?>" />
									<img src="<?php echo esc_url($image3); ?>" alt="<?php echo esc_attr($image3['alt']); ?>" />
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 sticky-column">
				<!-- add "sh-fixed-23-single" for float and uncomment the below script -->
				<div class="the-Tab-functional-side">
					<div class="tab-content side-23-sh">
						<div id="menu01" class="tab-pane fade in active">
							<?php
							$courseID = get_the_ID();
							$userID = get_current_user_id();
							$userRemainingTime = bp_course_get_user_expiry_time($userID, $courseID);
							$now = time();
							$timeDifference = $userRemainingTime - $now;

							$dateInterval = date_diff(date_create(), date_create("+{$timeDifference} seconds"));
							$remainingTimeFormatted = "";
							$terms = get_the_terms($courseID, 'level');
							$courseStudents = get_post_meta($courseID, 'vibe_students', true);
							$units = bp_course_get_curriculum_units($courseID);
							$duration = $total_duration = 0;

							foreach ($units as $unit) {

								$duration = get_post_meta($unit, 'vibe_duration', true);

								if (get_post_type($unit) == 'unit') {

									$unit_duration_parameter = apply_filters('vibe_unit_duration_parameter', 60, $unit);
								} elseif (get_post_type($unit) == 'quiz') {

									$unit_duration_parameter = apply_filters('vibe_quiz_duration_parameter', 60, $unit);
								}

								$total_duration =  $total_duration + $duration * $unit_duration_parameter;
							}

							$courseDuration =  tofriendlytime(($total_duration));

							$product_id = get_post_meta($courseID, 'vibe_product', true);
							$price = get_post_meta($product_id, '_regular_price', true);
							$sale = get_post_meta($product_id, '_sale_price', true);
							$totalDiscount = (100 - ((100 * $sale) / $price));
							?>
							<h1 class="side-course-title"><?php bp_course_name(); ?></h1>
							<?php echo bp_course_credits(); ?>
							<div class="theDiscountString">
								<p>Exclusive Deal! <u><?php echo number_format($totalDiscount, 0, '.', '') . '%' ?> Off, Today Only!</u></p>
							</div>
							<?php
							if (function_exists('sa_membeship_button')) {
								$course_id = get_the_ID();
								sa_membeship_button($course_id);
							} else {
								the_course_button();
							}
							?>
							<div class="course-feature-sh-23">

								<?php
								if (has_term('Regulated Qualification', 'course-cat')) {
								?>
									<img src="<?php echo get_theme_file_uri() . '/assets/img/Logo - Focus Award.png' ?>" alt="focusawards">
								<?php
								} else {
								?>
									<img src="<?php echo get_theme_file_uri() . '/assets/img/cpdy.png' ?>" alt="cpdy">
									<img src="<?php echo get_theme_file_uri() . '/assets/img/cpdp.png' ?>" alt="cpdp">
									<img src="<?php echo get_theme_file_uri() . '/assets/img/qlcnew.png' ?>" alt="Qlc">
								<?php
								}
								?>
							</div>
							<ul class="course-contexts">
								<li><img src="<?php echo get_theme_file_uri() . '/assets/img/calendarNEW.svg' ?>" alt="newClaender">
									<?php if (bp_course_is_member($courseID, $userID)) {
										if ($dateInterval->y > 0) {
											$remainingTimeFormatted .= $dateInterval->y . " year";
											if ($dateInterval->y > 1) {
												$remainingTimeFormatted .= "s";
											}
										} elseif ($dateInterval->m > 0) {
											$remainingTimeFormatted .= $dateInterval->m . " month";
											if ($dateInterval->m > 1) {
												$remainingTimeFormatted .= "s";
											}
										} elseif ($dateInterval->d > 0) {
											$remainingTimeFormatted .= $dateInterval->d . " day";
											if ($dateInterval->d > 1) {
												$remainingTimeFormatted .= "s";
											}
										} else {
											$remainingTimeFormatted .= "Less than a day";
										}
									} else {
										$remainingTimeFormatted = "1 Year Access";
									}

									echo $remainingTimeFormatted; ?>
								</li>
								<li><img src="<?php echo get_theme_file_uri() . '/assets/img/chartNEW.svg' ?>" alt="level">
									<?php
									if ($terms && !is_wp_error($terms)) {
										foreach ($terms as $term) {
									?>
											<a href="<?php echo home_url(); ?>/level/<?php echo $term->slug; ?>" rel="tag"><?php echo $term->name; ?></a>
									<?php
											break;
										}
									}
									?>
								</li>
								<li><img src="<?php echo get_theme_file_uri() . '/assets/img/teacherNEW.svg' ?>" alt="students">
									<?php echo $courseStudents . ' Students'; ?>
								</li>
								<?php
								if (!has_term('Career Bundle', 'course-cat')) {
								?>
									<li>
										<img src="<?php echo get_theme_file_uri() . '/assets/img/timeNEW.svg' ?>" alt="course_duration">
										<?php echo $courseDuration; ?>
									</li>
								<?php
								} else { ?>
									<li>
										Certificates Included
									</li>
								<?php
								}
								?>
							</ul>
							<div class="buyMore">
								<p>Buy 1 or more <a href="<?php echo site_url() ?>/team-training">contact sale</a></p>
							</div>
							<div class="gift-course-btn">
								<?php
								the_course_details();
								?>
							</div>
							<div class="mback">
								<span><img src="<?php echo get_theme_file_uri() . '/assets/img/moneybc.svg' ?>" alt="mback">14-Day Money-Back Guarantee</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
<section class="sh-double-colored-23">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<div class="sh-middle-23-content">
					<div class="the-Tab-functional-middle">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu0">About</a></li>
							<li><a data-toggle="tab" href="#menu1">Curriculum</a></li>
							<li><a data-toggle="tab" href="#menu2">Review</a></li>
						</ul>

						<div class="tab-content">
							<div id="menu0" class="tab-pane fade in active">
								<?php the_content(); ?>
							</div>
							<div id="menu1" class="tab-pane fade">
								<div class="for-overwriting-the-css-c-crriculmn">
									<?php
									do_action('wplms_after_course_description');
									?>
								</div>
							</div>
							<div id="menu2" class="tab-pane fade">
								<div class="for-overwriting-the-css-c-review">
									<?php
									comments_template('/course-review.php', true);
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="frsideoffer">
					<?php
					$sidebar = apply_filters('wplms_sidebar', 'coursesidebar', get_the_ID());
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) : ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="whatTheCourseHolds">
	<?php echo do_shortcode('[elementor-template id="478781"]'); ?>
</section>
<section class="course-single-bottom-23" id="course-single-bottom-23">
	<div class="container">
		<div class="row">
			<div class="related-course-23">
				<h4 class="rel-heading-sh-23">Related Courses</h4>
				<div class="container">
					<?php echo do_shortcode('[courseCards]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$user = wp_get_current_user();
$notAllowedRoles = array('Subscriber', 'Student');
if (is_user_logged_in()) {
	if (!array_intersect($notAllowedRoles)) {
?>
		<section class="adminbar-23-study-hub">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="item-nav">
							<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
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
			</div>
		</section>
<?php
	}
}
?>
<!-- <script>
	// Step 1: Identify the div elements
	const courseSingleBottom = document.querySelector('.course-single-bottom-23');
	const tabFunctionalSide = document.querySelector('.the-Tab-functional-side');

	// Step 2: Add a scroll event listener to the window
	window.addEventListener('scroll', () => {
		// Step 3: Get the scroll position
		const scrollPosition = window.scrollY;

		// Step 4: Get the position of the courseSingleBottom div
		// Step 4: Get the offsetTop of the courseSingleBottom div
		const coursePosition = courseSingleBottom.offsetTop - 600;

		// Step 5: Check if scroll position is below the courseSingleBottom div
		if (scrollPosition > coursePosition) {
			tabFunctionalSide.style.display = 'none';
		} else {
			tabFunctionalSide.style.display = 'block'; // You can use 'initial' if that's the default display value
		}
	});

	const middleContent = document.querySelector('.sh-middle-23-content');

	let isScrollingDown = false;

	// Step 2: Add a scroll event listener to the window
	window.addEventListener('scroll', () => {
		// Step 3: Get the scroll position
		const scrollPosition = window.scrollY;

		// Step 4: Get the position of the middleContent element
		const middleContentPosition = middleContent.offsetTop;

		// Check if scrolling down
		if (scrollPosition > middleContentPosition) {
			if (!isScrollingDown) {
				isScrollingDown = true;
				tabFunctionalSide.classList.add('sh-fixed-23-single-mr'); // Add the class when scrolling down
			}
		} else {
			if (isScrollingDown) {
				isScrollingDown = false;
				tabFunctionalSide.classList.remove('sh-fixed-23-single-mr'); // Remove the class when scrolling up
			}
		}
	});
</script> -->

<?php
?>