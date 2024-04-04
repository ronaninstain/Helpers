<?php

/**
 * The template for displaying Course font
 *
 * Override this template by copying it to yourtheme/course/single/front.php
 *
 * @author 		VibeThemes
 * @package 	vibe-course-module/templates
 * @version     2.0
 */

global $post;
$id= get_the_ID();

do_action('wplms_course_before_front_main');


	do_action('wplms_before_course_description');

?>
<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="course_description" id="course-home">


	<div class="description-meta">

		<div class="des-meta-one">
			<div class="single-course-level">
				
				<?php 
				if(!empty($terms)){
					?>
					<div class="level-text">Course level:</div>
					<?php
				}	
				?>

				<div class="level-code">
				    <?php
						$course_id = get_the_ID();
						$terms = get_the_terms( $course_id, 'level');
						if(!empty($terms)){
						
						
						$category = array();
						$cat = "";
						echo '<ul>';
						foreach ($terms as $term) {
						echo '<li class="level_categories">'.$term->name.'</li>';
						}
						echo '</ul>';

						$course_category = implode(',', $category);
						}
					?>
				</div>
			</div>
			<div class="single-course-share">
				<div class="ssharetext"><span>Share: </span></div>
				<div class="sshare"><?php echo do_shortcode('[social_sharing]'); ?></div>
			</div>
		</div>

		<div class="des-meta-two">
			<div class="des-meta-cat">
				<div class="single-cat-title">Categories </div>
				<div class="des-categories">
					<?php
						$course_id = get_the_ID();
						$terms = get_the_terms( $course_id, 'course-cat');
						if(!empty($terms)){
						
						
						$category = array();
						$cat = "";
						echo '<div>';
						foreach ($terms as $term) {
						echo '<div class="course_categories_one">'.$term->name.'</div>';
						}
						echo '</div>';

						$course_category = implode(',', $category);
					}
					?>
				</div>
			</div>
			<div class="des-meta-duration">
				<div class="durationtext">Duration</div>
				<div class="duration-code">
					<?php echo do_shortcode('[course_duration_total]'); ?>
				</div>
			</div>
			<div class="des-meta-enrolled">
				<div class="single-enrolled">Total Enrolled</div>
				<div class="enrolled-count"><?php echo get_post_meta(get_the_id(), 'vibe_students', true);?></div>	
			</div>
			<div class="des-meta-last updated">
				<div class="updatedtext">Last Updated</div>
				<div class="updated-date">
					<?php echo do_shortcode('[last_update]'); ?>
				</div>
			</div>
		</div>

		<div class="des-meta-three">
			<h4 class="about-couse">About Course</h4>
			<?php  the_excerpt() ;?>
		</div>
	</div>


	<div class="small_desc">
		<!-- <h1>front 2 child theme</h1> -->
		<!-- <h5 class="descriptionsingle">Description</h5> -->
		<!-- <h4 class="single-course-des-title">Course Description</h4> -->
		<?php the_content();?>
	</div>


		<div class="full_desc">
		
		</div>
	

</div>
<?php
if ( is_user_logged_in() ) {
	$user_id = get_current_user_id();
	$course_id = get_the_ID();
	$course_check = wplms_user_course_check($user_id,$course_id);
	//var_dump($course_check );
	if ($course_check) {
		?>
		<style>
			#item-body .small_desc section.elementor-section.elementor-top-section.elementor-element.elementor-section-stretched.elementor-section-boxed.elementor-section-height-default.elementor-section-height-default {
				display: none !important;
			}
		</style>
		<?php
		do_action('wplms_after_course_description');
	}
}
?>

<div class="sh_free-course-advice">
	<?php 
		echo do_shortcode('[gravityform id="13" title="true" description="true"]');
	?>
</div>

<!-- <div class="course_reviews" id="course-reviews">
<?php
	 //comments_template('/course-review.php',true);
?>
</div> -->