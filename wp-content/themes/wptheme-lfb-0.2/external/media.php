<?php

	/* ========================================================================================================================
	
	Cartogram Media v.1.0
	
	======================================================================================================================== */

	/**
	 * Slideshow Shortcode
	 *
	 */
	function cartogram_slideshow( $atts, $content = null ) {
	    $content = str_replace('<br />', '', $content);
		$content = str_replace('<img', '<li><img', $content);
		$content = str_replace('/>', '/></li>', $content);
		return '<div class="slideshow"><div class="flexslider"><ul class="slides">' . $content . '</ul></div></div>';
	}

	/**
	 * Flex Video
	 *
	 */
	function cartogram_flexVideo( $atts, $content = null ) {    
		return '<div class="flex-video">' . $content . '</div>';
	}

	/**
	 * Add conainers to all videos
	 *
	 */
	function add_video_containers($content) { 
		$content = str_replace('<object', '<div class="flex-video"><object', $content);
		$content = str_replace('</object>', '</object></div>', $content);
		
		$content = str_replace('<embed', '<div class="flex-video"><embed', $content);
		$content = str_replace('</embed>', '</embed></div>', $content);
		
		$content = str_replace('<iframe', '<div class="flex-video"><iframe', $content);
		$content = str_replace('</iframe>', '</iframe></div>', $content);
		
		return $content;
	}
?>