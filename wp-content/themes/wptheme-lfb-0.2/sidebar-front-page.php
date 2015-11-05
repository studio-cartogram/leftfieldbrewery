<?php // *************************************** //
     //  Brew Finder
    // *************************************** // ?>

<h3 class="rule-left mobile-divide text-center">Try Left Field </h3>
<section class="rule-left border-bottom vendor-listing bg-cream ">		
    <a href="<?php echo get_bloginfo('url') ?>/brew-finder" class="link--brew-finder">        
        <i class="icon-tap"></i>
        Locate our beer at a bar, brewpub, restaurant or LCBO new you.<br/>
    </a>
</section> 

<?php // *************************************** //
     //  MVP 
    // *************************************** // ?>

<?php 

$mvp = get_field('mvp', 'option');

if( $mvp): 

$post = $mvp;

$permalink = get_permalink( $post->ID );
$color = get_post_meta( $post->ID, '_cartogram_color_value', TRUE );
$title = get_the_title( $post->ID);
$tagline = get_post_meta( $post->ID, '_cartogram_short_description_value', TRUE );
?>

<h3 class="rule-left mobile-divide  text-center">MVP</h3>
<section class="mvp rule-left" style="background:<?php echo $color; ?>">
    <a class="light double-bordered border-bottom " href="<?php echo $permalink; ?>">
        <h2 class="beer-name beer-block light"><?php echo $title; ?></h2>
        <?php echo '<h3 class="light beer-tagline">' . $tagline . '</h3>'; ?>
    </a>
</section> 

<?php endif; ?>

<?php // *************************************** //
     //  Highlight Reel 
    // *************************************** // ?>

<h3 class="rule-left mobile-divide  text-center">Hightlight Reel</h3>

<?php global $myExcerptLength;

$query = new WP_Query('showposts=1');

while ($query->have_posts()): $query->the_post();?>

<div class="row homehighlightreel">
    <div class="double-bordered columns twelve">
        <div class="row border-top border-bottom ">
            <div class="columns eight format-text bg-cream rule-right bg-cream">
                <p class="collapse text-small"><?php the_date('jS F, Y'); ?></p>
            </div>
        </div>
        <div class="row border-bottom">
            <div class="space-inner-top space-inner-bottom columns format-text twelve rule-right bg-cream">
                <h5 class="space-bottom"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <?php the_excerpt(); ?>
                <?php  more_link(); ?>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>




