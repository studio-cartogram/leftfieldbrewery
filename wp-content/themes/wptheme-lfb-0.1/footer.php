<?php $options = get_option('lfb_theme_options');?> 
<section class="container footer" id="container-footer">
	<div class="row">
		<div class="columns six hook rule-right-white">
			<?php gravity_form('Newsletter', true, true, false, '', true, 300); ?>
		</div>
		<div class="columns three mobile-two">
			<div class="row">
				<div class="columns twelve rule-right-white">
					<h3>Get in touch</h3>
					<ul class="no-bullet text-small">
						<li><?php echo '<a href="mailto:'. $options['email'] . '">' . $options['email'] . '</a>' ; ?></li>
						<li><?php echo $options['phone']; ?></li>
					</ul>	
				</div>
			</div>
			<div class="row">
				<div class="columns twelve rule-right-white border-top-white">
					<h3>Share</h3>
					<?php $socialnav = array(
						'theme_location'  => 'social',
						'container'       => 'false', 
						'menu_class'      => 'nav', 
						'menu_id'         => 'social',
						'echo'            => true,
						'fallback_cb'     => ''
						); 
						wp_nav_menu( $socialnav ); 
					?>
				</div>
			</div>
		</div>
		<div class="columns three mobile-two rule-inside-right-white">
			<h3><a class="icon-twitter icon-with-space" href="">Chatter</a></h3>
			<div id='twitter'></div>
		</div>
	</div>
</section>
<section class="container credit" id="container-credit">
	<div class="row">
		<div class="six columns">
			<p>&copy; <?php echo Date(Y) . ' ' . get_bloginfo('name') . ' ◆ ' . get_bloginfo('description'); ?></p>
		</div>
		<div class="six columns">
			<?php $footernav = array(
				'theme_location'  => 'footer',
				'container'       => 'false', 
				'menu_class'      => 'nav', 
				'menu_id'         => 'nav-social',
				'echo'            => true,
				'fallback_cb'     => ''
				); 
				wp_nav_menu( $footernav ); 
			?>
		</div>
	</div>
</section>	
<div id="loader"></div>