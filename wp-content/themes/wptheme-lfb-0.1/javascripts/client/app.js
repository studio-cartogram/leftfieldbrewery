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
	
	

	//This triggers flexslider to update the view. We may not be using it if we're doing this
	//with push state.
	// $( "#global li" ).each(function( index ) {
	// 	var pageSlider = $('.flexslider').data('flexslider');
 //  		$(this).find('a').click(function(){
	//   		pageSlider.flexAnimate(index);
	// 		return false;
	// 	});
	// });

/* ========================================================================================================================
  
	Push State Implementation

======================================================================================================================== */
	
	var
		/* Stores the history of the window. */
		History = window.History,
		$window = $(window);
		$body = $(document.body),

		/* Causing error. */
		// rootUrl = History.getRootUrl(),
		contentSelector = '#content',
		$content = $(contentSelector).filter(':first'),
		contentNode = $content.get(0);

		/* Selecting the items on the global menu. */
		$menu = $('#global');

		/* Selecting the individual links on the global menu. */
		$menuChildren = $menu.find('li a');

		/* The current li within the flexslider that is being viewed. */
		$currentSlide = $(".cartogram-slider-active-slide"),

		/* The array of page names. Used for taking urls and directing them to 
		the proper ajax calls. */
		pagesArray = new Array("uncategorized/hello-world", "home", "about-us", "our-beer", "highlights", "fan-shop", "contact-us");

	/**
	* Parse the Html and give it back to us in a way we can use. 
	*/
	var documentHtml = function(html){
		// Prepare
		var result = String(html)
			.replace(/<\!DOCTYPE[^>]*>/i, '')
			.replace(/<(html|head|body|title|meta|script)([\s\>])/gi,'<div class="document-$1"$2')
			.replace(/<\/(html|head|body|title|meta|script)\>/gi,'</div>')
		;
		
		// Return
		return result;
	};

	/**
	 * Given a url, return the substring of it with only the part after the main url
	 * and convert the forwardslash to an underscore.
	 * Ex localhost/www.lfb.com/blog/page1 would return blog/page1
	 *
	 */
	function getEnding(url) {
		var start = url.indexOf(".com/");
		return url.substring(start + 5).replace("/", "_");
	}

	var request = getEnding(AjaxResources.request_url);
	//If the url loaded is a page, set the request as a page.
	if ($.inArray(request, pagesArray)!== -1) {
		request = "page";
	}	

	//Load the content to the page in respect to the url
	$.ajax({
		type : "post",
		dataType : "html",
		/* Where the request is being sent to. */
		url: AjaxResources.ajax_url,
		// post_id: AjaxResources.post_id,
		data: {
			action: request,
			post_id: AjaxResources.post_id,
			},
		success: function(html) {
			// $currentSlide.html(html);
			console.log(html);
		},
		error: function(response, html, something) {
			console.log("fail: " + response + html + something );
		}
	});

	/**
	* On click of a link, make an ajax request and load it into the li
	* after activating the change within the flexslider.
	* Click Handler. 
	* Push Url and Title to the browser history.
	* Pass the data-state attribute to change the view.
	*
	*/
	$("#global li").click(function(e) {

		/* The Url of the link that was clicked. */
		var url = $(this).find("a").attr("href");

		/* This is the request_url to be used for ajax. */
		var request_url = getEnding(url);

		//Flexslider update.


		//Load the page.
		$.ajax({
			type : "post",
			dataType : "html",
			/* Where the request is being sent to. */
			url: AjaxResources.ajax_url,
			// post_id: AjaxResources.post_id,
			data: {
				action: "page",
				url: url
				},
			success: function(html) {
				$currentSlide.html(html);
			},
			error: function(response, html, something) {
				console.log("fail: " + response + html + something );
			}
		});

		/* Need to pass push state a title, not sure what to give it.*/
		var title = "not sure";


		/** Push state Stuff *******************************/
		
		// History.pushState(null,title,url);
		
		e.preventDefault();
	});

	/**
	*
	* State Change Handle. 
	* Get the current state
	*
	*/

	$window.bind('statechange',function(){
		var
			State = History.getState(),
			url = State.url,
			relativeUrl = url.replace(rootUrl,'');
		
		
		changeView('sidebar');
		// start ajax
		$.ajax({
			url: url,
			success: function(data, textStatus, jqXHR){
				// Prepare
				var
					$data = $(documentHtml(data)),
					$dataBody = $data.find('.document-body:first');
					$dataContent = $dataBody.find(contentSelector).filter(':first'),
					// $menuChildren, contentHtml, $scripts;
			
				contentHtml = $dataContent.html()||$data.html();
				
				// Add some fallback content
				if (!contentHtml) {
					contentHtml = "<p>There is nothing here yet.</p>";
				}
				
				$content.html(contentHtml); 
				
				// Complete
				changeView('pres');
			},
			error: function(jqXHR, textStatus, errorThrown){
				document.location.href = url;
				return false;
			}
		}); // end ajax

	}); // end statechange

	/**
	*
	* Visual triggers here. 
	* Change the view by grabbing the state of the clicked link 
	* and use CSS transitions to slide the content. 
	*
	*/
	
	$('[data-state]').click(function(e) {
		state = $(this).attr('data-state');
		changeView(state);
		console.log("data state clicked");
	});

	function changeView(state) {
		$body
		.removeClass(
			function(i, c) {
				var m = c.match(/state\d+/g);
				if(m != null)
					return m.join(" ");
			})
		.addClass('state-' + state);
	}

}); // End of document.ready
