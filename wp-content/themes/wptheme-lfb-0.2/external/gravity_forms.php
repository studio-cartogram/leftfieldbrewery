<?php

	/* ========================================================================================================================
	
	Cartogram Gravity Form Helpers v.1.0
	
	======================================================================================================================== */

	function form_submit_button($button, $form){
	    return "<button class='button expand' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
	}