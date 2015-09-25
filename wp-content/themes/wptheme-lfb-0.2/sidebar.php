<h3 class="rule-left mobile-divide text-center">Try LeftField </h3>
<section class="vendor-listing bg-cream">		
	<p class="lead"><i class="icon-tap"></i>Find out beer at these all-star establishments.</p>
	<ul>
		<?php get_template_part('parts/loops/loop', 'vendor') ?>
	</ul>
	<div class="row collapse flushed-right">
		<div class="columns twelve double-bordered">
			<?php $options = get_option('lfb_theme_options');?> 
			<a href="mailto:<?php echo $options['email'] ?>" class="button expand">Pitch Left Field at Your Local</a>
		</div>
	</div>	
</section> 