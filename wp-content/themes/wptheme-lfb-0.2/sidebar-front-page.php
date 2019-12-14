<?php if (have_rows('callout')) : ?>

    <?php while (have_rows('callout')) : the_row();
            $heading = get_sub_field('callout_heading');
            $image = get_sub_field('callout_image');
            $text = get_sub_field('callout_text');
            $link = get_sub_field('callout_link');
            ?>

        <div class="callout rule-left">

            <h3 class="rule-left mobile-divide text-center"><?php echo $heading; ?></h3>

            <section style="background-image: url(<?php echo $image; ?>);" class="rule-left callout-borders callout__inner bg-cream">
                <a href="<?php echo $link; ?>" class="link--bordered link--brew-finder  link--callout-module">
                    <?php echo $text; ?><br />
                </a>
            </section>

        </div>

    <?php endwhile; ?>

<?php endif; ?>

<?php // *************************************** //
//  MVP
// *************************************** // 
?>

<?php

$mvp = get_field('mvp');

if ($mvp) :
    echo '<h3 class="rule-left mobile-divide text-center">MVP</h3>';
    set_query_var('item', $mvp);
    set_query_var('cols', 'col-12');
    set_query_var('additional_classes', 'item--sidebar');
    get_template_part('parts/content/content', 'beer');
endif;

?>