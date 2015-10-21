<?php $options = get_option('lfb_theme_options');?> 
<h3 class="rule-left text-center ">Ways to Get in Touch </h3>
	<div class="row collapse flushed-right">
		<div class="columns twelve double-bordered">
		<ul class="list-contact ">
			<?php 
            $contact_options = array(
                "phone"=>"talk",
				"email"=>"write",
				"twitter"=>"tweet",
				"facebook"=>"like",
				"untappd"=>"toast",
                "instagram"=>"follow"
            );
			foreach($contact_options as $medium=>$actionVerb) {
				switch($actionVerb) {
						// $open_wrapper = '<a href="">';
						// $closing_wrapper = '</a>';	
						//<a href=”http://twitter.com/home?status=Put your message here and include your username ala @johnmccrory”>Tweet this</a>
					case "talk":
						$open_wrapper = '<a href="tel:' . $options[$medium] . '">';
						$closing_wrapper = '</a>';
						break;
					case "write":			
						$open_wrapper = '<a href="mailto:' . $options[$medium] . '">';
						$closing_wrapper = '</a>';
						break;
					case "tweet":
						$open_wrapper = '<a target="_blank" href="http://twitter.com/home?status=' . $options[$medium] . '">';
						$closing_wrapper = '</a>';	
						break;
					case "toast":
					case "like":
					case "follow":
						$open_wrapper = '<a target="_blank" href="http://' . $options[$medium] . '">';
						$closing_wrapper = '</a>';
						break;
					default:
						$open_wrapper = "";
						$closing_wrapper= "";
					break;
				}
				?>
				<li class='row collapse bg-cream'>
					<?php echo $open_wrapper; ?>
						<div class='columns rule-left mobile-one three bg-navy border-bottom-white'>
							<h4 class='text-center light'>
								<?php echo $actionVerb ?>
							</h4>
						</div>
						<div class='columns mobile-three nine format-text '>
							<h5>
								<?php echo $options[$medium] ?>
							</h5>
						</div>
					<?php echo $closing_wrapper; ?>
				</li>
				<?php

			}
			?>
		</ul>
	</div>
</div>		
<h3 class="rule-left text-center ">Visit Us</h3>
<div class="row collapse flushed-right">
    <div class="columns twelve double-bordered">
        <ul class="list-contact ">
            <li class="row collapse bg-cream">
            <a href="http://maps.google.com/?q=<?php the_field('address_line_1', 'option'); ?><?php the_field('address_line_2', 'option'); ?> ">	
                    <div class="columns rule-left mobile-one three bg-navy border-bottom-white">
                        <h4 class="text-center text-tall light">Location</h4>
                    </div>
                    <div class="columns mobile-three nine format-text ">
                        <h5><?php the_field('address_line_1', 'option'); ?><br/><?php the_field('address_line_2', 'option'); ?></h5>
                    </div>
                </a>
            </li>
            <li class="row collapse bg-cream">
                    <div class="columns rule-left mobile-one three bg-navy border-bottom-white">
                        <h4 class="text-center text-tall light">Hours</h4>
                    </div>
                    <div class="columns mobile-three nine format-text ">
                        <h5><?php the_field('hours', 'option'); ?></h4>
                    </div>
            </li>
        </ul>
    </div>
</div>
<?php if( have_rows('notes', 'option') ): ?>


<div class="row collapse flushed-right">
    <div class="visit-us-section columns twelve bg-cream ">
    <?php while( have_rows('notes', 'option') ): the_row(); ?>
            <div class="visit-us rule-left flush">
                <h4 class="i-block text-center bg-navy soft-quarter text-cream visit-us__label light"><?php the_sub_field('title'); ?></h4>
                <p class="soft-half flush text-center"><?php the_sub_field('text'); ?></p>
            </div>
    <?php endwhile; ?>


    </div>
</div>
<?php endif; ?>
