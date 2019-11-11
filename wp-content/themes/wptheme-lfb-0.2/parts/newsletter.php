<?php

$newsletter_text_field = get_field('newsletter_text', 'options');
$newsletter_button_text_field = get_field('newsletter_button_text', 'options');
$newsletter_text = $newsletter_text_field ? $newsletter_text_field : "Sign up to our Clubhouse Report<br/> for brewery news and events.";
$newsletter_button_text = $newsletter_button_text_field ? $newsletter_button_text_field : "Sign up";

echo '<form class="newsletter" action="//fondfolio.us13.list-manage.com/subscribe/post?u=65e81a3fa309924ed7ff3fd68&amp;id=fb444d9189" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">';

  echo '<div>';

    echo '<span class="heading heading--4">' . $newsletter_text . '</span>';

  echo '</div>';

  echo '<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_65e81a3fa309924ed7ff3fd68_fb444d9189" tabindex="-1" value=""></div>';

  echo '<div class="combined-input">';

    echo '<label for="mce-EMAIL" class="newsletterform__label label">';

      echo '<input required placeholder="' . 'Type your email address...' . '" type="email" value="" name="EMAIL" class="newsletterform__input input" id="mce-EMAIL">';

    echo '</label>';

    echo '<button class="button beercard__button button--secondary newsletterform__button ">';

      echo $newsletter_button_text;

    echo '</button>';

  echo '</div>';

echo '</form>';
