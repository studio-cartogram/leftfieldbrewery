<?php global $myExcerptLength, $page_number, $offset, $query_part, $rootURL, $rootURL2;?>
<?php $myExcerptLength = 20; ?>
<div class="row  highlights ">
	
	<div class="columns eight push-four rule-left" id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>	
		<h3 class="rule-right text-center">Latest News, Brews &amp; Events</h3>
		<div class="row collapse flushed-left">
			<div class="columns twelve bg-cream post-meta double-bordered">
				<h4 class="rule-right"> Category <span>Events</span></h4>
			</div>
		</div>

		<?php for ($i = 0; $i < 3; $i++) { ?>
			<div class="row flushed-left collapse">
				<?php
				$offset += $i*2;
				$query = new WP_Query($query_part . $offset);
				while ($query->have_posts()): $query->the_post(); ?>
					<div class="columns six format-text rule-right bg-cream">
						<?php get_template_part("parts/content/content", "summary"); ?>
					</div>	
				<?php endwhile;
				?>
			</div>
		<?php }	?>
		<div class="row flushed-left collapse border-top border-bottom">
			<div class="columns one rule-right bg-navy">
				<a class="direction-nav"><i class="icon-arrow-left"></i></a>
			</div>
			<div class="columns five rule-right border-bottom bg-cream">
				<?php if ($page_number == 2 || $page_number == 1) {
					echo '<a class="button-link expand button" href="'.get_site_url(). $rootURL . '">newer</a>';
				} else {
					echo '<a class="button-link expand button" href="' . get_site_url() . $rootURL2 . ($page_number - 1) . '">newer</a>';
				}  ?>
			</div>
			<div class="columns five rule-right border-bottom bg-cream">
				<a class="button-link expand button" href="<?php echo get_site_url() ?><?php echo $rootURL2 ?><?php echo $page_number + 1 ?>" class="highlightsPagination">
					Older
				</a>
			</div>
			<div class="columns one rule-right rule-left bg-navy">
				<a class="direction-nav" href="<?php echo get_site_url() ?>/page/2/" class="highlightsPagination"><i class="icon-arrow-right"></i></a>
			</div>
		</div>
	</div>
	<div class="columns pull-eight four">
		<?php get_sidebar('highlights'); ?>
	</div>
</div>
<?php $myExcerptLength = 0; ?>