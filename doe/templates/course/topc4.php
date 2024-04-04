<?php
if (!defined('ABSPATH')) exit;
?>
<?php
$courseID = get_the_ID();
$average_rating = get_post_meta($courseID, 'average_rating', true);
$countRating = get_post_meta($courseID, 'rating_count', true);
$courseStds = get_post_meta($courseID, 'vibe_students', true);

$userID = get_current_user_id();
$userRemainingTime = bp_course_get_user_expiry_time($userID, $courseID);
if (!empty($userRemainingTime)) {
	$now = time();
	$timeDifference = $userRemainingTime - $now;
	$dateInterval = date_diff(date_create(), date_create("+{$timeDifference} seconds"));
}

$remainingTimeFormatted = "";

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

$terms = get_the_terms($courseID, 'level');

$units = bp_course_get_curriculum_units($courseID);
$duration = $total_duration = 0;
//$completedQuizzes = bp_course_check_quiz_complete($quiz_id, $user_id, $course_id);

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

$product_id = get_post_meta($courseID, 'vibe_product', true);
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();
?>
<section class="courseSingleHero">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="singleCourseHeaderDetails">
					<h2><?php bp_course_name(); ?></h2>
					<div class="courseMinihighlights">
						<span>(<?php echo $countRating; ?> Reviews)</span>
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
						<div class="courseStds">
							<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/stds.svg' ?>" alt="stds"><?php echo $courseStds; ?> Students</p>
						</div>
						<div class="courseTpilot">
							<img src="<?php echo get_theme_file_uri() . '/assets/imgs/trustpilot.png' ?>" alt="stds">
						</div>
					</div>
					<div class="courseAvatar">
						<?php bp_course_avatar(); ?>
					</div>
					<div class="siteOfferonCourse">
						<?php
						echo do_shortcode('[elementor-template id="325794"]');
						?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="theTabsSide">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#menu0">For You</a></li>
						<li><a data-toggle="tab" href="#menu1">For Business</a></li>
					</ul>

					<div class="tab-content">
						<div id="menu0" class="tab-pane fade in active">
							<?php bp_course_credits(); ?>
							<div class="courseBtns">
								<?php
								if (function_exists('sa_membeship_button')) {
									sa_membeship_button($courseID);
								} else {
									the_course_button();
								}
								?>
							</div>
							<span class="theMoneyBack"><img src="<?php echo get_theme_file_uri() . '/assets/imgs/moneyback.svg' ?>" alt="mback">14-Day Money-Back Guarantee</span>
							<ul class="theCourseFeatures">
								<li>
									<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/lock.svg' ?>" alt="lock">Access</p>
									<span>
										<?php
										if (bp_course_is_member($courseID, $userID)) {
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
											$remainingTimeFormatted = "1 Year";
										}

										echo $remainingTimeFormatted;
										?>
									</span>
								</li>
								<li>
									<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/skills.svg' ?>" alt="skills">Skill Level</p>
									<span>
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
									</span>
								</li>
								<li>
									<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/cert.svg' ?>" alt="cert">Certificate</p>
									<span>
										<a href="#certPopupSingleCourse">Course Certificate</a>
									</span>
								</li>
								<li>
									<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/units.svg' ?>" alt="units">Units</p>
									<span>
										<?php echo count($units); ?>
									</span>
								</li>
								<li>
									<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/quizzes.svg' ?>" alt="quizzes">Quizzes</p>
									<span><?php echo $quiz_count; ?></span>
								</li>
								<!-- <li>
											<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/tic.svg' ?>" alt="tic">Quizzes Completed</p>
											<?php
											if (bp_course_is_member($courseID, $userID)) {

											?>
												<span>
													<?php echo $completedQuizzes; ?>
												</span>
											<?php
											} else {
												echo '<span>You are not a learner of this course</span>';
											}
											?>

										</li> -->

								<li>
									<p><img src="<?php echo get_theme_file_uri() . '/assets/imgs/duration.svg' ?>" alt="duration">Duration</p>
									<span>
										<?php echo $courseDuration; ?>
									</span>

								</li>
							</ul>

							<div class="acredationBox">
								<img src="<?php echo get_theme_file_uri() . '/assets/imgs/cpd.png' ?>" alt="acredation">
								<img src="<?php echo get_theme_file_uri() . '/assets/imgs/ciq.png' ?>" alt="acredation">
								<img src="<?php echo get_theme_file_uri() . '/assets/imgs/ukrlp.png' ?>" alt="acredation">
							</div>

							<?php
							echo '<div id="move_field_c"><input type="hidden" name="add-to-cart" value="' . $product_id . '" /></div>';

							echo $course_details['gift_course'] = '<input type="hidden" class="gift_course_cart_url" value="' . $cart_url . '"/>
									<a class="gift_course_button"  class="full button" data-from="' . __('Enter your email', 'wplms-gift') . '" data-to="' . __('Enter gift email', 'wplms-gift') . '" data-message="' . __('Enter message', 'wplms-gift') . '" data-button="' . __('Send as Gift', 'wplms-gift') . '">' . __('Gift this course', 'wplms-gift') . '</a>';
							?>
						</div>
						<div id="menu1" class="tab-pane fade">
							<?php echo do_shortcode('[gravityform id="49" title="false" description="false" ajax="false"]'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="courseSingleContent">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<ul class="contentLists">
					<li><a href="#courseSingleHome">HOME</a></li>
					<li><a href="#courseSingleCirriculum">CURRICULUM</a></li>
					<li><a href="#courseSingleReviews">Reviews</a></li>
				</ul>

				<div class="courseSingleHome" id="courseSingleHome">
					<?php the_content(); ?>
				</div>

				<div class="courseSingleCirriculum" id="courseSingleCirriculum">
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
														<img src="<?php echo get_stylesheet_directory_uri() . '/assets/imgs/videojohn.svg' ?>" alt="video">
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
				<div class="courseSingleReviews" id="courseSingleReviews">
					<h2>What Our Students are Saying</h2>
					<?php echo do_shortcode('[elementor-template id="348746"]'); ?>
				</div>
			</div>
			<div class="col-md-4">
				<?php
				$sidebar = apply_filters('wplms_sidebar', 'coursesidebar', get_the_ID());
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) : ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section class="adminBarJohn">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				// $user = wp_get_current_user();
				$roles = (array) $user->roles;

				// var_dump($roles );
				$notAllowedRoles = array('Subscriber', 'Student');

				if (is_user_logged_in()) {
					if (!in_array($user->roles, $notAllowedRoles)) {
				?>
						<section class="adminbar-23-iBeauty">
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
						</section>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</section>
<section class="courseSingleLast">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Other Students Also Bought</h2>
				<?php echo do_shortcode('[courseCard]'); ?>
			</div>
		</div>
	</div>
</section>
<?php
