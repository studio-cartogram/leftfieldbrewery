import Instafeed from "./instafeed";
//Set up global variable App for function calls.
var App = {};

/*
  App's init function called when document is ready.
*/
App.init = function() {
  App.cache();
  App.bindListeners();
  App.flexsliderInit();
  App.addFlipEvents();
};

/* 
  Cache all dom selectors required.
*/
App.cache = function() {
  /* Store all dom elements selected. */
  App.dom = {};
  //Example:
  //App.dom.page = $(".page");
}; // App.cache();

/*
  For now, the bind listeners will be all the init functions
  outside of Push state.
*/
App.bindListeners = function() {
  /* ========================================================================================================================
    
  Toogle mobile nav

  ======================================================================================================================== */
  var $topbar = $("nav.top-bar");

  $(".top-bar .toggle-topbar").on("click", function(e) {
    e.preventDefault();
    $topbar.toggleClass("expanded");
  });

  /* ========================================================================================================================

  Grab The twitter Feed

  ======================================================================================================================== */

  /**
   * How to use TwitterFetcher's fetch function:
   *
   * @function fetch(object) Fetches the Twitter content according to
   *     the parameters specified in object.
   *
   * @param object {Object} An object containing case sensitive key-value pairs
   *     of properties below.
   *
   * You may specify at minimum the following two required properties:
   *
   * @param object.id {string} The ID of the Twitter widget you wish
   *     to grab data from (see above for how to generate this number).
   * @param object.domId {string} The ID of the DOM element you want
   *     to write results to.
   *
   * You may also specify one or more of the following optional properties
   *     if you desire:
   *
   * @param object.maxTweets [int] The maximum number of tweets you want
   *     to return. Must be a number between 1 and 20. Default value is 20.
   * @param object.enableLinks [boolean] Set false if you don't want
   *     urls and hashtags to be hyperlinked.
   * @param object.showUser [boolean] Set false if you don't want user
   *     photo / name for tweet to show.
   * @param object.showTime [boolean] Set false if you don't want time of tweet
   *     to show.
   * @param object.dateFunction [function] A function you can specify
   *     to format date/time of tweet however you like. This function takes
   *     a JavaScript date as a parameter and returns a String representation
   *     of that date.
   * @param object.showRetweet [boolean] Set false if you don't want retweets
   *     to show.
   * @param object.customCallback [function] A function you can specify
   *     to call when data are ready. It also passes data to this function
   *     to manipulate them yourself before outputting. If you specify
   *     this parameter you must output data yourself!
   * @param object.showInteraction [boolean] Set false if you don't want links
   *     for reply, retweet and favourite to show.
   * @param object.showImages [boolean] Set true if you want images from tweet
   *     to show.
   * @param object.lang [string] The abbreviation of the language you want to use
   *     for Twitter phrases like "posted on" or "time ago". Default value
   *     is "en" (English).
   */
  // var twitterConfig = {
  //   id: "371772142548824064",
  //   domId: "twitter",
  //   maxTweets: 1,
  //   enableLinks: true,
  //   showPermalinks: false,
  //   showImages: false,
  //   showUser: false,
  //   showInteraction: false
  // };

  // twitterFetcher.fetch(twitterConfig);

  var twitterConfig = {
    profile: { screenName: "LFBrewery" },
    domId: "twitter",
    maxTweets: 1,
    enableLinks: true,
    showUser: false,
    showTime: true,
    showImages: false,
    showPermalinks: false,
    lang: "en"
  };
  twitterFetcher.fetch(twitterConfig);

  /* ========================================================================================================================

       Instagram

       ======================================================================================================================== */

  var feed = new Instafeed({
    get: "user",
    limit: 6,
    accessToken: "296366000.1677ed0.5880677c1fd8462d9f99a523c2f77e40",
    userId: 296366000,
    resolution: "standard_resolution",
    template:
      '<a class="instagram bg {{orientation}}" href="{{link}}" target="_blank" style="background-image:url({{image}})"/><span class="instagram__caption"><span class="instagram__caption-text"><span class="icon-instagram instagram__caption-icon"></span><span class="caption__text">{{caption}}</span></span></span></a>'
  });

  if (document.getElementById("instafeed")) {
    feed.run();
  }
}; // App.bindListeners().

/*
  Apply the flexslider.
*/
App.flexsliderInit = function() {
  /* ========================================================================================================================
    
  Flexslider: Call and focus on relevant slide.

  ======================================================================================================================== */
  $(".flexslider-instagram").flexslider({
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
    keyboard: false
  });

  $(".flexslider-players").flexslider({
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
    keyboard: false
  });

  $(".flexslider-beers").flexslider({
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
    keyboard: false
  });
}; // App.addFlexslider().

/*
  Add the click events for flipping the about us cards and the beer cards.
*/
App.addFlipEvents = function() {
  //Add toggle events for back and front of cards.
  $(".flip").on("click", function() {
    $(this)
      .parents(".flip-container")
      .toggleClass("hover");
    return false;
  });
}; // App.addFlipEvents.

//On document ready, run App's init function.
jQuery(document).ready(function($) {
  App.init();
});
