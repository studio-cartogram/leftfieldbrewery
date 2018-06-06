<?php
    global $slug;
$players = new WP_Query( array(
    "posts_per_page" => -1,
    "post_type" => "players"
) );
$jobs = new WP_Query( array(
    "posts_per_page" => -1,
    "post_type" => "jobs"
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
							<a class="flip button-flip" id="to-back" href="#"></a>
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

                    <?php
                        // wrigley
                        $name = get_field('wrigley_title', 'options');
                        $tagline = get_field('wrigley_tagline', 'option');
                        $image = get_field('wrigley_headshot', 'option');
                        $handle = get_field('wrigley_handle', 'option');
                       ?>
                        <li class="players__card card-players wrap">
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front bg-cover" style="background-image:url(<?php echo $image['url']?>)"></div>
                                </div>
                            </div>
                            <div class="player-card__info text-center ">
<?php
                                echo '<h3 class="player-card__name">' . $name . '</h3>';
                                echo ($tagline ? '<h4 class="player-card__title">' . $tagline . '</h4>' : '');
                                echo ($handle ? '<a class="player-card__contact" target="_blank" href="http://twitter.com/' . $handle . '">Follow  @' . $handle . '</a>' : '');
?>
                        </div>
                    </li>
                <?php 
                    while ($jobs->have_posts()) :$jobs->the_post();

                    $email = get_field('email');
                    $title = get_field('title');
                    $placeholder = get_bloginfo("stylesheet_directory") . '/dist/images/placeholder-jobs.svg';
                    $image = (has_post_thumbnail() ? wp_get_attachment_image_url( get_post_thumbnail_id(), 'cartogram_player_cropped' ) : $placeholder);
                    ?>

					<li class="players__card card-players wrap">
						<div class="flip-container">
                             <?php echo (get_the_content() ? '<a class="flip" id="to-back" href="#"><i class="icon-flip-right"></i></a>' : '');?>
							<div class="flipper">
                                <div class="front " style="background-image:url(<?php echo $image ?>)"></div>
                                <div class="back"><?php the_content(); ?></div>
                            </div>
                        </div>
                        <div class="player-card__info text-center ">
                            <?php
                                echo '<h3 class="player-card__name">' . get_the_title() . '</h3>';
                                echo ($title ? '<h4 class="player-card__title">' . $title . '</h4>' : '');
                                echo ($email ? '<a class="player-card__contact" href="mailto:' . $email . '">Apply for This Position</a>' : '');
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
