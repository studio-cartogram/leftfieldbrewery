<?php global $slug;
?>
<div class="row slide-row">
<div class="columns twelve">
<div class="row  ">
    <div class="columns twelve">
        <?php the_title('<h3 class="rule-left rule-right text-center">','</h3>') ?>
        <div class="brew-finder" id="map">
            <?php get_template_part('parts/shared/loader');?>
        </div>
    </div>
</div>
</div>
</div>
