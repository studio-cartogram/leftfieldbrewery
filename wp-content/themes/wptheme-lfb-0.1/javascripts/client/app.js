 jQuery(document).ready(function($) {

/* ========================================================================================================================
  
Show Splash Page Modal

======================================================================================================================== */


	$("#modal-splash").reveal({
		'closeOnBackgroundClick' : false,
		'animation' : 'fade'
	});
  


/* ========================================================================================================================
  
Fold Nav

======================================================================================================================== */

	if ( $.fn.makisu.enabled ) {

	    var $maki = $( '.maki' );

	    // Create Makisus

	  
	    $maki.makisu({
	        selector: 'dd',
	        overlap: 0.6,
	        speed: 0.85
	    });

	    // Open all
	    
	    $( '.list' ).makisu( 'open' );

	    // Toggle on click

	    $( '.toggle' ).on( 'click', function() {
	        $( '.list' ).makisu( 'toggle' );
	    });


	} else {

	    $( '.warning' ).show();
	}

/* ========================================================================================================================
  
Counters for Age Verification

======================================================================================================================== */
if ( $.fn.Digits ) {
 	month = new Digits({ 
  		wrapper: '#av-digits-m', 
  		mode: 'statistics', 
  		value: 10 
  	});
	day = new Digits({ 
  		wrapper: '#av-digits-d', 
  		mode: 'statistics', 
  		value: 24 
  	});  
  	year = new Digits({ 
  		wrapper: '#av-digits-y', 
  		mode: 'statistics', 
  		value: 1992 
  	});  
  
  
  
  	// Change value when the input changes 

  	$('#av_verify_m').change(function() {
  		month.changeValue($(this).val());
	});
	$('#av_verify_d').change(function() {
  		day.changeValue($(this).val());
	});
	$('#av_verify_y').change(function() {
  		year.changeValue($(this).val());
	});
}
/* ========================================================================================================================
  
Flexslider

======================================================================================================================== */
	
	$('.flexslider').flexslider({
	    animation: "slide",
	    namespace: "cartogram-slider-",
	    prevText: "Prev",
	    directionNav: true,
	    controlNav: true,
	    slideshow: false,
	    pauseOnHover: true,
	    slideshowSpeed: 5000,
	    animationLoop: true
	  });


});
