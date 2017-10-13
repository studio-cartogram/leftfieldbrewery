<?php 
$options = get_option('lfb_theme_options');
$notes = get_field('notes' , 'option'); // get all the rows
$first_row = $notes[0]; // get the first row
$second_row = $notes[1]; // get the first row
$first_row_text = $first_row['text' ]; // get the sub field value 
$second_row_text = $second_row['text' ]; // get the sub field value 
?> 
<section class="container footer" id="container-footer">
	<div class="row first-row">
		<div class="columns six hook rule-outside-right-white">
			<?php if( function_exists('gravity_form') ) : ?>
			<div class="row">
				<div class="columns twelve">
					<?php gravity_form('Newsletter', true, true, false, '', true, 0); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<div class="columns six rule-inside-right-white">
			<div class="row">
				<div class="columns five insides rule-outside-right-white">
					<div class="row">
						<div class="columns twelve">
							<h3>Get in touch</h3>
							<ul class="no-bullet text-small">
								<li><?php echo '<a href="mailto:'. $options['email'] . '">' . $options['email'] . '</a>' ; ?></li>
								<li><?php echo $options['phone']; ?></li>
								<li>—</li>
								<li><?php echo $first_row_text ?></li>
								<li>—</li>
								<li><?php echo $second_row_text ?></li>
							</ul>	
						</div>
					</div>
				</div>
				<div class="columns seven insides ">
					<div class="row">
						<div class="columns twelve">
							<h3><a class="icon-twitter icon-with-space" target="_blank" href="http://www.twitter.com/lfbrewery">Chatter</a></h3>
							<div id='twitter'></div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>
<section class="container credit" id="container-credit">
	<div class="row">
		<div class="six columns">
			<p>&copy; <?php echo Date(Y) . ' ' . get_bloginfo('name') . ' ◆ ' . 'website by <a class="light" target="_blank" href="http://www.studiocartogram.com">Cartogram Inc.</a>' ?></p>
		</div>
		<div class="columns six">
			<div class="columns three">
				<p class="">Tell your friends</p>
			</div>
			<div class="columns nine">
				<?php cartogram_share() ?>
			</div>
		</div>
	</div>
</section>	
