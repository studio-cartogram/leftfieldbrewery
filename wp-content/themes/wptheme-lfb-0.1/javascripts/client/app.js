 jQuery(document).ready(function ($) {

/* ========================================================================================================================
  
Show Splash Page Modal

======================================================================================================================== */


	$("#modal-splash").reveal({
		'closeOnBackgroundClick' : false,
		'animation' : 'fade'
	});

/* ========================================================================================================================
  
Grab The twitter Feed

======================================================================================================================== */
  
	$("#twitter").getTwitter({
		userName: "lfbrewery",
		numTweets: 1,
		loaderText: "Loading tweets...",
		slideIn: false,
		slideDuration: 750,
		showHeading: false,
		headingText: "Latest Tweets",
		showProfileLink: false,
		showTimestamp: true,
		includeRetweets: false,
		excludeReplies: true
	});

/* ========================================================================================================================
  
Fold Nav

======================================================================================================================== */

	$('.rolldown-list li').each(function () {
	  var delay = ($(this).index()/4) + 's';
	  $(this).css({
	      webkitAnimationDelay: delay,
	      mozAnimationDelay: delay,
	      animationDelay: delay
	  });
	});

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
	    prevText: "<i class='icon-arrow-left'></i>",
	    nextText: "<i class='icon-arrow-right'></i>",
	    directionNav: true,
	    controlNav: false,
	    slideshow: false,
	    pauseOnHover: true,
	    slideshowSpeed: 5000,
	    animationLoop: true,
	    keyboard: false,
	    smoothHeight: true,
	    after: function (slider) {	    	
	    	// $(".flexslider").animate({opacity: 1},3000);	    	currentSliderIndex = slider.currentSlide;
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
	
	$(".highlights").find("a").live("click", function(e) {

		/* The Url of the link that was clicked. */
		var url = $(this).attr("href");

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

	$(".mvp, .homehighlightreel").find("a").live("click", function(e) {

		/* The Url of the link that was clicked. */
		var url = $(this).attr("href");

		/* This is the request_url to be used for ajax. */
		var request_url = getEnding(url);
		//Load the page.
		updateContent(request_url);

		// Need to pass push state a title, not sure what to give it.
		var title = "not sure";

		/** Push state Stuff *******************************/
		//The first parameter is the stateObj retrievable by window.history.state
		//Passing in the request_url of the state for reloading it when the user goes "back"/"forth"
		window.history.pushState({request_url: request_url},title,url);
		
		e.preventDefault();
	});


	/**
	 * Manage the clicking of the left and right arrows on the slider
	 */
	 $(".cartogram-slider-direction-nav li a").click(function(e) {
	 	var reverseSlideMaps = {	
	 								"-1": "contact-us",
	 								0: "home",
	 								1: "about-us",
	 								2: "beers_tuborg",
	 								3: "highlights",
	 								4: "fan-shop",
	 								5: "contact-us",
	 								6: "home"
	 							}
	 	var moveRight = -1;
	 	if($(this).hasClass("cartogram-slider-next")) {
	 		var moveRight = 1;
	 	}
	 	index = document.URL.indexOf(".ca/");
	 	url = document.URL.substring(0, index + 4) + reverseSlideMaps[currentSliderIndex + moveRight];
	 	updateContent(reverseSlideMaps[currentSliderIndex + moveRight]);
	 	window.history.pushState({request_url: reverseSlideMaps[currentSliderIndex + moveRight]},"title",url);
	 });

	/**
	* Handle the clicking of left or right keyboard keys.
	*/
	$(document).keydown(function(e){
	    switch (e.keyCode) { 
	       	case 37:
	       		$(".cartogram-slider-prev").trigger("click");
	       		
		e.preventDefault();
	        break;
	        case 39:
	       		$(".cartogram-slider-next").trigger("click");
		e.preventDefault();
	       	break;
	    }
	});

	//Add toggle events for back and front of cards.
	$(".flip").live("click", function() {
		$(this).parent().toggleClass('hover');
		console.log('flipped');
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
		targetIndex = getIndexToFocusOn(request_url);
		
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
				$(".slideNum" + targetIndex).not(".clone").html(html);

				focusFlexSlider(targetIndex);
				applyJavascript(request_url);
			},
			error: function(response, html, something) {
				console.log("fail: " + response + html + something);
			}
		});
	}

	/*
	 * May not be using this anymore ...
	 * Given a request url, apply javascript needed for that specific page.
	 */
	function applyJavascript(request_url) {
	 	console.log("				Applying Javascript for " + request_url);

	 	//If the request is layered such as beers_typeofbeer, want to pass only the first part
	 	var index = request_url.indexOf("_");

	 	//Index is 0 if there is no _ in the request_url, so proceed as normal.
	 	if (index !== -1) {
	 		request = request_url.substring(0, index)
	 	} else {
	 		request = request_url;
	 	}

	 	switch(request) {
	 		case "home":
	 			//Maybe may direct calls to separate functions and use this 
	 			//as a routing function only depending on how
	 			//large it gets.
 				$('.flexslider-instagram').flexslider({
				    selector: ".slides-instagram > li",
				    animation: "slide",
				    namespace: "cartogram-slider-instagram",
				    prevText: "<i class='icon-arrow-left'></i>",
	    			nextText: "<i class='icon-arrow-right'></i>",
				    directionNav: true,
				    controlNav: false,
				    slideshow: false,
				    pauseOnHover: true,
				    slideshowSpeed: 5000,
				    animationLoop: true,
				    keyboard: false
				});
	 		case "about-us":
	 			//Maybe may direct calls to separate functions and use this 
	 			//as a routing function only depending on how
	 			//large it gets.
 				$('.flexslider-players').flexslider({
				    selector: ".slides-players > li",
				    animation: "slide",
				    namespace: "cartogram-slider-players",
				    prevText: "<i class='icon-arrow-left'></i>",
	    			nextText: "<i class='icon-arrow-right'></i>",
				    directionNav: true,
				    controlNav: true,
				    slideshow: false,
				    pauseOnHover: true,
				    slideshowSpeed: 5000,
				    animationLoop: true,
				    keyboard: false
				});
	 		case "beers":
		 		$('.beersFlexslider').flexslider({
				    selector: ".beers_slides > li",
				    animation: "slide",
				    namespace: "cartogram-slider-beers",
				    prevText: "<i class='icon-arrow-left'></i>",
	    			nextText: "<i class='icon-arrow-right'></i>",
				    directionNav: true,
				    controlNav: true,
				    slideshow: false,
				    pauseOnHover: true,
				    slideshowSpeed: 5000,
				    animationLoop: true,
				    keyboard: false
				});
				break;
			//Default will be all pages within pagination.
	 		default:

	 			break;
	 	}
	 }	

 	/* Given a request url, return the index at which the flexslider should focus on.
 	*/
 	function getIndexToFocusOn(request_url) {
 		//Parsing request url
		
		//The li the request_url corresponds to is represented in the first string before the "_"
		var indexOfSubstring = request_url.indexOf("_");
	 	if (indexOfSubstring !== -1) {
	 		request_part = request_url.substring(0,indexOfSubstring);
	 	} else {
	 		request_part = request_url;
	 	}

	 	//Depending on the request URL, we want the flexslider to focus on one of the 6 slides.
		//Some slides will show multiple pieces of information i.e. highlights
		switch (request_part) {
			case "home":
				var targetIndex = 0;
				break;
			case "about-us":
				var targetIndex = 1;
				break;
			case "beers":
				var targetIndex = 2;
				break;
			case "fan-shop":
				var targetIndex = 4;
				break;
			case "contact-us":
				var targetIndex = 5;
				break;
			case "highlights":
			case "category":
			case "tags":
			//Default case is a blog post or pages within the blog.
			default:
				var targetIndex = 3;
			break;
		}
		return targetIndex;
 	}
	/*
	 * Given a request url, if the flexslider is not focused on its 
	 * corresponding li within the flexslider, focus to that slide. 
	 */ 
	function focusFlexSlider(targetIndex) {

		//If we're not already focused on the target index, then move to it.
		if (targetIndex !== currentSliderIndex) {

			console.log("				Focusing flexslider on: " + targetIndex + " from " + currentSliderIndex);
			//If the flexslider isn't focused on the li want, focus it.
			$('.flexslider').data('flexslider').flexAnimate(targetIndex);
			currentSliderIndex=targetIndex;

		} //Do not need to do anything if the flexslider is already focused on
		//the one we want.


		//Toggle class "current_page_item" for nav <a>'s
		$('.current-menu-item').removeClass("current-menu-item");
		$('#global > li:eq(' + targetIndex + ')').toggleClass("current-menu-item");

		console.log("				Request Part determining focus index: " + request_part);
	}


}); // End of document.ready
