<?php
$current_user = wp_get_current_user();
if (is_user_logged_in()) {
	$user_email = $current_user->user_email;
	$allowed_email = 'shoivehossain@staffasia.org';
	$allowed_email2 = 'rezwanahmad@staffasia.org';
	$allowed_email3 = 'sakib@staffasia.org';
	if ($user_email === $allowed_email || $user_email === $allowed_email2 || $user_email === $allowed_email3) {
?>
		<?php
		$courseID = get_the_ID();
		$courseStudents = get_post_meta($courseID, 'vibe_students', true);
		$units = count(bp_course_get_curriculum_units($courseID));
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

		$curriculums = bp_course_get_curriculum($courseID);
		$average_rating = get_post_meta($courseID, 'average_rating', true);
		$countRating = get_post_meta($courseID, 'rating_count', true);
		$product_ID = get_post_meta($courseID, 'vibe_product', true);
		$regular_price = get_post_meta($product_ID, '_regular_price', true);
		$sale_price = get_post_meta($product_ID, '_sale_price', true);
		$current_currency = get_woocommerce_currency_symbol();

		function get_number_of_assignments($courseID)
		{
			$assignmentCount = 0;

			$course_curriculum = bp_course_get_curriculum($courseID);

			if (!empty($course_curriculum)) {
				foreach ($course_curriculum as $unit_id) {
					if (is_numeric($unit_id) && get_post_type($unit_id) == 'unit') {
						$unitTitle = get_the_title($unit_id);
						if (strpos(strtolower($unitTitle), 'assignment') !== false) {
							$assignmentCount++;
						}
					}
				}
			}

			return $assignmentCount > 0 ? $assignmentCount : 'No assignments';
		}

		// Example usage:
		$assignment_count = get_number_of_assignments($courseID);


		$taxonomy = 'course-cat';
		$terms = wp_get_post_terms($courseID, $taxonomy, array('fields' => 'all'));
		$enable_instructor = apply_filters('wplms_display_instructor', true, $courseID);
		?>
		<div class="r-koc-4-single-course-h">
			<div class="header-course-details">
				<div class="image-title">
					<div class="image">
						<?php bp_course_avatar(); ?>
					</div>
					<div class="title-info">
						<h1 class="title"><?php bp_course_name(); ?></h1>
						<div class="reviews">
							<div class="ks-star-rating">
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
							</div>
							<p>( <?php echo $countRating; ?> Reviews )</p>
						</div>
						<div class="course-detail-category">
							<div class="course-detail">
								<div class="icon">
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/clock.webp' ?>" alt="clock" />
								</div>
								<p><?php echo $courseDuration; ?></p>
							</div>
							<div class="course-detail">
								<div class="icon">
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/book.webp' ?>" alt="book" />
								</div>
								<p><?php echo $units; ?> Curriculum</p>
							</div>
							<div class="course-detail">
								<div class="icon">
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/man.webp' ?>" alt="man" />
								</div>
								<p><?php echo $courseStudents; ?> Students</p>
							</div>
							<div class="course-detail">
								<div class="icon">
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/desktop.webp' ?>" alt="desktop" />
								</div>
								<ul>
									<?php
									foreach (array_slice($terms, 0, 1) as $term_single) {
									?>
										<li><a href="<?php echo esc_url(get_term_link($term_single)); ?>"><?php echo esc_html($term_single->name); ?></a></li>
									<?php
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="price-button">
					<?php if ($sale_price) {
					?>
						<p><del><?php echo $current_currency . $sale_price ?></del> <?php echo $current_currency . $regular_price ?></p>
					<?php
					} elseif ($regular_price) {
					?>
						<p><?php echo $current_currency . $regular_price ?></p>
					<?php
					} else {
					?>
						<p>Free</p>
					<?php
					}
					?>
					<a class="button-cart" href="<?php echo get_site_url();  ?>/cart/?add-to-cart=<?php echo $product_ID; ?>">Add To Cart</a>
				</div>
			</div>

			<div class="content-part">
				<div class="tab-sec">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab1"><i class="fas fa-book"></i> Curriculum</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab2"><i class="fab fa-docker"></i> About</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab3"><i class="fas fa-user-circle"></i> Members</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab4"><i class="fas fa-id-card"></i> Instructors</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab5"><i class="far fa-newspaper"></i> News</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab6"><i class="fas fa-star"></i> Reviews</a>
									</li>
								</ul>
							</div>
							<div class="col-md-12">
								<div class="tab-content">
									<div id="tab1" class="tab-pane fade in active">
										<?php
										function createMultidimensionalArray()
										{

											$curriculums = bp_course_get_curriculum(get_the_ID());
											$resultArray = array();
											$currentParent = null;

											foreach ($curriculums as $item) {
												if (get_post_type($item) != 'unit') {
													$currentParent = $item;
													$resultArray[$currentParent] = array();
												} elseif ($currentParent !== null) {
													$resultArray[$currentParent][] = $item;
												}
											}
											return $resultArray;
										}

										// Example usage
										$multidimensionalArray = createMultidimensionalArray();
										$id = 1;
										foreach ($multidimensionalArray as $key => $item) {
											// var_dump($item);
											// var_dump($key);

											if (!is_int($key)) {
										?>
												<div class="panel-group" id="accordion"> <!-- Start Div 1 -->
													<div class="panel panel-default"> <!-- Start Div 2 -->

														<div class="panel-heading">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id; ?>" aria-expanded="<?php echo $position = ($id == 1) ? "true" : "false"; ?>" class="<?php echo $position = ($id == 1) ? "" : "collapsed"; ?>">

																<h4 class="panel-title">
																	<?php
																	if (count($multidimensionalArray) > 1) {
																		//echo get_the_title($item[0]);
																		echo $key;
																	} else {
																		bp_course_name();
																	}
																	?>
																</h4>
															</a>
														</div>
													<?php
												}

													?>
													<div id="collapse<?php echo $id; ?>" class="panel-collapse <?php echo $position = ($id == 1) ? "collapse in" : "collapse"; ?>" aria-expanded="<?php echo $position = ($id == 1) ? "true" : "false"; ?>">


														<div class="panel-body">
															<ul>
																<?php
																foreach ($item as $i) { ?>
																	<li>
																		<div class="videoTitle">
																			<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/video.svg' ?>" alt="video">
																			<?php echo get_the_title($i); ?>
																		</div>
																		<div class="videoDuration">
																			<?php
																			$curriculumnDuration = get_post_meta($i, 'vibe_duration', true);
																			if (!empty($curriculumnDuration)) {
																				$seconds = $curriculumnDuration * 60;
																				$datetime = new DateTime("@$seconds");
																				$timeFormat = $datetime->format('H:i:s');
																				echo $timeFormat; // Output: 02:15:00
																			}
																			?>
																		</div>
																	</li>
																<?php
																}
																?>

															</ul>
														</div>
													</div>

													<?php

													if (!is_int($key)) {
													?>
													</div><!-- Closing DIV 1 -->
												</div><!-- Closing DIV 2 -->
										<?php
													}
													$id++;
												}
										?>
									</div>
									<div id="tab2" class="tab-pane fade">
										<h3>About Course</h3>
										<?php the_content(); ?>
									</div>
									<div id="tab3" class="tab-pane fade">
										<h3>Members</h3>
									</div>
									<div id="tab4" class="tab-pane fade">
										<?php
										if ($enable_instructor) {
										?>
											<div id="item-admins">
												<h3><?php _e('Instructors', 'vibe'); ?></h3>
												<?php
												bp_course_instructor();

												do_action('bp_after_course_menu_instructors');
												?>
											</div>
										<?php
										}
										?>
									</div>
									<div id="tab5" class="tab-pane fade">
										<h3>News</h3>
									</div>
									<div id="tab6" class="tab-pane fade">
										<?php
										comments_template('/course-review.php', true);
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="course-info">
					<h1 class="title">Course Info</h1>
					<div class="course-info-card">
						<div class="single-info border">
							<div class="icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/desktop.webp' ?>" alt="desktop" />
							</div>
							<p>
								Class :
								<span> Software Developer , Software Developer Pro </span>
							</p>
						</div>
						<div class="single-info border">
							<div class="icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/info-star.webp' ?>" alt="info-star" />
							</div>
							<p>
								Categories :
							<ul>
								<?php
								foreach (array_slice($terms, 0, 1) as $term_single) {
								?>
									<li><a href="<?php echo esc_url(get_term_link($term_single)); ?>"><?php echo esc_html($term_single->name); ?></a></li>
								<?php
								}
								?>
							</ul>
							</p>
						</div>
						<div class="single-info border">
							<div class="icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/book.webp' ?>" alt="book" />
							</div>
							<p>
								Lessons :
								<span> <?php echo $units; ?> </span>
							</p>
						</div>
						<div class="single-info border">
							<div class="icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/assignments.webp' ?>" alt="assignment" />
							</div>
							<p>
								Assignments :
								<span> <?php echo $assignment_count;
										?> </span>
							</p>
						</div>
						<div class="single-info border">
							<div class="icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/clock.webp' ?>" alt="clock" />
							</div>
							<p>
								Duration :
								<span> <?php echo $courseDuration; ?> </span>
							</p>
						</div>
						<div class="single-info">
							<div class="icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/packages.webp' ?>" alt="packages" />
							</div>
							<p>
								Packages :
								<span> Silver </span>
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="related_course">
				<h1 class="related_course_title">
					Related Courses
				</h1>
				<div class="a2n-courses__container">
					<?php echo do_shortcode('[courseCards]'); ?>
				</div>
			</div>
		</div>
<?php
	}
}
?>

<?php
if (!defined('ABSPATH')) exit;
?>
<section id="title">
	<?php do_action('wplms_before_title'); ?>
	<div class="course_header">
		<div class="<?php echo vibe_get_container(); ?>">
			<div class="row">
				<!-- <h1>top 2 child theme</h1> -->
				<div id="item-header" role="complementary">
					<?php locate_template(array('course/single/course-header2.php'), true); ?>
				</div><!-- #item-header -->
			</div>
		</div>
	</div>
</section>
<section>
	<div id="item-nav">
		<div class="<?php echo vibe_get_container(); ?>">
			<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
				<ul>
					<?php bp_get_options_nav(); ?>
					<?php

					global $current_user;
					$user_roles = $current_user->roles;
					$user_role = array_shift($user_roles);

					if (is_user_logged_in() & $user_role !== 'student' & $user_role !== 'subscriber')
						bp_course_nav_menu();


					?>
					<?php do_action('bp_course_options_nav'); ?>
				</ul>
			</div>
		</div><!-- #item-nav -->
	</div>
</section>
<section id="content">
	<div id="buddypress">
		<div class="<?php echo vibe_get_container(); ?>">
			<?php do_action('bp_before_course_home_content'); ?>
			<div class="row">
				<div class="col-md-8">