<?php
    global $slug;
$players = new WP_Query( array(
    "posts_per_page" => -1,
    "post_type" => "players"
) );
?>

<div class="row  <?php echo $page_title; ?>">
	<div id="post-<?php the_ID(); ?>" <?php post_class('columns eight push-four rule-left mobile-flush'); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
		<div class="row flushed-left collapse">
			<div class="column twelve rule-right">
			    <ul class="block-grid mobile three-up players">

                <?php 
                    while ($players->have_posts()) :$players->the_post();

                    $email = get_field('email');
                    $title = get_field('title');
                    $placeholder = get_bloginfo("stylesheet_directory") . '/dist/images/placeholder.png';
                    $image = (has_post_thumbnail() ? wp_get_attachment_image_url( get_post_thumbnail_id(), 'cartogram_player_cropped' ) : $placeholder);
                    $first_name = preg_split("/[\s,]+/", get_the_title());
                    ?>

					<li class="players__card card-players wrap">
						<div class="flip-container">
							<a class="flip" id="to-back" href="#"><i class="icon-flip-right"></i></a>
							<div class="flipper">
                                <div class="front bg-cover" style="background-image:url(<?php echo $image ?>)"></div>
                                <div class="back"><?php the_content(); ?></div>
                            </div>
                        </div>
                        <div class="player-card__info text-center ">
                            <?php
                                echo '<h3 class="player-card__name">' . get_the_title() . '</h3>';
                                echo ($title ? '<h4 class="player-card__title">' . $title . '</h4>' : '');
                                echo ($email ? '<a class="player-card__contact" href="mailto:' . $email . '">Contact ' . $first_name[0] . '</a>' : '');
                            ?>
                        </div>
                    </li>
				    <?php endwhile; ?>
			    </ul>
			</div>
		</div>
	</div>
	<div class="sidebar columns four pull-eight mobile-flush">
        <?php  wp_reset_postdata();
            get_sidebar($slug); ?>
	</div>
</div>
