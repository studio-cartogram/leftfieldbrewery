<?php $options = get_option('lfb_theme_options');?> 
<section class="container footer" id="container-footer">
	<div class="row">
		<div class="columns six hook">
			<?php gravity_form('Newsletter', false, false, false, '', true, 300); ?>
		</div>
		<div class="columns three">
			<div class="row">
				<div class="columns twelve">
					<h4>Get in touch</h4>
					<ul class="no-bullet text-small">
						<li><?php echo '<a href="mailto:'. $options['email'] . '">' . $options['email'] . '</a>' ; ?></li>
						<li><?php echo $options['phone']; ?></li>
					</ul>	
				</div>
			</div>
			<div class="row">
				<div class="columns twelve">
					<h4>Share</h4>
					<?php $globalnav = array(
						'theme_location'  => 'social',
						'container'       => 'false', 
						'menu_class'      => 'nav-skew', 
						'menu_id'         => 'nav-social',
						'echo'            => true,
						'fallback_cb'     => ''
						); 
						wp_nav_menu( $globalnav ); 
					?>
				</div>
			</div>
		</div>
		<div class="columns three">
			<h4>Chatter</h4>
			<?php //the_widget("TTrust_Twitter"); ?>
		</div>
	</div>
	<div class="row">
		<div class="columns">
			© 2013 Left Field Brewery - Proudly Brewed in Toronto, ON Canada
		</div>
	</div>
</section>