//Set up global variable App for function calls.
var App = {};

/*
	App's init function called when document is ready.
*/
App.init = function () {
	App.cache();
	App.bindListeners();
	App.flexsliderInit();
	App.addFlipEvents();
};

/* 
	Cache all dom selectors required.
*/
App.cache = function () {

	/* Store all dom elements selected. */
	App.dom = {};
	//Example:
	//App.dom.page = $(".page");

}; // App.cache();

/*
	For now, the bind listeners will be all the init functions
	outside of Push state.
*/
App.bindListeners = function () {
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

	if ($("#av-overlay").length) {
		var AVMonth = new Digits({ 
	  		wrapper: '#av-digits-m', 
	  		mode: 'statistics', 
	  		value: 10 
	  	});
		var AVDay = new Digits({ 
	  		wrapper: '#av-digits-d', 
	  		mode: 'statistics', 
	  		value: 24 
	  	});  
	  	var AVYear = new Digits({ 
	  		wrapper: '#av-digits-y', 
	  		mode: 'statistics', 
	  		value: 1992 
	  	});
	  
	  	// Change value when the input changes 

	  	$('#av_verify_m').change(function() {
	  		AVMonth.changeValue($(this).val());
		});
		$('#av_verify_d').change(function() {
	  		AVDay.changeValue($(this).val());
		});
		$('#av_verify_y').change(function() {
	  		AVYear.changeValue($(this).val());
		});
	}
	
}; // App.bindListeners().

/*
	Apply the flexslider.
*/
App.flexsliderInit = function () {

	/* ========================================================================================================================
	  
	Flexslider: Call and focus on relevant slide.

	======================================================================================================================== */
	$('.flexslider-instagram').flexslider({
	    selector: ".slides-instagram > li",
	    animation: "slide",
	    namespace: "cartogram-slider-internal-",
	    prevText: "<i class='icon-arrow-left'></i>",
		nextText: "<i class='icon-arrow-right'></i>",
	    directionNav: true,
	    controlNav: false,
	    slideshow: false,
	    pauseOnHover: true,
	    slideshowSpeed: 5000,
	    animationLoop: true,
	    keyboard: false,
	});

	$('.flexslider-players').flexslider({
	    selector: ".slides-players > li",
	    animation: "slide",
	    namespace: "cartogram-slider-sidebar-",
	    prevText: "<i class='icon-arrow-left'></i>",
		nextText: "<i class='icon-arrow-right'></i>",
	    directionNav: true,
	    controlNav: true,
	    slideshow: false,
	    pauseOnHover: true,
	    slideshowSpeed: 5000,
	    animationLoop: true,
	    keyboard: false,
	});

	$('.flexslider-beers').flexslider({
	    selector: ".slides-beers > li",
	    animation: "slide",
	    namespace: "cartogram-slider-internal-",
	    prevText: "<i class='icon-arrow-left'></i>",
		nextText: "<i class='icon-arrow-right'></i>",
	    directionNav: true,
	    controlNav: true,
	    slideshow: false,
	    pauseOnHover: true,
	    slideshowSpeed: 5000,
	    animationLoop: true, 
	    keyboard: false,


	});

};// App.addFlexslider().

/*
	Add the click events for flipping the about us cards and the beer cards.
*/
App.addFlipEvents = function () {

	//Add toggle events for back and front of cards.
	$(".flip").on("click", function() {
		$(this).parents('.flip-container').toggleClass('hover');
		return false;
	});
}// App.addFlipEvents.

//On document ready, run App's init function.
jQuery(document).ready(function ($) { 
	App.init();
});
