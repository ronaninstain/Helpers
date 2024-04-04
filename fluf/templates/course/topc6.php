<?php
$courseID = get_the_ID();
$userID = get_current_user_id();
$userRemainingTime = bp_course_get_user_expiry_time($userID, $courseID);
if (!empty($userRemainingTime)) {
	$now = time();
	$timeDifference = $userRemainingTime - $now;
	$dateInterval = date_diff(date_create(), date_create("+{$timeDifference} seconds"));
}

$remainingTimeFormatted = "";
$terms = get_the_terms($courseID, 'level');

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

$average_rating = get_post_meta($courseID, 'average_rating', true);
$countRating = get_post_meta($courseID, 'rating_count', true);
$studentNumers = get_post_meta($courseID, 'vibe_students', true);
$product_id = get_post_meta($courseID, 'vibe_product', true);

global $woocommerce;
$currency_symble = get_woocommerce_currency_symbol();
$price = get_post_meta($product_id, '_regular_price', true);
$sale = get_post_meta($product_id, '_sale_price', true);
$totalDiscount = (100 - ((100 * $sale) / $price));
$checkProfile = bp_is_my_profile();

$cart_url = $woocommerce->cart->get_cart_url();
?>
<div id="customToaster" class="success" style="display: none;">Note Added successfully.</div>
<section class="CourseTop">
	<div class="container">
		<div class="row">
			<div class="col-md-8 ml-auto">
				<div class="topContentBox">
					<h2><?php bp_course_name(); ?></h2>
					<?php the_excerpt(); ?>
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
					<div class="stds">
						<p><?php echo $studentNumers; ?> enrolled on this course</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="CourseMiddle">
	<div class="container">
		<div class="row for-order-change-mbl">
			<div class="col-md-8 col-sm-7 mbl-2">
				<div class="the-Tab-functional-middle">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#menu0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<g clip-path="url(#clip0_3546_21945)">
										<mask id="mask0_3546_21945" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<path d="M0 0H24V24H0V0Z" fill="white" />
										</mask>
										<g mask="url(#mask0_3546_21945)">
											<path d="M3 21H20C20.55 21 21 20.55 21 20V19C21 18.45 20.55 18 20 18H3C2.45 18 2 18.45 2 19V20C2 20.55 2.45 21 3 21ZM20 8H3C2.45 8 2 8.45 2 9V15C2 15.55 2.45 16 3 16H20C20.55 16 21 15.55 21 15V9C21 8.45 20.55 8 20 8ZM2 4V5C2 5.55 2.45 6 3 6H20C20.55 6 21 5.55 21 5V4C21 3.45 20.55 3 20 3H3C2.45 3 2 3.45 2 4Z" fill="#2D3748" />
										</g>
									</g>
									<defs>
										<clipPath id="clip0_3546_21945">
											<rect width="24" height="24" fill="white" />
										</clipPath>
									</defs>
								</svg>
								Overview</a></li>
						<li><a data-toggle="tab" href="#menu1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M18.1253 18.5648C18.6398 17.7873 18.8473 16.8465 18.7075 15.9247C18.5677 15.003 18.0905 14.166 17.3686 13.5761C16.6466 12.9862 15.7313 12.6855 14.8001 12.7323C13.869 12.779 12.9884 13.1699 12.3292 13.8292C11.6699 14.4884 11.279 15.369 11.2323 16.3001C11.1855 17.2313 11.4862 18.1466 12.0761 18.8686C12.666 19.5905 13.503 20.0677 14.4247 20.2075C15.3465 20.3473 16.2873 20.1398 17.0648 19.6253L18.2198 20.7803C18.3612 20.9169 18.5507 20.9925 18.7473 20.9908C18.944 20.9891 19.1321 20.9102 19.2711 20.7711C19.4102 20.6321 19.4891 20.444 19.4908 20.2473C19.4925 20.0507 19.4169 19.8612 19.2803 19.7198L18.1253 18.5648ZM15 18.75C14.555 18.75 14.12 18.618 13.75 18.3708C13.38 18.1236 13.0916 17.7722 12.9213 17.361C12.751 16.9499 12.7064 16.4975 12.7932 16.061C12.8801 15.6246 13.0943 15.2237 13.409 14.909C13.7237 14.5943 14.1246 14.3801 14.561 14.2932C14.9975 14.2064 15.4499 14.251 15.861 14.4213C16.2722 14.5916 16.6236 14.88 16.8708 15.25C17.118 15.62 17.25 16.055 17.25 16.5C17.25 17.0967 17.013 17.669 16.591 18.091C16.169 18.513 15.5967 18.75 15 18.75Z" fill="#2D3748" />
									<path d="M17.25 1.5H6.75C6.15381 1.50178 5.58255 1.73941 5.16098 2.16098C4.73941 2.58255 4.50178 3.15381 4.5 3.75V20.25C4.50178 20.8462 4.73941 21.4175 5.16098 21.839C5.58255 22.2606 6.15381 22.4982 6.75 22.5H17.25C17.5037 22.5016 17.7556 22.4558 17.9925 22.365C17.6785 22.2559 17.3937 22.0763 17.16 21.84L16.7625 21.4425C16.1972 21.6463 15.6009 21.7503 15 21.75C14.082 21.7504 13.18 21.5102 12.3838 21.0532C11.5877 20.5961 10.9253 19.9384 10.4627 19.1454C10.0002 18.3525 9.75359 17.4522 9.74761 16.5342C9.74163 15.6162 9.97645 14.7127 10.4287 13.9139C10.8809 13.115 11.5346 12.4486 12.3247 11.9813C13.1149 11.5139 14.0137 11.2619 14.9316 11.2504C15.8495 11.2389 16.7544 11.4683 17.556 11.9156C18.3576 12.363 19.0279 13.0127 19.5 13.8V3.75C19.4982 3.15381 19.2606 2.58255 18.839 2.16098C18.4175 1.73941 17.8462 1.50178 17.25 1.5ZM9 13.5H8.25C8.05109 13.5 7.86032 13.421 7.71967 13.2803C7.57902 13.1397 7.5 12.9489 7.5 12.75C7.5 12.5511 7.57902 12.3603 7.71967 12.2197C7.86032 12.079 8.05109 12 8.25 12H9C9.19891 12 9.38968 12.079 9.53033 12.2197C9.67098 12.3603 9.75 12.5511 9.75 12.75C9.75 12.9489 9.67098 13.1397 9.53033 13.2803C9.38968 13.421 9.19891 13.5 9 13.5ZM15.75 9.75H8.25C8.05109 9.75 7.86032 9.67098 7.71967 9.53033C7.57902 9.38968 7.5 9.19891 7.5 9C7.5 8.80109 7.57902 8.61032 7.71967 8.46967C7.86032 8.32902 8.05109 8.25 8.25 8.25H15.75C15.9489 8.25 16.1397 8.32902 16.2803 8.46967C16.421 8.61032 16.5 8.80109 16.5 9C16.5 9.19891 16.421 9.38968 16.2803 9.53033C16.1397 9.67098 15.9489 9.75 15.75 9.75ZM15.75 6H8.25C8.05109 6 7.86032 5.92098 7.71967 5.78033C7.57902 5.63968 7.5 5.44891 7.5 5.25C7.5 5.05109 7.57902 4.86032 7.71967 4.71967C7.86032 4.57902 8.05109 4.5 8.25 4.5H15.75C15.9489 4.5 16.1397 4.57902 16.2803 4.71967C16.421 4.86032 16.5 5.05109 16.5 5.25C16.5 5.44891 16.421 5.63968 16.2803 5.78033C16.1397 5.92098 15.9489 6 15.75 6Z" fill="#2D3748" />
								</svg>
								Curriculum</a></li>
						<li><a data-toggle="tab" href="#menu2">
								<img src="<?php echo get_theme_file_uri() . '/assets/img/application.svg' ?>" alt="cert">
								Get Accredited Certificate</a></li>
					</ul>

					<div class="tab-content">
						<div id="menu0" class="tab-pane fade in active">
							<?php
							the_content();
							?>
						</div>
						<div id="menu1" class="tab-pane fade">
							<div class="for-overwriting-the-css-c-crriculmn">
								<?php
								do_action('wplms_after_course_description');
								?>
							</div>
						</div>
						<div id="menu2" class="tab-pane fade">
							<?php echo do_shortcode('[elementor-template id="323634"]'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-5 mbl-1">
				<div class="theSideBar">
					<div class="theCourseImage">
						<?php bp_course_avatar(); ?>
					</div>
					<div class="thePriceAndDiscoutCount">
						<?php
						if (!$checkProfile) {
							if (!empty($sale)) {
						?>
								<div class="thepurchasebtns">
									<div class="mainPrice">
										<del>
											<?php echo $currency_symble; ?>
											<?php echo $price; ?>
										</del>
									</div>
									<div class="discountPrice">
										<?php echo $currency_symble; ?>
										<?php echo $sale; ?>
									</div>
								</div>
							<?php
							} elseif (empty($sale) && !empty($price)) {
							?>
								<div class="thepurchasebtns">
									<div class="mainPrice">
										<?php echo $currency_symble; ?>
										<?php echo $price; ?>
									</div>

								</div>
							<?php
							} elseif (empty($sale) && empty($price)) {
							?>
								<div class="itsFree">
									<span>Free</span>
								</div>
						<?php
							}
						}
						?>
						<div class="theTotalDicounts">
							<p>( <span><?php echo number_format($totalDiscount, 0, '.', '') . '%' ?></span> Off Limited Time )</p>
						</div>
					</div>
					<div class="theMainBtn">
						<?php
						if (function_exists('sa_membeship_button')) {
							$course_id = get_the_ID();
							sa_membeship_button($course_id);
						} else {
							the_course_button();
						}
						?>
					</div>
					<div class="theAjaxbtn">
						<a href="#" class="add-to-cart_single" data-product-id="<?php echo $product_id; ?>">Add to Cart with Other Products</a>
					</div>
					<hr>
					<div class="theExtraBtns">
						<h4>Buying more than one course?</h4>
						<div class="theBusinessBtn">
							<h6>Get huge discounts for team training!</h6>
							<a href="#">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
									<path d="M5.6 10.1V9.4H0.707L0.7 12.2C0.7 12.977 1.323 13.6 2.1 13.6H11.9C12.677 13.6 13.3 12.977 13.3 12.2V9.4H8.4V10.1H5.6ZM12.6 3.8H9.793V2.4L8.393 1H5.593L4.193 2.4V3.8H1.4C0.63 3.8 0 4.43 0 5.2V7.3C0 8.077 0.623 8.7 1.4 8.7H5.6V7.3H8.4V8.7H12.6C13.37 8.7 14 8.07 14 7.3V5.2C14 4.43 13.37 3.8 12.6 3.8ZM8.4 3.8H5.6V2.4H8.4V3.8Z" fill="white" />
								</svg>
								Buy for Business
							</a>
						</div>
						<h4>Buying for someone special?</h4>
						<div class="theSpecialBtn">
							<h6>Get for Family or Colleagues</h6>
							<?php
							echo '<div id="move_field_c"><input type="hidden" name="add-to-cart" value="' . $product_id . '" /></div>';

							echo $course_details['gift_course'] = '<input type="hidden" class="gift_course_cart_url" value="' . $cart_url . '"/>
									<a class="gift_course_button"  class="full button" data-from="' . __('Enter your email', 'wplms-gift') . '" data-to="' . __('Enter gift email', 'wplms-gift') . '" data-message="' . __('Enter message', 'wplms-gift') . '" data-button="' . __('Send as Gift', 'wplms-gift') . '">' . __('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
										<g clip-path="url(#clip0_1079_2320)">
										  <path d="M2.625 2.6875C2.625 2.10734 2.85547 1.55094 3.2657 1.1407C3.67594 0.730468 4.23234 0.5 4.8125 0.5C5.39266 0.5 5.94906 0.730468 6.3593 1.1407C6.76953 1.55094 7 2.10734 7 2.6875C7 2.10734 7.23047 1.55094 7.6407 1.1407C8.05094 0.730468 8.60734 0.5 9.1875 0.5C9.76766 0.5 10.3241 0.730468 10.7343 1.1407C11.1445 1.55094 11.375 2.10734 11.375 2.6875V2.69275C11.375 2.754 11.375 2.929 11.3418 3.125H13.125C13.3571 3.125 13.5796 3.21719 13.7437 3.38128C13.9078 3.54538 14 3.76794 14 4V4.875C14 5.10706 13.9078 5.32962 13.7437 5.49372C13.5796 5.65781 13.3571 5.75 13.125 5.75H0.875C0.642936 5.75 0.420376 5.65781 0.256282 5.49372C0.0921872 5.32962 0 5.10706 0 4.875V4C0 3.76794 0.0921872 3.54538 0.256282 3.38128C0.420376 3.21719 0.642936 3.125 0.875 3.125H2.65825C2.63514 2.9821 2.62402 2.83751 2.625 2.69275V2.6875ZM3.5595 3.125H6.125V2.6875C6.125 2.51514 6.09105 2.34447 6.02509 2.18523C5.95913 2.02599 5.86245 1.8813 5.74058 1.75942C5.6187 1.63755 5.47401 1.54087 5.31477 1.47491C5.15553 1.40895 4.98486 1.375 4.8125 1.375C4.64014 1.375 4.46947 1.40895 4.31023 1.47491C4.15099 1.54087 4.0063 1.63755 3.88442 1.75942C3.76255 1.8813 3.66587 2.02599 3.59991 2.18523C3.53395 2.34447 3.5 2.51514 3.5 2.6875C3.5 2.76187 3.50175 2.92725 3.53938 3.06375C3.54463 3.08462 3.55136 3.10508 3.5595 3.125ZM7.875 3.125H10.4405C10.4485 3.10505 10.4553 3.08459 10.4606 3.06375C10.4983 2.92725 10.5 2.76187 10.5 2.6875C10.5 2.3394 10.3617 2.00556 10.1156 1.75942C9.86944 1.51328 9.5356 1.375 9.1875 1.375C8.8394 1.375 8.50556 1.51328 8.25942 1.75942C8.01328 2.00556 7.875 2.3394 7.875 2.6875V3.125ZM13.125 6.625V13.1875C13.125 13.5356 12.9867 13.8694 12.7406 14.1156C12.4944 14.3617 12.1606 14.5 11.8125 14.5H7.875V6.625H13.125ZM2.1875 14.5C1.8394 14.5 1.50556 14.3617 1.25942 14.1156C1.01328 13.8694 0.875 13.5356 0.875 13.1875V6.625H6.125V14.5H2.1875Z" fill="white"/>
										</g>
										<defs>
										  <clipPath id="clip0_1079_2320">
											<rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
										  </clipPath>
										</defs>
									  </svg> 
									  Gift this course', 'wplms-gift') . '</a>';
							?>
						</div>
					</div>
					<hr>
					<div class="theCourseFeatures">
						<h2>This Course Includes</h2>
						<ul>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
									<g clip-path="url(#clip0_1079_3155)">
										<path d="M11 -2C12.6569 -2 14 -0.656854 14 1V16C14 17.6569 12.6569 19 11 19H5C3.34315 19 2 17.6569 2 16V1C2 -0.656854 3.34315 -2 5 -2H11ZM5 12C5 11.7239 4.77614 11.5 4.5 11.5C4.22386 11.5 4 11.7239 4 12V12.5C4 12.7761 4.22386 13 4.5 13C4.77614 13 5 12.7761 5 12.5V12ZM5 7.5C5 7.22386 4.77614 7 4.5 7C4.22386 7 4 7.22386 4 7.5V8C4 8.27614 4.22386 8.5 4.5 8.5C4.77614 8.5 5 8.27614 5 8V7.5ZM5 3C5 2.72386 4.77614 2.5 4.5 2.5C4.22386 2.5 4 2.72386 4 3V3.5C4 3.77614 4.22386 4 4.5 4C4.77614 4 5 3.77614 5 3.5V3ZM12 12.25C12 11.8358 11.6642 11.5 11.25 11.5H6.75C6.33579 11.5 6 11.8358 6 12.25C6 12.6642 6.33579 13 6.75 13H11.25C11.6642 13 12 12.6642 12 12.25ZM12 7.75C12 7.33579 11.6642 7 11.25 7H6.75C6.33579 7 6 7.33579 6 7.75C6 8.16421 6.33579 8.5 6.75 8.5H11.25C11.6642 8.5 12 8.16421 12 7.75ZM12 3.25C12 2.83579 11.6642 2.5 11.25 2.5H6.75C6.33579 2.5 6 2.83579 6 3.25C6 3.66421 6.33579 4 6.75 4H11.25C11.6642 4 12 3.66421 12 3.25Z" fill="#2D3748" />
									</g>
									<defs>
										<clipPath id="clip0_1079_3155">
											<rect width="16" height="16" fill="white" />
										</clipPath>
									</defs>
								</svg>
								<?php echo count($units) . ' Units'; ?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
									<path d="M14.0396 7.4269H8.59965V4.84944C8.59965 3.84413 8.20029 2.87999 7.48942 2.16912C6.77856 1.45826 5.81442 1.0589 4.8091 1.0589C3.80379 1.0589 2.83965 1.45826 2.12878 2.16912C1.41791 2.87999 1.01855 3.84413 1.01855 4.84944V6.47272C1.01855 6.50061 1.02405 6.52822 1.03472 6.55399C1.04539 6.57975 1.06103 6.60316 1.08075 6.62288C1.10047 6.6426 1.12389 6.65824 1.14965 6.66892C1.17542 6.67959 1.20303 6.68508 1.23092 6.68508H2.64474C2.67262 6.68508 2.70024 6.67959 2.726 6.66892C2.75177 6.65824 2.77518 6.6426 2.7949 6.62288C2.81462 6.60316 2.83026 6.57975 2.84093 6.55399C2.85161 6.52822 2.8571 6.50061 2.8571 6.47272V4.84944C2.8571 4.33174 3.06276 3.83524 3.42883 3.46917C3.7949 3.1031 4.2914 2.89744 4.8091 2.89744C5.3268 2.89744 5.8233 3.1031 6.18937 3.46917C6.55544 3.83524 6.7611 4.33174 6.7611 4.84944V7.4269H6.56619C6.31544 7.4269 6.07496 7.52651 5.89765 7.70382C5.72035 7.88112 5.62074 8.1216 5.62074 8.37235V13.9985C5.62151 14.2488 5.72146 14.4885 5.89868 14.6652C6.0759 14.8419 6.31594 14.9411 6.56619 14.9411H14.0396C14.1634 14.9411 14.286 14.9167 14.4003 14.8693C14.5147 14.822 14.6186 14.7525 14.7061 14.665C14.7936 14.5775 14.8631 14.4736 14.9104 14.3592C14.9578 14.2449 14.9822 14.1223 14.9822 13.9985V8.37235C14.9826 8.24833 14.9585 8.12545 14.9113 8.01076C14.8641 7.89607 14.7947 7.79182 14.7072 7.70399C14.6196 7.61616 14.5156 7.54647 14.401 7.49892C14.2865 7.45137 14.1637 7.4269 14.0396 7.4269ZM11.2062 12.5091C11.2142 12.5398 11.2153 12.572 11.2093 12.6032C11.2032 12.6344 11.1902 12.6639 11.1713 12.6894C11.1513 12.7143 11.1261 12.7345 11.0974 12.7486C11.0688 12.7627 11.0374 12.7703 11.0055 12.7709H9.60037C9.568 12.7705 9.53611 12.763 9.50696 12.7489C9.4778 12.7349 9.45209 12.7145 9.43165 12.6894C9.41161 12.6645 9.39774 12.6351 9.39117 12.6038C9.3846 12.5724 9.38551 12.54 9.39383 12.5091L9.68474 11.3454C9.55395 11.2428 9.4514 11.1087 9.38672 10.9556C9.32204 10.8024 9.29736 10.6354 9.315 10.4701C9.33264 10.3048 9.39201 10.1467 9.48755 10.0107C9.58308 9.87463 9.71164 9.76512 9.86113 9.69243C10.0106 9.61974 10.1761 9.58626 10.3421 9.59513C10.5081 9.604 10.6691 9.65493 10.81 9.74313C10.9509 9.83133 11.0671 9.95392 11.1476 10.0994C11.2281 10.2448 11.2703 10.4083 11.2702 10.5745C11.271 10.7217 11.2391 10.8673 11.1767 11.0006C11.1143 11.134 11.023 11.2518 10.9095 11.3454L11.2062 12.5091Z" fill="#2D3748" />
								</svg>
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
									$remainingTimeFormatted = "1 Year Access";
								}

								echo $remainingTimeFormatted;
								?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
									<path d="M13.3329 14.4H12.7115V12.3787C12.7123 11.6847 12.5409 11.0014 12.2128 10.3899C11.8847 9.77841 11.4102 9.2578 10.8315 8.87467L9.51155 8L10.8315 7.12533C11.4102 6.7422 11.8847 6.22159 12.2128 5.61009C12.5409 4.99859 12.7123 4.31529 12.7115 3.62133V1.6H13.3329C13.5451 1.6 13.7485 1.51571 13.8986 1.36569C14.0486 1.21566 14.1329 1.01217 14.1329 0.8C14.1329 0.587827 14.0486 0.384344 13.8986 0.234315C13.7485 0.0842855 13.5451 0 13.3329 0L2.66621 0C2.45404 0 2.25055 0.0842855 2.10053 0.234315C1.9505 0.384344 1.86621 0.587827 1.86621 0.8C1.86621 1.01217 1.9505 1.21566 2.10053 1.36569C2.25055 1.51571 2.45404 1.6 2.66621 1.6H3.41554V3.62133C3.41435 4.31538 3.5855 4.99886 3.91363 5.61043C4.24176 6.22201 4.7166 6.74255 5.29554 7.12533L6.61554 8L5.29554 8.87467C4.71907 9.25898 4.24684 9.78019 3.92109 10.3917C3.59534 11.0031 3.42623 11.6858 3.42888 12.3787V14.4H2.66621C2.45404 14.4 2.25055 14.4843 2.10053 14.6343C1.9505 14.7843 1.86621 14.9878 1.86621 15.2C1.86621 15.4122 1.9505 15.6157 2.10053 15.7657C2.25055 15.9157 2.45404 16 2.66621 16H13.3329C13.5451 16 13.7485 15.9157 13.8986 15.7657C14.0486 15.6157 14.1329 15.4122 14.1329 15.2C14.1329 14.9878 14.0486 14.7843 13.8986 14.6343C13.7485 14.4843 13.5451 14.4 13.3329 14.4ZM5.01554 12.3787C5.01511 11.949 5.12105 11.5259 5.32393 11.1471C5.5268 10.7684 5.8203 10.4457 6.17821 10.208L8.06355 8.96L9.94621 10.208C10.3045 10.4456 10.5983 10.7681 10.8017 11.1469C11.005 11.5256 11.1115 11.9488 11.1115 12.3787V14.4H5.01554V12.3787Z" fill="#2D3748" />
								</svg>
								<?php echo $courseDuration; ?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
									<path d="M2 14.5H3.25C4.07501 14.5 4.75 13.825 4.75 13V8.54999C4.75 7.72 4.07501 7.04999 3.25 7.04999H2C1.17499 7.04999 0.5 7.72 0.5 8.54999V13C0.5 13.825 1.17499 14.5 2 14.5Z" fill="#2D3748" />
									<path d="M8.625 4.27502H7.375C6.54999 4.27502 5.875 4.95001 5.875 5.77502V13C5.875 13.825 6.54999 14.5 7.375 14.5H8.625C9.45001 14.5 10.125 13.825 10.125 13V5.77502C10.125 4.95001 9.45001 4.27502 8.625 4.27502Z" fill="#2D3748" />
									<path d="M14 1.5H12.75C11.925 1.5 11.25 2.17499 11.25 3V13C11.25 13.825 11.925 14.5 12.75 14.5H14C14.825 14.5 15.5 13.825 15.5 13V3C15.5 2.17499 14.825 1.5 14 1.5Z" fill="#2D3748" />
								</svg>
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
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
									<g clip-path="url(#clip0_1079_3180)">
										<path d="M14.2761 0H1.72394C0.773344 0 0 0.773375 0 1.72397V11.2636C0 12.2142 0.773344 12.9875 1.72394 12.9875H9.10419V11.0125C9.10419 9.40653 10.4107 8.1 12.0167 8.1C13.6226 8.1 14.9291 9.40656 14.9291 11.0125V12.8586C15.5567 12.6007 16 11.9831 16 11.2636V1.72397C16 0.773375 15.2266 0 14.2761 0ZM4.48541 2.04166H11.5146C11.7734 2.04166 11.9833 2.25153 11.9833 2.51041C11.9833 2.76928 11.7734 2.97916 11.5146 2.97916H4.48541C4.22656 2.97916 4.01666 2.76928 4.01666 2.51041C4.01666 2.25153 4.22656 2.04166 4.48541 2.04166ZM7.56456 10.4771H2.47706C2.21822 10.4771 2.00831 10.2672 2.00831 10.0083C2.00831 9.74947 2.21822 9.53959 2.47706 9.53959H7.56459C7.8235 9.53959 8.03334 9.74947 8.03334 10.0083C8.03334 10.2672 7.8235 10.4771 7.56456 10.4771ZM13.5229 6.99584H2.47706C2.21822 6.99584 2.00831 6.78597 2.00831 6.52709C2.00831 6.26822 2.21822 6.05834 2.47706 6.05834H13.5229C13.7818 6.05834 13.9917 6.26822 13.9917 6.52709C13.9916 6.78597 13.7818 6.99584 13.5229 6.99584ZM13.5229 4.9875H2.47706C2.21822 4.9875 2.00831 4.77763 2.00831 4.51875C2.00831 4.25988 2.21822 4.05 2.47706 4.05H13.5229C13.7818 4.05 13.9917 4.25988 13.9917 4.51875C13.9916 4.77763 13.7818 4.9875 13.5229 4.9875Z" fill="#2D3748" />
										<path d="M12.017 9.03748C10.928 9.03748 10.042 9.92348 10.042 11.0125C10.042 12.1015 10.928 12.9874 12.017 12.9874C13.106 12.9874 13.9919 12.1015 13.9919 11.0125C13.9919 9.92348 13.106 9.03748 12.017 9.03748Z" fill="#2D3748" />
										<path d="M10.042 13.151V15.5313C10.042 15.7041 10.1371 15.863 10.2896 15.9445C10.3588 15.9817 10.4349 16 10.5107 16C10.6016 16 10.6923 15.9736 10.7707 15.9213L12.017 15.0904L13.2632 15.9213C13.3416 15.9736 13.4323 16 13.5232 16C13.5991 16 13.6751 15.9816 13.7444 15.9446C13.8968 15.863 13.9919 15.7042 13.9919 15.5313V13.151C13.4725 13.6311 12.7784 13.925 12.017 13.925C11.2555 13.925 10.5615 13.6311 10.042 13.151Z" fill="#2D3748" />
									</g>
									<defs>
										<clipPath id="clip0_1079_3180">
											<rect width="16" height="16" fill="white" />
										</clipPath>
									</defs>
								</svg>
								Accredited Certificate
							</li>
						</ul>
					</div>
					<hr>
					<div class="theAcredationImages">
						<div class="firstlot">
							<img src="<?php echo get_theme_file_uri() . '/assets/img/14 days.png' ?>" alt="acredations">
							<img src="<?php echo get_theme_file_uri() . '/assets/img/pngkey 1.png' ?>" alt="acredations">
							<img src="<?php echo get_theme_file_uri() . '/assets/img/design.png' ?>" alt="acredations">
						</div>
						<div class="secondlot">
							<img src="<?php echo get_theme_file_uri() . '/assets/img/trustpilot.png' ?>" alt="acredations">
							<img src="<?php echo get_theme_file_uri() . '/assets/img/reviewio.png' ?>" alt="acredations">
							<img src="<?php echo get_theme_file_uri() . '/assets/img/google.png' ?>" alt="acredations">
						</div>
					</div>
					<hr>
					<div class="theShareCourseBox">
						<h2>Share this Course:</h2>
						<?php echo do_shortcode('[social_sharing]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="courseBottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Frequently Bought Together</h2>
				<?php echo do_shortcode('[related_course]'); ?>
			</div>
		</div>
	</div>
</section>

<!-- Admin Nav bar start -->

<?php
$roles = (array) $user->roles;

// var_dump($roles );
$notAllowedRoles = array('Subscriber', 'Student');

if (is_user_logged_in()) {
	if (!in_array($user->roles, $notAllowedRoles)) {
?>
		<section class="adminbar-23-cCloud">
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

<!-- Admin Nav bar end -->