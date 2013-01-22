 jQuery(document).ready(function($) {


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

});
