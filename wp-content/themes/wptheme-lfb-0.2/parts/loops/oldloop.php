<?php
global $slug;
switch($slug) {
	case "about-us":
		$targetIndex = 1;
		break;
	case "beers":
		$targetIndex = 2;
		break;
	case "highlights":
		$targetIndex = 3;
		break;
	case "contact-us":
		$targetIndex = 4;
		break;
	default:
	//404?
		$slug = "home";
		$targetIndex = 0;
		break;
}
?>

<?php
for ($i = 0; $i < 5; $i++) {
?>
	<li class="slideNum<?php echo $i; ?>">
		<div class="row slide-row">
			<div class="columns twelve">
			<?php if ($targetIndex == $i) {
				get_template_part('parts/content/content', $slug);
			} ?>
			</div>
		</div>			
	</li>		
<?php
}
?>