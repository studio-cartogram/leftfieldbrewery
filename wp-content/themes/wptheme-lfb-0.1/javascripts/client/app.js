 jQuery(document).ready(function ($) {

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
	    animationLoop: true,
	    after: function (slider) {
	    	currentSliderIndex = slider.currentSlide;
	    	console.log("The slider is currently on: " + currentSliderIndex);
	    }
	  });

	
	

/* ========================================================================================================================
  
	Push State Implementation

======================================================================================================================== */
	
	var
		/* Stores the history of the window. */
		History = window.History,
		$window = $(window);


	/* The current slide the flexslider is on.*/
	var currentSliderIndex = 0;
	/* The ending part of the url being loaded into the browser. */
	var request_url = getEnding(AjaxResources.request_url);
	/* This is the url all ajax requests should be made to: managed by word press. */
	var ajax_url = AjaxResources.ajax_url;
	/* The same function is called on loading the first page and
	when a push state occurs. This helps that function distinguish the two events. */
	var initialLoad = true;

	/**
	*
	* State Change Handle. 
	* This function is fired when the page loads and a pushstate happens.
	* When loading a page from the browser, load the content the is mapped from the url.
	*/
	window.addEventListener('popstate', function(event) {
		console.log("Popstate occured.");

		var request_url;
		//This function is called when the page is intially loaded by the browser and when
		//a push state like back or forth is called.
		//This is the case where the browser is loading the page for the first time.
		if (initialLoad) {
			console.log('	Initial load.');

			/* This is the ending of the page we are loading. */
			var request_url = getEnding(document.URL);

			initialLoad = false;

			if (request_url === "") {
				request_url = "home";
			}
			//Load the content to the page in respect to the url
			updateContent(request_url);

		//This is case where a pushstate occured and we need to update the page
		//to reflect the new state.
		} else {
			console.log("	Loading an old state.");

			/* The request_url pushed most recently. */
			if (window.history.state !== null) {
				var request_url = window.history.state.request_url;
			} else {
				var request_url = getEnding(document.URL);
				if (request_url === "") {
					request_url = "home";
				}
			}

			//Make request to update the content
			updateContent(request_url);
		}
	});

	/**
	 * When a menu item is clicked, update the flexslider to the corresponding
	 * slide. Make a request to update the content with the corresponding content.
	 * Update the pushstate with the new state of the site.
	 *
	 */
	$("#global li").not("#global li.has-dropdown").click(function(e) {

		/* What position link clicked is in */
		var index = $(this).index();

		/* The Url of the link that was clicked. */
		var url = $(this).find("a").attr("href");

		/* This is the request_url to be used for ajax. */
		var request_url = getEnding(url);

		//Load the page.
		updateContent(request_url);

		/* Need to pass push state a title, not sure what to give it.*/
		var title = "not sure";

		/** Push state Stuff *******************************/
		//The first parameter is the stateObj retrievable by window.history.state
		//Passing in the request_url of the state for reloading it when the user goes "back"/"forth"
		window.history.pushState({request_url: request_url},title,url);
		
		e.preventDefault();
	});

	/**
	 * Given a url, return the substring of it with only the part after the main url
	 * and convert the forwardslash to an underscore.
	 * Ex localhost/www.lfb.com/blog/page1 would return blog_page1
	 *
	 */
	function getEnding(url) {
		var start = url.indexOf(".ca/");
		return url.substring(start + 4).replace("/", "_");
	}

	/**
	 * Given a request_url (the stuff after lfb.ca/) make an
	 * ajax call for the content for that page and insert it
	 * into the current li the flexslider is focused on.
	 *
	 * Note: This updates content for pages for now.
	 */
	function updateContent(request_url) {

		console.log("		Calling update content on: " + request_url);
		focusFlexSlider(request_url);
		$.ajax({
			asynch: false,
			type : "post",
			dataType : "html",
			/* Where the request is being sent to. */
			url: ajax_url,
			data: {
				action: "page",
				url: request_url
			},
			success: function(html) {
				$(".cartogram-slider-active-slide").html(html);
				applyJavascript(request_url);
			},
			error: function(response, html, something) {
				console.log("fail: " + response + html + something);
			}
		});
	}

	/*
	 * Given a request url, apply javascript needed for that specific page.
	 */
	 function applyJavascript(request_url) {

	 	//If the request is layered such as beers_typeofbeer, want to pass only the first part
	 	var index = request_url.indexOf("_");

	 	//Index is 0 if there is no _ in the request_url, so proceed as normal.
	 	if (index !== -1) {
	 		request = request_url.substring(0, index)
	 	} else {
	 		request = request_url;
	 	}

	 	switch(request) {
	 		case "about-us":
	 			//Maybe may direct calls to separate functions and use this 
	 			//as a routing function only depending on how
	 			//large it gets.
 				$('.playersFlexslider').flexslider({
				    selector: ".players_slides > li",
				    animation: "slide",
				    namespace: "cartogram-slider-players",
				    prevText: "n>",
				    nextText: "p<",
				    directionNav: true,
				    controlNav: true,
				    slideshow: false,
				    pauseOnHover: true,
				    slideshowSpeed: 5000,
				    animationLoop: true
				});
		
	 		case "beers":
 				$('.beersFlexslider').flexslider({
				    selector: ".beers_slides > li",
				    animation: "slide",
				    namespace: "cartogram-slider-beers",
				    prevText: "n>",
				    nextText: "p<",
				    directionNav: true,
				    controlNav: true,
				    slideshow: false,
				    pauseOnHover: true,
				    slideshowSpeed: 5000,
				    animationLoop: true
				});

	 			//By default, back of cards should be display:none
				//Move this to CSS?
				$(".backOfCard").toggle(false);

				//Add toggle events for back and front of cards.
				$(".flip").live("click", function() {
					$(this).parent().parent().find("div").toggle();
				});	
				break;
	 		default:
	 			break;
	 	}
	 }

	/*
	 * Given a request url, if the flexslider is not focused on its 
	 * corresponding li within the flexslider, focus to that slide. 
	 */ 
	function focusFlexSlider(request_url) {

		//Depending on the request URL, we want the flexslider to focus on one of the 6 slides.
		//Some slides will show multiple pieces of information i.e. highlights
		var slideMaps = {
							"home": 0,
							"about-us": 1,
							"beers": 2,
							"highlights":3,
							"category": 3,
							"tags": 3,
							"fan-shop": 4,
							"contact-us": 5
						}
		
		//The li the request_url corresponds to is represented in the first string before the "_"
		var indexOfSubstring = request_url.indexOf("_");
	 	if (indexOfSubstring !== -1) {
	 		request_part = request_url.substring(0,indexOfSubstring);
	 	} else {
	 		request_part = request_url;
	 	}

		//Retrieve what index that li is with respect to its ul.
		var targetIndex = slideMaps[request_part];

		if (targetIndex !== currentSliderIndex) {

			console.log("				Focusing flexslider on: " + targetIndex + " from " + currentSliderIndex);
			//If the flexslider isn't focused on the li want, focus it.
			$('.flexslider').data('flexslider').flexAnimate(targetIndex);
		} //Do not need to do anything if the flexslider is already focused on
		//the one we want.

		console.log("				Request Part determining focus index: " + request_part);
	}


}); // End of document.ready
