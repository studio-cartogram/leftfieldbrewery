<?php global $slug;
?>
<div class="row">
  <div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four mobile-flush rule-left"); ?>>
    <?php the_title('<h3 class="rule-right text-center">', '</h3>') ?>
    <div class="instagrams" id="instafeed"></div>
    <div class="row">
      <div class="columns twelve atthebrewery">
        <div class="row flushed-left collapse">
          <div class="columns double-bordered twelve  ">
            <h3 class="soft text-center rule-right ">At the Brewery</h3>
          </div>
        </div>
        <div class="row atthebrewery__table text-center flushed-left collapse">

          <?php $posts = get_field('beers_at_the_brewery', 'option');

          if ($posts) : ?>
            <div class="atthebrewery__heading-row row border-top border-bottom collapse">
              <div class="text-left columns atb__col--large  ">
                <span class="delta soft-quarter soft-half--left">Beer</span>
              </div>
              <div class="columns hide-for-small atb__col--medium ">
                <span class="delta soft-quarter">Style</span>
              </div>
              <div class="columns atb__col--small ">
                <span class="delta soft-quarter">Can</span>
              </div>
              <div class="columns atb__col--small ">
                <span class="delta soft-quarter">Bottle</span>
              </div>
              <div class="columns atb__col--small rule-right">
                <span class="delta soft-quarter">Tap</span>
              </div>
            </div>
            <?php while (the_repeater_field('beers_at_the_brewery', 'option')) :
                $beer = get_sub_field('beer');
                $beer_icon = get_sub_field('beer_icon');
                $link = get_sub_field('link') ? get_sub_field('link') : get_permalink($beer->ID);
                $icon_image = get_field('icon', $beer_icon);
                $beer_color = get_field('color', $beer->ID);
                $short_description = get_field('short_description', $beer->ID);
                ?>

              <a href="<?php echo $link ?>" class="row atthebrewery__row collapse">
                <div style="color: <?php echo $beer_color; ?>" class="columns atb__col--large text-left rule-right">
                  <?php echo '<span class="beta soft--left beer-title heading heading--3">' . get_the_title($beer->ID) . '</span>'; ?>
                </div>
                <div class="columns atb__col--medium hide-for-small  rule-right">
                  <?php echo '<span class="centered zeta">' . $short_description . '</span>'; ?>
                </div>
                <div class="columns atb__col--small rule-right ">
                  <?php echo (get_sub_field('in_cans') ? '<span class="check-text">In Cans</span><span class="check"></span>' : '&nbsp;'); ?>
                </div>
                <div class="columns atb__col--small rule-right ">
                  <?php echo (get_sub_field('in_bottles') ? '<span class="check-text">In Bottles</span><span class="check"></span>' : '&nbsp;'); ?>
                </div>
                <div class="columns atb__col--small rule-right ">
                  <?php echo (get_sub_field('on_tap') ? '<span class="check-text">On Tap</span><span class="check"></span>' : '&nbsp;'); ?>
                </div>
              </a>
          <?php
            endwhile;
          endif; ?>

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