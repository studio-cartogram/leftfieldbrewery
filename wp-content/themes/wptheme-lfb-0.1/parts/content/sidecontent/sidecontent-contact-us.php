<?php $options = get_option('lfb_theme_options');?> 
<div class="rows">
	<div class="columns twelve">
		<ul>
			<?php 
			$contact_options = array("phone"=>"talk",
				"email"=>"write",
				"twitter"=>"tweet",
				"facebook"=>"like",
				"untappd"=>"toast",
				"instagram"=>"follow");
			foreach($contact_options as $medium=>$actionVerb) {
				echo "<li>" . $actionVerb . " - " . $options[$medium] . "</li>";
			}
			?>
		</ul>
	</div>
</div>