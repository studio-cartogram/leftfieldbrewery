<?php global $slug;
?>
<div class="row  ">
	<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four mobile-flush rule-left"); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
        <?php get_template_part('parts/slideshows/slideshow'); ?>
        <div class="row">
            <div class="columns twelve atthebrewery">
				<div class="row flushed-left collapse">
					<div class="columns double-bordered twelve  ">
						<h3 class="soft text-center rule-right ">At the Brewery</h3>
					</div>
				</div>
				<div class="row text-center flushed-left collapse">
                    <?php
                        $posts = get_posts(array(
                            'post_type' => 'beers',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key' => 'at_the_brewery',
                                    'value' => '1',
                                    'compare' => '=='
                                )
                            )
                        ));

                    if( $posts ) { ?>
                                <div class="atthebrewery__heading-row row border-top border-bottom collapse"> 
                                    <div class="text-left columns atb__col--large  ">
                                        <span class="delta soft-quarter soft-half--left">Beer</span>
                                    </div>
                                    <div class="columns hide-for-small atb__col--medium "> 
                                        <span class="delta soft-quarter">Style</span>
                                    </div>
                                    <div class="columns atb__col--small"> 
                                        <span class="delta soft-quarter">Can</span>
                                    </div>
                                    <div class="columns atb__col--small ">
                                        <span class="delta soft-quarter">Bottle</span>
                                    </div>
                                    <div class="columns atb__col--small rule-right">
                                        <span class="delta soft-quarter">Tap</span>
                                    </div>
                                </div>
                                <?php foreach( $posts as $post ) {
                                setup_postdata( $post );
                                $color = get_post_meta( $post->ID, '_cartogram_color_value', TRUE ); ?>

                                <div class="row atthebrewery__row collapse"> 

                                    <div style="color: <?php echo $color; ?>" class="columns atb__col--large text-left rule-right">
                                        <svg class="icon--small beer-icon"><use xlink:href="#<?php echo $post->post_name; ?>-color"></use></svg>
                                        <?php the_title('<span class="beta soft-double--left beer-title">', '</span>');?>
                                    </div>
                                    <div class="columns atb__col--medium hide-for-small  rule-right">
                                        <?php echo '<span class="centered zeta">' . get_post_meta( $id, '_cartogram_short_description_value', TRUE ) . '</span>' ;?>
                                    </div>
                                    <div class="columns atb__col--small rule-right ">
                                        <?php echo (get_field('in_cans') ? '<span class="check-text">In Cans</span><span class="check"></span>' : '&nbsp;'); ?>
                                    </div>
                                    <div class="columns atb__col--small rule-right ">
                                        <?php echo (get_field('in_bottles') ? '<span class="check-text">In Bottles</span><span class="check"></span>' : '&nbsp;'); ?>
                                    </div>
                                    <div class="columns atb__col--small rule-right ">
                                        <?php echo (get_field('on_tap') ? '<span class="check-text">On Tap</span><span class="check"></span>' : '&nbsp;');?>
                                    </div>
                                </div>
                            <?php }
                            wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
                        }

                    ?>
				</div>
            </div>
        </div>
		<div class="row">
			<div class="columns seven rule-right">
				<div class="row">
					<div class="columns double-bordered twelve space-inner-top space-inner-bottom text-center">
						<h3>Highlight Reel</h3>
					</div>
				</div>
				<div class="row homehighlightreel">
					<div class="columns twelve">
						<?php
						global $myExcerptLength;
						$query = new WP_Query('showposts=1');
						while ($query->have_posts()): $query->the_post();?>
							<div class="row border-top border-bottom ">
								<div class="columns six format-text bg-cream rule-right bg-cream">
									<p class="collapse text-small"><?php the_date('jS F, Y'); ?></p>
								</div>
							</div>
							<div class="row border-bottom">
								<div class="columns format-text twelve rule-right equal-height border-bottom bg-cream">
									<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<?php the_excerpt(); ?>
									<?php  more_link(); ?>
								</div>
							</div>		
						<?php endwhile;
						?>
					</div>
				</div>
			</div>
			<div class="columns five rule-inside-right">
				<div class="row row-flush-left">
					<div class="double-bordered-inside columns twelve mobile-divide space-inner-top space-inner-bottom text-center">
						<h3>MVP</h3>
					</div>
				</div>
				<div class="row flushed-left collapse">
					<?php 
                        $mvp = get_field('mvp', 'option');

                        if( $mvp): 

	                        $post = $mvp;
	                        setup_postdata( $post ); 

								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								$permalink = get_permalink( $post->ID );
								$color = get_post_meta( $post->ID, '_cartogram_color_value', TRUE );
                            ?>
                        <div class="mobile-flush equal-height rule-right border-bottom columns twelve mvp space-inner-bottom text-center border-top" style="background:<?php echo $color; ?>">
                                <a class="light" href="<?php echo $permalink; ?>">
                                    <h2 class="beer-name beer-block light"><?php the_title(); ?></h2>
                                    <?php echo '<h3 class="light beer-tagline">' . get_post_meta( $id, '_cartogram_short_description_value', TRUE ) . '</h3>';?>
                                    <?php more_link() ?>
                                </a>
                        </div>
                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                       <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="columns four sidebar pull-eight mobile-flush">
		<?php if (is_front_page()) {
			get_sidebar('front-page'); 
		} elseif (is_home()) { 
			get_sidebar('home');
		} else {
			get_sidebar($slug);
		} ?>
	</div>
</div>
