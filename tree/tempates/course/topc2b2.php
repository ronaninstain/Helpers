<section class="mha_scj_breadcumbs">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<?php vibe_breadcrumbs(); ?>
			</div>
			<div class="col-md-6">
				<ul class="mha_scj_upmenu">
					<li><a href="#content">Overview</a></li>
					<li><a href="#course-curriculum">Content</a></li>
					<li><a href="#course-reviews">Reviews</a></li>
					<li><a href="#Benefits">Benefits</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section id="nottitle" class="mha_scj_courseintro">
	<img class="mha_shadow_img" src="https://www.janets.org.uk/wp-content/uploads/2023/02/Sphere-White-Glossy.png" alt=" bg side img">
	<?php do_action('wplms_before_title'); ?>
	<div class="mha_course_header">
		<div class="<?php echo vibe_get_container(); ?>">
			<div class="row">
				<div class="col-md-6">
					<div class="mha_course_img">
						<?php bp_course_avatar(); ?>
					</div>
				</div>
				<div class="col-md-6">
					<h1 class="mha_scj_title"><?php bp_course_name(); ?></h1>
					<!-- <h1 class="mha_scj_title"><?php bp_course_name(); ?></h1> -->

					<div class="mha_scj_credits" id="course-pricing">
						<?php
						bp_course_credits();
						//echo bp_course_get_course_credits($post->ID);
						?>
						<i class="fa fa-tags">SALE ENDS SOON </i>
						<?php
						if (function_exists('sa_membeship_button')) {
							$course_id = get_the_ID();
							sa_membeship_button($course_id);
						} else {
							the_course_button();
						}

						$published_posts = wp_count_posts('course')->publish;
						?>

						<h4 class="title-around">OR</h4>
						<a class="get_accessbtn" href="https://www.janets.org.uk/checkout/?add-to-cart=393651">All Courses for £49</a>
						<ul class="premium_access">
							<li><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Icon-ionic-ios-checkmark-1.webp" alt="premium course icon">3000+ Premium Courses </li>
							<li><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Icon-ionic-ios-checkmark-1.webp" alt="500+">500K+ Learners</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<?php $post = get_the_ID(); ?>
					<ul class="mha_scj_overview">
						<li class="student_stats">
							<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003881.png" alt="students">
							<p><?php echo get_post_meta(get_the_ID(), 'vibe_students', true); ?> Students</p>
						</li>
						<?php if (has_term('Regulated Courses', 'course-cat', $post)) { ?>
							<li class="Static_certified ofqual">
								<img src="https://www.janets.org.uk/wp-content/uploads/2023/09/ofqual_gov_uk.png" alt="icon">
								<!-- <p
								>Ofqual</p> -->
							</li>
						<?php } else { ?>
							<li class="Static_certified">
								<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003883.png" alt="icon">
								<p>Certified</p>
							</li>
						<?php } ?>



						<li class="course_level">

							<?php
							$terms = get_the_terms(get_the_ID(), 'level');
							if (has_term('Dental Courses', 'course-cat', $post)) {
							?>
								<img class="ohiS" src="https://www.janets.org.uk/wp-content/uploads/2023/10/logo_ohis.6563ecb.svg" alt="course-cat" />
								<?php
							} else {
								echo '<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Group-1000003882.png" alt="course-cat" />';
								if ($terms && !is_wp_error($terms)) {
									foreach ($terms as $term) {
								?>
										<a href="<?php echo home_url(); ?>/level/<?php echo $term->slug; ?>" rel="tag"><?php echo $term->name; ?></a>
							<?php
										break;
									}
								}
							}
							?>
						</li>
					</ul>
				</div>
				<div class="col-md-6">
					<ul class="mha_scj_overview">
						<?php if (has_term('Regulated Courses', 'course-cat', $post)) { ?>
							<li class="cpd_stats focus">
								<img src="https://www.janets.org.uk/wp-content/uploads/2023/09/focus.png" alt="focus uk">
							</li>
						<?php } elseif (has_term('Dental Courses', 'course-cat', $post)) {
						?>
							<li class="cpd_stats">
								<img class="AdaCerp" src="https://www.janets.org.uk/wp-content/uploads/2023/10/ADA-CERP-logo.png" alt="ADA">
							</li>
						<?php
						} else { ?>
							<li class="cpd_stats">
								<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/CPD-Member-Logo-1.png" alt="cpd uk">
							</li>
						<?php } ?>

						<?php

						if (has_term('Quality Licence Scheme Endorsed', 'course-cat', $post)) { ?>
							<li class="cpd_stats">
								<img src="https://www.janets.org.uk/wp-content/uploads/2022/02/QLS_Logo_Colour-1-460x276-1.png" alt="qls">
							</li>
						<?php } else { ?>
							<li class="Support_stats">
								<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Layer-2.png" alt="Tutor support">
								<p>Tutor Support</p>
							</li>
						<?php }
						?>
						<li class="Online_stats">
							<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/Filled-outline.png" alt="fully online">
							<p>Fully Online</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

</section>
<?php if (isAllUsers() || !is_user_logged_in()) { ?>
	<section style="background: #f0fcff;
    box-shadow: 10px 18px 20px rgb(0 0 0 / 2%);
    border-radius: 0px;
    padding: 15px 0 15px;
    margin-top: -40px;">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<ul style="display: flex;
    justify-content: space-between;
    width: 75%;">
						<li><a class="smooth-scrolling" href="#content">Overview</a></li>
						<li><a class="smooth-scrolling" href="#course-curriculum">Content</a></li>
						<li><a class="smooth-scrolling" href="#course-reviews">Reviews</a></li>
						<li><a class="smooth-scrolling" href="#Benefits">Benefits</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<?php } else { ?>

	<section style="height: 40px;border-bottom: 1px solid #e5e5e5;">
		<div id="item-nav">
			<div class="<?php echo vibe_get_container(); ?>">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>
						<?php bp_get_options_nav(); ?>
						<?php

						if (function_exists('bp_course_nav_menu'))
							bp_course_nav_menu();


						?>
						<?php do_action('bp_course_options_nav'); ?>
					</ul>
				</div>
			</div><!-- #item-nav -->
		</div>
	</section>
<?php } ?>
<section id="content">
	<div id="buddypress">
		<div class="<?php echo vibe_get_container(); ?>">
			<?php do_action('bp_before_course_home_content'); ?>
			<div class="row">
				<div class="col-md-9">