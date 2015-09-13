<p class="border-bottom border-top collapse text-small">
	<strong><?php the_time('jS F, Y'); ?></strong>
</p>
<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
<?php the_excerpt(); ?>
<?php more_link(); ?>
