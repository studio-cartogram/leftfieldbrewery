<?php global $myExcerptLength, $page_number, $offset, $query_part, $rootURL, $rootURL2;?>
<?php $myExcerptLength = 20; ?>
<div class="row collapse highlights">
	<div class="columns four">
		<?php get_sidebar('highlights'); ?>
	</div>
	<div class="columns eight">	
		<?php for ($i = 0; $i < 3; $i++) { ?>
			<div class="row">
				<?php
				$offset += $i*2;
				$query = new WP_Query($query_part . $offset);
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
				<?php if ($page_number == 2 || $page_number == 1) {
					echo '<a href="'.get_site_url(). $rootURL . '" class="highlightPagination">newer</a>';
				} else {
					echo '<a href="' . get_site_url() . $rootURL2 . ($page_number - 1) . '" class="highlightsPagination">newer</a>';
				}  ?>
			</div>
			<div class="columns five">
				<a href="<?php echo get_site_url() ?><?php echo $rootURL2 ?><?php echo $page_number + 1 ?>" class="highlightsPagination">older</a>
			</div>
			<div class="columns one">
				right
			</div>
		</div>
	</div>
</div>
<?php $myExcerptLength = 0; ?>