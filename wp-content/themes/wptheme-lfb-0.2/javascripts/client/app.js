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


	// $("#modal-splash").reveal({
	// 	'closeOnBackgroundClick' : false,
	// 	'animation' : 'fade'
	// });

	/* ========================================================================================================================

	Grab The twitter Feed

	======================================================================================================================== */

	// $("#twitter").getTwitter({
	// 	userName: "lfbrewery",
	// 	numTweets: 1,
	// 	loaderText: "Loading tweets...",
	// 	slideIn: false,
	// 	slideDuration: 750,
	// 	showHeading: false,
	// 	headingText: "Latest Tweets",
	// 	showProfileLink: false,
	// 	showTimestamp: true,
	// 	includeRetweets: false,
	// 	excludeReplies: true
	// });

	/**
	 * How to use fetch function:
	 * @param {string} Your Twitter widget ID.
	 * @param {string} The ID of the DOM element you want to write results to. 
	 * @param {int} Optional - the maximum number of tweets you want returned. Must
	 *     be a number between 1 and 20.
	 * @param {boolean} Optional - set true if you want urls and hash
	       tags to be hyperlinked!
	 * @param {boolean} Optional - Set false if you dont want user photo /
	 *     name for tweet to show.
	 * @param {boolean} Optional - Set false if you dont want time of tweet
	 *     to show.
	 * @param {function/string} Optional - A function you can specify to format
	 *     tweet date/time however you like. This function takes a JavaScript date
	 *     as a parameter and returns a String representation of that date.
	 *     Alternatively you may specify the string 'default' to leave it with
	 *     Twitter's default renderings.
	 * @param {boolean} Optional - Show retweets or not. Set false to not show.
	 * @param {function/string} Optional - A function to call when data is ready. It
	 *     also passes the data to this function should you wish to manipulate it
	 *     yourself before outputting. If you specify this parameter you  must
	 *     output data yourself!
	 * @param {boolean} Optional - Show links for reply, retweet, favourite. Set false to not show.
	 */
	twitterFetcher.fetch('371772142548824064', 'twitter', 1, true, false);
	/* ========================================================================================================================
	  
	Fold Nav

	======================================================================================================================== */

	// $('.rolldown-list li').each(function () {
	//   var delay = ($(this).index()/4) + 's';
	//   $(this).css({
	//       webkitAnimationDelay: delay,
	//       mozAnimationDelay: delay,
	//       animationDelay: delay
	//   });
	// });

	/* ========================================================================================================================
	  
	Counters for Age Verification

	======================================================================================================================== */

	// if ($("#av-overlay").length) {
	// 	var AVMonth = new Digits({ 
	//   		wrapper: '#av-digits-m', 
	//   		mode: 'statistics', 
	//   		value: 10 
	//   	});
	// 	var AVDay = new Digits({ 
	//   		wrapper: '#av-digits-d', 
	//   		mode: 'statistics', 
	//   		value: 24 
	//   	});  
	//   	var AVYear = new Digits({ 
	//   		wrapper: '#av-digits-y', 
	//   		mode: 'statistics', 
	//   		value: 1992 
	//   	});
	  
	//   	// Change value when the input changes 

	//   	$('#av_verify_m').change(function() {
	//   		AVMonth.changeValue($(this).val());
	// 	});
	// 	$('#av_verify_d').change(function() {
	//   		AVDay.changeValue($(this).val());
	// 	});
	// 	$('#av_verify_y').change(function() {
	//   		AVYear.changeValue($(this).val());
	// 	});
	// }
	
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
