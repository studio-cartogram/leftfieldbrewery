<?php global $myExcerptLength, $page_number;?>
<?php $myExcerptLength = 20; ?>
<div class="row collapse">
	<div class="columns four">
		<?php get_sidebar('highlights'); ?>
	</div>
	<div class="columns eight">	
		<?php $offset = 3 + 6*($page_number - 2);?>
		<?php for ($i = 0; $i < 3; $i++) { ?>
			<div class="row">
				<?php
				$offset += $i*2;
				$query = new WP_Query('showposts=2&offset=' . $offset);
				while ($query->have_posts()): $query->the_post();
					get_template_part("parts/content/content", "summary");
				endwhile;
				?>
			</div>
		<?php }	?>
		<div class="row">
			<div class="columns one">
				left
			</div>
			<div class="columns five">
				<?php echo $page ?>
				<?php if ($page == 2) {
					echo '<a href="'.get_site_url().'/highlights">newer</a>';
				} else {
					echo '<a href="' . get_site_url() . '/arch/' . ($page_number - 1) . '">newer</a>';
				}  ?>
			</div>
			<div class="columns five">
				<a href="<?php echo get_site_url() ?>/arch/<?php echo $page_number + 1 ?>">older</a>
			</div>
			<div class="columns one">
				right
			</div>
		</div>
	</div>
</div>
<?php $myExcerptLength = 0; ?>