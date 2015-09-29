<?php global $slug;
?>
<div class="row  ">
	<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four mobile-flush rule-left"); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
        <div class="row">
            <div class="brew-finder" id="map"></div>
        </div>
	</div>
	<div class="columns four sidebar pull-eight mobile-flush">
	<?php get_sidebar('front-page'); ?>
	</div>
</div>
