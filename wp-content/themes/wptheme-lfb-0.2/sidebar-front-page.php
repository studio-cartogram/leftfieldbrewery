<?php // *************************************** //
     //  Brew Finder
    // *************************************** // ?>

<h3 class="rule-left mobile-divide sidebar-title text-center">Try Left Field </h3>
<section class="rule-left border-bottom vendor-listing bg-cream ">		
    <a href="<?php echo get_bloginfo('url') ?>/brew-finder" class="link--bordered link--brew-finder">        
        <i class="icon-tap"></i>
        Locate our beer at a bar, brewpub, restaurant or LCBO near you.<br/>
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
    <div class="double-bordered">
    <a class="link--bordered light border-bottom " href="<?php echo $permalink; ?>">
        <svg class="icon--medium"><use xlink:href="#<?php echo $post->post_name ?>"></use</svg>
        <h2 class="beer-name beer-block light"><?php echo $title; ?></h2>
        <?php echo '<h3 class="light beer-tagline">' . $tagline . '</h3>'; ?>
    </a>
    </div>
</section> 

<?php endif; ?>

<?php // *************************************** //
     //  Highlight Reel 
    // *************************************** // ?>

<h3 class="rule-left mobile-divide sidebar-title text-center">Hightlight Reel</h3>

<?php global $myExcerptLength;

$query = new WP_Query('showposts=1');

while ($query->have_posts()): $query->the_post();?>

<div class="row homehighlightreel">
    <div class="double-bordered columns twelve">
        <div class="row border-top border-bottom ">
            <div class="columns rule-right eight format-text bg-cream ">
                <p class="collapse text-small"><?php the_date('jS F, Y'); ?></p>
            </div>
        </div>
        <div class="row border-bottom">
            <div class="space-inner-top space-inner-bottom columns format-text twelve bg-cream">
                <h5 class="space-bottom"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <?php the_excerpt(); ?>
                <?php  more_link(); ?>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php // *************************************** //
     //  Wriggley
    // *************************************** // ?>

<h3 class="rule-left mobile-divide sidebar-title text-center">Mascot</h3>

<?php
    $name = get_field('wrigley_title', 'options');
    $tagline = get_field('wrigley_tagline', 'option');
    $image = get_field('wrigley_headshot', 'option');
    $handle = get_field('wrigley_handle', 'option');
?>
<div class="row wrigley">
    <div class="border-bottom space-inner-bottom bg-cream double-bordered columns twelve text-center">
        <div class="row border-top border-bottom ">
            <div class="columns format-text bg-cream ">
                <p class="collapse text-small">&nbsp;</p>
            </div>
        </div>
        <div class="wrigley__inner">
            <?php 
            if( !empty($image) ): ?>
                <img class="img-round" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            <?php endif; ?>
            <h5 class="upcase"><?php echo $name; ?></h5>
            <p class="lead"><?php echo $tagline; ?></p>
            <p class="lead"><a class="strong" href="http://instagram.com/<?php echo $handle ?>">Follow @<?php echo $handle ?></a></p>
    </div>
    </div>
</div>
