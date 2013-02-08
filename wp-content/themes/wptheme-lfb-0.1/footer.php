<?php $options = get_option('rsof_theme_options');?> 
<section class="container bg-main" id="container-footer">
	<div class="row" id="footer">
		<div class="columns six">
				Form
		</div>
		<div class="columns three">
			<div class="row">
				<div class="columns twelve">
					<h3 class="light">Get In Touch</h3>
					<ul class="no-bullet text-small">
						<li><?php echo $options['office_phone']; ?></li>
						<li><?php echo '<a href="mailto:'. $options['email'] . '">' . $options['email'] . '</a>' ; ?></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="columns twelve">
					<h3 class="light">Tell All Your Friends</h3>
					<?php cartogram_share() ?>
				</div>
			</div>

		</div>
		<div class="columns three end">
			<ul class="no-bullet text-small">
				<li><?php echo '<a href="mailto:'. $options['email'] . '">' . $options['email'] . '</a>' ; ?></li>
				<li><?php echo '<a href="mailto:'. $options['email2'] . '">' . $options['email2'] . '</a>' ; ?></li>
			</ul>	
		</div>
	</div>
</section>