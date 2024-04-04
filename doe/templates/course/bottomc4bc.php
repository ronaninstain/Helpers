<?php
if (!defined('ABSPATH')) exit;

do_action('wplms_single_course_content_end');
?>
</div>
<style>
	.price-offer {
		display: block;
		width: 50%;
		margin-top: 10px;
		margin-bottom: 15px;
		text-align: right;
		font-weight: bold;
		font-size: 13px;
	}

	.widget .course_details>ul>li.course_price {
		display: flex;
		justify-content: space-between;
		font-size: 14px !important;
	}

	.widget .course_details>ul>li.course_price .price-offer>i {
		margin-right: 10px !important;
		color: red !important;
		display: contents;
	}

	.widget .course_details>ul>li.course_price .price-offer>i:before {
		color: red !important;
	}

	/* .price_with_offer {
		display: flex;
	}

	.price_with_offer #price_paste {
		width: 82%;
		margin: 15px 0;
	} */
</style>
<div class="col-md-3">
	<div class="widget pricing" id="course-pricing">
		<?php
		if (function_exists('sa_membeship_button')) {
			$course_id = get_the_ID();
			sa_membeship_button($course_id);
		} else {
			the_course_button();
		}
		?>
		<div class="trustpilot">
			<img src="<?php echo get_stylesheet_directory_uri().'/img/trustpilot.jpg' ?>" alt="">
		</div>
		<!-- <div class="price_with_offer">
			<div id="price_paste"></div>
			<span class="price-offer"><i class="fa fa-tags"></i>SALE ENDS SOON </span>
		</div> -->

		<?php the_course_details(); ?>

	</div>
	<div id="item-admins">

		<h3><?php _e('Instructors', 'vibe'); ?></h3>
		<?php
		bp_course_instructor();

		do_action('bp_after_course_menu_instructors');
		?>
	</div><!-- #item-actions -->
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
</div><!-- .padder -->
</div><!-- #container -->
</div>
</div>
</section>