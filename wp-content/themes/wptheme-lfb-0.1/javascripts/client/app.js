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
	    animationLoop: true
	  });
	
	

/* ========================================================================================================================
  
	Push State Implementation

======================================================================================================================== */
	
	var
		/* Stores the history of the window. */
		History = window.History,
		$window = $(window);
		// $body = $(document.body),

		/* Causing error. */
		// rootUrl = History.getRootUrl(),
		// contentSelector = '#content',
		// $content = $(contentSelector).filter(':first'),
		// contentNode = $content.get(0);

		/* Selecting the items on the global menu. */
		// $menu = $('#global');

		/* Selecting the individual links on the global menu. */
		// $menuChildren = $menu.find('li a');

		/* The current li within the flexslider that is being viewed. */
		$currentSlide = $(".cartogram-slider-active-slide"),

		/* The array of page names. Used for taking urls and directing them to 
		the proper ajax calls. */
		pagesArray = new Array("uncategorized_hello-world", "home", "about-us", "our-beer", "highlights", "fan-shop", "contact-us");

	var request = getEnding(AjaxResources.request_url);
	var ajax_url = AjaxResources.ajax_url;
	var post_id = AjaxResources.post_id;

	/* The same function is called on loading the first page and
	when a push state occurs. This helps that function distinguish the two events. */
	var initialLoad = true;
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
		var start = url.indexOf(".ca/");
		return url.substring(start + 4).replace("/", "_");
	}



	/**
	* On click of a link, make an ajax request and load it into the li
	* after activating the change within the flexslider.
	* Click Handler. 
	* Push Url and Title to the browser history.
	* Pass the data-state attribute to change the view.
	*
	*/
	$("#global li").click(function(e) {

		var index = $(this).index();
		$('.flexslider').data('flexslider').flexAnimate(index);

		/* The Url of the link that was clicked. */
		var url = $(this).find("a").attr("href");

		/* This is the request_url to be used for ajax. */
		var request_url = getEnding(url);

		//Flexslider update.

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
	*
	* State Change Handle. 
	* This function is fired when the page loads and a pushstate happens.
	*/
	window.addEventListener('popstate', function(event) {

		if (initialLoad) {
			console.log("loading initial page.. ");
			initialLoad = false;
			//If the url loaded is a page, set the request as a page.
			if ($.inArray(request, pagesArray)!== -1) {
				request = "page";
			}

			if (post_id === "1") {
				post_id = "4";
			}

			//Load the content to the page in respect to the url
			$.ajax({
				type : "post",
				dataType : "html",
				/* Where the request is being sent to. */
				url: ajax_url,
				// post_id: AjaxResources.post_id,
				data: {
					action: request,
					post_id: post_id,
				},
				success: function(html) {
					$(".cartogram-slider-active-slide").html(html);
				},
				error: function(response, html, something) {
					console.log("fail: " + response + html + something );
				}
			});
		} else {
			//Get the url
			var request_url = window.history.state.request_url;
			// update flexslider
			focusFlexSlider(request_url);
			//
			//make ajax call
			//Does this need to be done if the content is already loaded?
			updateContent(request_url);

		}
		
	});

	
	/**
	*
	* Visual triggers here. 
	* Change the view by grabbing the state of the clicked link 
	* and use CSS transitions to slide the content. 
	*
	*/
	
	// $('[data-state]').click(function(e) {
	// 	state = $(this).attr('data-state');
	// 	changeView(state);
	// 	console.log("data state clicked");
	// });

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

	/**
	 * Given a request (in stuff after lfb.ca/) make an
	 * ajax call for the content for that page and insert it
	 * into the current li the flexslider is focused on.
	 *
	 * Note: This updates content for pages for now.
	 */
	function updateContent(request) {
		$.ajax({
			asynch: false,
			type : "post",
			dataType : "html",
			/* Where the request is being sent to. */
			url: AjaxResources.ajax_url,
			// post_id: AjaxResources.post_id,
			data: {
				action: "page",
				url: request
			},
			success: function(html) {
				$(".cartogram-slider-active-slide").html(html);

			},
			error: function(response, html, something) {
				console.log("fail: " + response + html + something);
			}
		});
	}

	/*
	 * Given a request url, if the flexslider is not focused on it already, 
	 * focus to that slide. This will involve parsing the nav to find out 
	 * which one the request url matches to.
	 */ 
	function focusFlexSlider(request_url) {
		//get the first part of the request url (everything between .ca/  and the first /)
		//index of and substring?
		request_url.substring(0,request_url.indexOf("/"));
		//get the index of the request in respect to the flexslider.
		var index = $("#global li").index($("li.menu-item").find('a[href*="' + request_url + '"]').parent());
		
		//check to see if it is already in focus

		// console.log($("ol.cartogran-slider-control-nav li").index());
		var flexsliderIndex = $("div.cartogram-slider-viewport ul.slides li").index($("div.cartogram-slider-viewport ul.slides li.cartogram-slider-active-slide"));

		//n.b. the ul containing the slides have an initial "unused(?)" li so we need to add 1
		if (index + 1 !== flexsliderIndex) {
			$('.flexslider').data('flexslider').flexAnimate(index);
		}
	}


}); // End of document.ready
