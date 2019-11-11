<?php

$options = get_option('lfb_theme_options');
$notes = get_field('notes' , 'option');
$first_row = $notes[0];
$second_row = $notes[1];
$first_row_text = $first_row['text' ];

get_template_part('parts/newsletter');

echo '<footer class="footer">';

  echo '<div class="grid footer--secondary">';

    echo '<div class="col col-8-tablet">';

      echo '<ul class="mono footer__list list--small list list--narrow">';

        echo '<li>';
        
          echo '<a class="block" href="mailto:'. $options['email'] . '">' . $options['email'] . '</a>';

          echo '<a class="" href="mailto:'. $options['phone'] . '">' . $options['phone'] . '</a>';
        
        echo '</li>';
        
        echo '<li><a href="http://maps.google.com/?q=36 Wagstaff Drive Toronto, ON  M4L 3W9">36 Wagstaff Drive<br>Toronto, ON  M4L 3W9</a></li>';
      
        echo '<li>&copy; ' . Date('Y') . ' ' . get_bloginfo('name') . '<a class="block" target="_blank" href="http://www.studiocartogram.com">Website by Cartogram Inc.</a></li>';

      echo '</ul>';

    echo '</div>';

    echo '<div class="col col-4-tablet">';
    
    cartogram_share();

    echo '</div>';

  echo '</div>';

echo '</footer>';
?>
