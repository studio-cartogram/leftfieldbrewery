<?php $options = get_option('rsof_theme_options');?> 
<section class="container" id="container-footer">
	<div class="row">
		<div class="columns four hook">
			<ul class="no-bullet text-small">
				<li><?php echo $options['address']; ?></li>
				<li><?php echo $options['address2']; ?></li>
			</ul>	
		</div>
		<div class="columns four">
			<ul class="no-bullet text-small">
				<li>office: <?php echo $options['office_phone']; ?></li>
				<li>mobile: <?php echo $options['mobile_phone']; ?></li>
			</ul>	
		</div>
		<div class="columns four end">
			<ul class="no-bullet text-small">
				<li><?php echo '<a href="mailto:'. $options['email'] . '">' . $options['email'] . '</a>' ; ?></li>
				<li><?php echo '<a href="mailto:'. $options['email2'] . '">' . $options['email2'] . '</a>' ; ?></li>
			</ul>	
		</div>
	</div>
</section>