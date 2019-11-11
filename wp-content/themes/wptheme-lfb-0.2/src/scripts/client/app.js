import Instafeed from "./instafeed";

//Set up global variable App for function calls.
var App = {};

/*
  App's init function called when document is ready.
*/
App.init = function() {
  App.cache();
  App.bindListeners();
  App.addFlipEvents();
};

/* 
  Cache all dom selectors required.
*/
App.cache = function() {
  /* Store all dom elements selected. */
  App.dom = {};
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

       Instagram

       ======================================================================================================================== */

  var feed = new Instafeed({
    get: "user",
    limit: 4,
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
