<?php $options = get_option('lfb_theme_options');?> 
<h3 class="rule-left text-center ">Ways to Get in Touch </h3>
	<div class="row collapse flushed-right">
		<div class="columns twelve double-bordered">
		<ul class="list-contact ">
			<?php 
			$contact_options = array("phone"=>"talk",
				"email"=>"write",
				"twitter"=>"tweet",
				"facebook"=>"like",
				"untappd"=>"toast",
				"instagram"=>"follow");
			foreach($contact_options as $medium=>$actionVerb) {
				echo "<li class='row collapse bg-cream'>";
					echo "<div class='columns rule-left mobile-one three bg-navy border-bottom-white'><h4 class='text-center light'>" . $actionVerb . "</h4></div>";
					echo "<div class='columns mobile-three nine format-text '><h5>" . $options[$medium] . "</h5></div>";
				echo "</li>";
			}
			?>
		</ul>
	</div>
</div>		
	