<?php
/**
 * Template Name: Page
 */
?>

<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?> 
<div class="container" id="container-slider">
	<div class="row">
		<div class="columns twelve">
			<div class="row  <?php echo $slug; ?>">
				<div class="columns eight push-four rule-left mobile-flush">	
					<h3 class="rule-right text-center">404: Page Not Found</h3>
					<div class="row flushed-left collapse">
						<div class="column twelve rule-right">
							<div class="post-text double-bordered  text-center border-bottom space-inner-bottom-xlarge">
								<h1>Woah Slugger! You may have hit this one off the map!</h1>
								<p class="space-bottom">Don't worry...it happens to the best of us.</p> 
								<h3 class="double-bordered space-top-large space-inner-top-large ">Here are some pointers to help get your head back in the game:</h3>
								<ul class="no-bullet space-inner-bottom" >
									<li><a href="<?php bloginfo('url') ?>">Go Home</a></li>
									<?php $options = get_option('lfb_theme_options');?> 
									<li><a href="mailto:<?php echo $options['email'] ?>">Email Us</a></li>
									<li><a href="<?php bloginfo('url') ?>/about-us">Learn More About Us</a></li>
								</ul>
									<p class="no-bullet border-top space-inner-top-large">Also, you can check out our
									<?php 
									$contact_options = array(
										"facebook"=>"Facebook",
										"instagram"=>"Instagram",
										"twitter"=>"Twitter");
									foreach($contact_options as $medium=>$actionVerb) {
										switch($actionVerb) {
												// $open_wrapper = '<a href="">';
												// $closing_wrapper = '</a>';	
												//<a href=”http://twitter.com/home?status=Put your message here and include your username ala @johnmccrory”>Tweet this</a>
											case "talk":
												$open_wrapper = '<a href="tel:' . $options[$medium] . '">';
												$closing_wrapper = '</a>';
												break;
											case "write":			
												$open_wrapper = '<a href="mailto:' . $options[$medium] . '">';
												$closing_wrapper = '</a>';
												break;
											case "Twitter":
												$open_wrapper = 'or <a target="_blank" href="http://twitter.com/home?status=' . $options[$medium] . '">';
												$closing_wrapper = '</a>';	
												break;
											case "toast":
											case "Instagram":
											case "Facebook":
												$open_wrapper = '<a target="_blank" href="http://' . $options[$medium] . '">';
												$closing_wrapper = '</a>, ';
												break;
											default:
												$open_wrapper = "";
												$closing_wrapper= "";
											break;
										}
										?>
											<?php echo $open_wrapper; ?>
											<?php echo $actionVerb ?>
											<?php echo $closing_wrapper; ?>
										<?php

									}
									?>
									profiles to catch the highlights!
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="columns sidebar four pull-eight mobile-flush">
					<?php get_sidebar('contact-us');  ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>