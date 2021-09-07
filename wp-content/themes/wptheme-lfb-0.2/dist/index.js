// modules are defined as an array
// [ module function, map of requires ]
//
// map of requires is short require name -> numeric require
//
// anything defined in a previous bundle is accessed via the
// orig method which is the require for previous bundles
parcelRequire = (function (modules, cache, entry, globalName) {
  // Save the require from previous bundle to this closure if any
  var previousRequire = typeof parcelRequire === 'function' && parcelRequire;
  var nodeRequire = typeof require === 'function' && require;

  function newRequire(name, jumped) {
    if (!cache[name]) {
      if (!modules[name]) {
        // if we cannot find the module within our internal map or
        // cache jump to the current global require ie. the last bundle
        // that was added to the page.
        var currentRequire = typeof parcelRequire === 'function' && parcelRequire;
        if (!jumped && currentRequire) {
          return currentRequire(name, true);
        }

        // If there are other bundles on this page the require from the
        // previous one is saved to 'previousRequire'. Repeat this as
        // many times as there are bundles until the module is found or
        // we exhaust the require chain.
        if (previousRequire) {
          return previousRequire(name, true);
        }

        // Try the node require function if it exists.
        if (nodeRequire && typeof name === 'string') {
          return nodeRequire(name);
        }

        var err = new Error('Cannot find module \'' + name + '\'');
        err.code = 'MODULE_NOT_FOUND';
        throw err;
      }

      localRequire.resolve = resolve;
      localRequire.cache = {};

      var module = cache[name] = new newRequire.Module(name);

      modules[name][0].call(module.exports, localRequire, module, module.exports, this);
    }

    return cache[name].exports;

    function localRequire(x){
      return newRequire(localRequire.resolve(x));
    }

    function resolve(x){
      return modules[name][1][x] || x;
    }
  }

  function Module(moduleName) {
    this.id = moduleName;
    this.bundle = newRequire;
    this.exports = {};
  }

  newRequire.isParcelRequire = true;
  newRequire.Module = Module;
  newRequire.modules = modules;
  newRequire.cache = cache;
  newRequire.parent = previousRequire;
  newRequire.register = function (id, exports) {
    modules[id] = [function (require, module) {
      module.exports = exports;
    }, {}];
  };

  var error;
  for (var i = 0; i < entry.length; i++) {
    try {
      newRequire(entry[i]);
    } catch (e) {
      // Save first error but execute all entries
      if (!error) {
        error = e;
      }
    }
  }

  if (entry.length) {
    // Expose entry point to Node, AMD or browser globals
    // Based on https://github.com/ForbesLindesay/umd/blob/master/template.js
    var mainExports = newRequire(entry[entry.length - 1]);

    // CommonJS
    if (typeof exports === "object" && typeof module !== "undefined") {
      module.exports = mainExports;

    // RequireJS
    } else if (typeof define === "function" && define.amd) {
     define(function () {
       return mainExports;
     });

    // <script>
    } else if (globalName) {
      this[globalName] = mainExports;
    }
  }

  // Override the current require with this new one
  parcelRequire = newRequire;

  if (error) {
    // throw error from earlier, _after updating parcelRequire_
    throw error;
  }

  return newRequire;
})({"client/gf.placeholders.js":[function(require,module,exports) {
(function ($) {
  var gf_placeholder = function gf_placeholder() {
    $('.gform_wrapper .gplaceholder').find('input, textarea').filter(function (i) {
      var $field = $(this);

      if (this.nodeName == 'INPUT') {
        var type = this.type;
        return !(type == 'hidden' || type == 'file' || type == 'radio' || type == 'checkbox');
      }

      return true;
    }).each(function () {
      var $field = $(this);
      var id = this.id;
      var $labels = $('label[for=' + id + ']').hide();
      var label = $labels.last().text();

      if (label.length > 0 && label[label.length - 1] == '*') {
        label = label.substring(0, label.length - 1) + ' *';
      }

      $field[0].setAttribute('placeholder', label);
    });
    var support = !('placeholder' in document.createElement('input')); // borrowed from Modernizr.com

    if (support && jquery_placeholder_url) $.ajax({
      cache: true,
      dataType: 'script',
      url: jquery_placeholder_url,
      success: function success() {
        $('input[placeholder], textarea[placeholder]').placeholder({
          blankSubmit: true
        });
      },
      type: 'get'
    });
  };
})(jQuery);
},{}],"client/instagramFeed.js":[function(require,module,exports) {
var define;
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*
 * InstagramFeed
 *
 * @version 3.0.2
 *
 * https://github.com/jsanahuja/InstagramFeed
 *
 */
(function (root, factory) {
  if (typeof define === "function" && define.amd) {
    define([], factory);
  } else if ((typeof exports === "undefined" ? "undefined" : _typeof(exports)) === "object") {
    module.exports = factory();
  } else {
    root.InstagramFeed = factory();
  }
})(this, function () {
  var defaults = {
    host: "https://www.instagram.com/",
    username: "",
    tag: "",
    user_id: "",
    location: "",
    container: "",
    display_profile: true,
    display_biography: true,
    display_gallery: true,
    display_captions: false,
    display_igtv: false,
    max_tries: 8,
    callback: null,
    styling: true,
    items: 8,
    items_per_row: 4,
    margin: 0.5,
    image_size: 640,
    lazy_load: false,
    cache_time: 360,
    on_error: console.error
  };
  var image_sizes = {
    150: 0,
    240: 1,
    320: 2,
    480: 3,
    640: 4
  };
  var escape_map = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;",
    "/": "&#x2F;",
    "`": "&#x60;",
    "=": "&#x3D;"
  };

  function escape_string(str) {
    return str.replace(/[&<>"'`=\/]/g, function (char) {
      return escape_map[char];
    });
  }

  function parse_caption(igobj, data) {
    if (typeof igobj.node.edge_media_to_caption.edges[0] !== "undefined" && typeof igobj.node.edge_media_to_caption.edges[0].node !== "undefined" && typeof igobj.node.edge_media_to_caption.edges[0].node.text !== "undefined" && igobj.node.edge_media_to_caption.edges[0].node.text !== null) {
      return igobj.node.edge_media_to_caption.edges[0].node.text;
    }

    if (typeof igobj.node.title !== "undefined" && igobj.node.title !== null && igobj.node.title.length != 0) {
      return igobj.node.title;
    }

    if (typeof igobj.node.accessibility_caption !== "undefined" && igobj.node.accessibility_caption !== null && igobj.node.accessibility_caption.length != 0) {
      return igobj.node.accessibility_caption;
    }

    return false;
  }
  /**
   * Cache management
   */


  function get_cache(options, last_resort) {
    var read_cache = last_resort || false;

    if (!last_resort && options.cache_time > 0) {
      var cached_time = localStorage.getItem(options.cache_time_key);

      if (cached_time !== null && parseInt(cached_time) + 1000 * 60 * options.cache_time > new Date().getTime()) {
        read_cache = true;
      }
    }

    if (read_cache) {
      var data = localStorage.getItem(options.cache_data_key);

      if (data !== null) {
        return JSON.parse(data);
      }
    }

    return false;
  }

  function set_cache(options, data) {
    var cached_time = localStorage.getItem(options.cache_time_key),
        cache = options.cache_time != 0 && (cached_time === null || parseInt(cached_time) + 1000 * 60 * options.cache_time > new Date().getTime());

    if (cache) {
      localStorage.setItem(options.cache_data_key, JSON.stringify(data));
      localStorage.setItem(options.cache_time_key, new Date().getTime());
    }
  }
  /**
   * Request / Response
   */


  function parse_response(type, data) {
    switch (type) {
      case "username":
      case "tag":
      case "location":
        try {
          data = data.split("window._sharedData = ")[1].split("</script>")[0];
        } catch (e) {
          return false;
        }

        data = JSON.parse(data.substr(0, data.length - 1));
        data = data.entry_data.ProfilePage || data.entry_data.TagPage || data.entry_data.LocationsPage;

        if (typeof data !== "undefined") {
          return data[0].graphql.user || data[0].graphql.hashtag || data[0].graphql.location;
        }

        return false;
        break;

      case "userid":
        if (typeof data.data.user !== "undefined") {
          return data.data.user;
        }

        return false;
        break;
    }
  }

  function request_data(url, type, tries, callback, autoFallback, googlePrefix) {
    var prefixedUrl;

    if (autoFallback && googlePrefix) {
      prefixedUrl = "https://images" + ~~(Math.random() * 3333) + "-focus-opensocial.googleusercontent.com/gadgets/proxy?container=none&url=" + url;
    }

    var xhr = new XMLHttpRequest();

    xhr.onload = function (e) {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          data = parse_response(type, xhr.responseText);

          if (data !== false) {
            callback(data);
          } else {
            // Unexpected response, not retrying
            callback(false);
          }
        }
      }
    };

    xhr.onerror = function (e) {
      if (tries > 1) {
        console.warn("Instagram Feed: Request failed, " + (tries - 1) + " tries left. Retrying...");
        request_data(url, type, tries - 1, callback, autoFallback, !googlePrefix);
      } else {
        callback(false, e);
      }
    };

    xhr.open("GET", prefixedUrl || url, true);
    xhr.send();
  }
  /**
   * Retrieve data
   */


  function get_data(options, callback) {
    var data = get_cache(options, false);

    if (data !== false) {
      // Retrieving data from cache
      callback(data);
    } else {
      // No cache, let's do the request
      var url;

      switch (options.type) {
        case "username":
          url = options.host + options.id + "/";
          break;

        case "tag":
          url = options.host + "explore/tags/" + options.id + "/";
          break;

        case "location":
          url = options.host + "explore/locations/" + options.id + "/";
          break;

        case "userid":
          url = options.host + 'graphql/query/?query_id=17888483320059182&variables={"id":"' + options.id + '","first":' + options.items + ',"after":null}';
          break;
      }

      request_data(url, options.type, options.max_tries, function (data, exception) {
        if (data !== false) {
          set_cache(options, data);
          callback(data);
        } else if (typeof exception === "undefined") {
          options.on_error("Instagram Feed: It looks like the profile you are trying to fetch is age restricted. See https://github.com/jsanahuja/InstagramFeed/issues/26", 3);
        } else {
          // Trying cache as last resort before throwing
          data = get_cache(options, true);

          if (data !== false) {
            callback(data);
          } else {
            options.on_error("Instagram Feed: Unable to fetch the given user/tag. Instagram responded with the status code: " + exception.status, 5);
          }
        }
      }, options.host === defaults.host && options.type != "userid", false);
    }
  }
  /**
   * Rendering
   */


  function render(options, data) {
    var html = "",
        styles;
    /**
     * Styles
     */

    if (options.styling) {
      var width = (100 - options.margin * 2 * options.items_per_row) / options.items_per_row;
      styles = {
        profile_container: ' style="text-align:center;"',
        profile_image: ' style="border-radius:10em;width:15%;max-width:125px;min-width:50px;"',
        profile_name: ' style="font-size:1.2em;"',
        profile_biography: ' style="font-size:1em;"',
        gallery_image: ' style="width:100%;"',
        gallery_image_link: ' style="width:' + width + "%; margin:" + options.margin + '%;position:relative; display: inline-block; height: 100%;"'
      };

      if (options.display_captions) {
        html += "<style>\
                  a[data-caption]:hover::after {\
                      content: attr(data-caption);\
                      text-align: center;\
                      font-size: 0.8rem;\
                      color: black;\
                      position: absolute;\
                      left: 0;\
                      right: 0;\
                      bottom: 0;\
                      padding: 1%;\
                      max-height: 100%;\
                      overflow-y: auto;\
                      overflow-x: hidden;\
                      background-color: hsla(0, 100%, 100%, 0.8);\
                  }\
              </style>";
      }
    } else {
      styles = {
        profile_container: "",
        profile_image: "",
        profile_name: "",
        profile_biography: "",
        gallery_image: "",
        gallery_image_link: ""
      };
    }
    /**
     * Profile & Biography
     */


    if (options.display_profile && options.type !== "userid") {
      html += '<div class="instagram_profile"' + styles.profile_container + ">";
      html += '<img class="instagram_profile_image" src="' + data.profile_pic_url + '" alt="' + (options.type == "tag" ? data.name + " tag pic" : data.username + " profile pic") + '"' + styles.profile_image + (options.lazy_load ? ' loading="lazy"' : "") + " />";

      if (options.type == "tag") {
        html += '<p class="instagram_tag"' + styles.profile_name + '><a href="https://www.instagram.com/explore/tags/' + options.tag + '/" rel="noopener" target="_blank">#' + options.tag + "</a></p>";
      } else if (options.type == "username") {
        html += "<p class='instagram_username'" + styles.profile_name + ">@" + data.full_name + " (<a href='https://www.instagram.com/" + options.username + "/' rel='noopener' target='_blank'>@" + options.username + "</a>)</p>";

        if (options.display_biography) {
          html += "<p class='instagram_biography'" + styles.profile_biography + ">" + data.biography + "</p>";
        }
      } else if (options.type == "location") {
        html += "<p class='instagram_location'" + styles.profile_name + "><a href='https://www.instagram.com/explore/locations/" + options.location + "/' rel='noopener' target='_blank'>" + data.name + "</a></p>";
      }

      html += "</div>";
    }
    /**
     * Gallery
     */


    if (options.display_gallery) {
      if (typeof data.is_private !== "undefined" && data.is_private === true) {
        html += '<p class="instagram_private"><strong>This profile is private</strong></p>';
      } else {
        var image_index = typeof image_sizes[options.image_size] !== "undefined" ? image_sizes[options.image_size] : image_sizes[640],
            imgs = (data.edge_owner_to_timeline_media || data.edge_hashtag_to_media || data.edge_location_to_media).edges,
            max = imgs.length > options.items ? options.items : imgs.length;
        html += "<div class='instagram_gallery'>";

        for (var i = 0; i < max; i++) {
          var url = "https://www.instagram.com/p/" + imgs[i].node.shortcode,
              image,
              type_resource,
              caption = parse_caption(imgs[i], data);

          if (caption === false) {
            caption = (options.type == "userid" ? "" : options.id) + " image";
          }

          caption = escape_string(caption);

          switch (imgs[i].node.__typename) {
            case "GraphSidecar":
              type_resource = "sidecar";
              image = imgs[i].node.thumbnail_resources[image_index].src;
              break;

            case "GraphVideo":
              type_resource = "video";
              image = imgs[i].node.thumbnail_src;
              break;

            default:
              type_resource = "image";
              image = imgs[i].node.thumbnail_resources[image_index].src;
          }

          html += '<a href="' + url + '"' + (options.display_captions ? ' data-caption="' + caption + '"' : "") + ' class="instagram-' + type_resource + '" rel="noopener" target="_blank"' + styles.gallery_image_link + ">";
          html += "<img" + (options.lazy_load ? ' loading="lazy"' : "") + ' src="' + image + '" alt="' + caption + '"' + styles.gallery_image + " />";
          html += "</a>";
        }

        html += "</div>";
      }
    }
    /**
     * IGTV
     */


    if (options.display_igtv && typeof data.edge_felix_video_timeline !== "undefined") {
      var igtv = data.edge_felix_video_timeline.edges,
          max = igtv.length > options.items ? options.items : igtv.length;

      if (igtv.length > 0) {
        html += '<div class="instagram_igtv">';

        for (var i = 0; i < max; i++) {
          var url = "https://www.instagram.com/p/" + igtv[i].node.shortcode,
              caption = parse_caption(igtv[i], data);

          if (caption === false) {
            caption = (options.type == "userid" ? "" : options.id) + " image";
          }

          caption = escape_string(caption);
          html += '<a href="' + url + '"' + (options.display_captions ? ' data-caption="' + caption + '"' : "") + ' rel="noopener" target="_blank"' + styles.gallery_image_link + ">";
          html += "<img" + (options.lazy_load ? ' loading="lazy"' : "") + ' src="' + igtv[i].node.thumbnail_src + '" alt="' + caption + '"' + styles.gallery_image + " />";
          html += "</a>";
        }

        html += "</div>";
      }
    }

    options.container.innerHTML = html;
  }

  if (typeof Object.assign != "function") {
    Object.assign = function (target) {
      "use strict";

      if (target == null) {
        throw new TypeError("Cannot convert undefined or null to object");
      }

      target = Object(target);

      for (var index = 1; index < arguments.length; index++) {
        var source = arguments[index];

        if (source != null) {
          for (var key in source) {
            if (Object.prototype.hasOwnProperty.call(source, key)) {
              target[key] = source[key];
            }
          }
        }
      }

      return target;
    };
  }

  return function (opts) {
    this.valid = false;
    var options = Object.assign({}, defaults);
    options = Object.assign(options, opts);

    if (options.username == "" && options.tag == "" && options.user_id == "" && options.location == "") {
      options.on_error("Instagram Feed: Error, no username, tag or user_id defined.", 1);
      return false;
    }

    if (typeof opts.display_profile !== "undefined" && opts.display_profile && options.user_id != "") {
      console.warn("Instagram Feed: 'display_profile' is not available using 'user_id' (GraphQL API)");
    }

    if (typeof opts.display_biography !== "undefined" && opts.display_biography && (options.tag != "" || options.location != "" || options.user_id != "")) {
      console.warn("Instagram Feed: 'display_biography' is not available unless you are loading an user ('username' parameter)");
    }

    if (typeof options.get_data !== "undefined") {
      console.warn("Instagram Feed: options.get_data is deprecated, options.callback is always called if defined");
    }

    if (options.callback == null && options.container == "") {
      options.on_error("Instagram Feed: Error, neither container found nor callback defined.", 2);
      return false;
    }

    if (options.username != "") {
      options.type = "username";
      options.id = options.username;
    } else if (options.tag != "") {
      options.type = "tag";
      options.id = options.tag;
    } else if (options.location != "") {
      options.type = "location";
      options.id = options.location;
    } else {
      options.type = "userid";
      options.id = options.user_id;
    }

    options.cache_data_key = "instagramFeed_" + options.type + "_" + options.id;
    options.cache_time_key = options.cache_data_key + "_time";
    get_data(options, function (data) {
      if (options.container != "") {
        render(options, data);
      }

      if (options.callback != null) {
        options.callback(data);
      }
    });
    this.valid = true;
  };
});
},{}],"client/app.js":[function(require,module,exports) {
"use strict";

var _instagramFeed = _interopRequireDefault(require("./instagramFeed"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

//Set up global variable App for function calls.
var App = {};
/*
  App's init function called when document is ready.
*/

App.init = function () {
  App.cache();
  App.bindListeners();
  App.addFlipEvents();
};
/* 
  Cache all dom selectors required.
*/


App.cache = function () {
  /* Store all dom elements selected. */
  App.dom = {};
}; // App.cache();

/*
  For now, the bind listeners will be all the init functions
  outside of Push state.
*/


App.bindListeners = function () {
  /* ========================================================================================================================
    
  Toogle mobile nav
   ======================================================================================================================== */
  var $topbar = $("nav.top-bar");
  $(".top-bar .toggle-topbar").on("click", function (e) {
    e.preventDefault();
    $topbar.toggleClass("expanded");
  });
  /* ========================================================================================================================
        Instagram
        ======================================================================================================================== */

  new _instagramFeed.default({
    username: "leftfieldbrewery",
    container: document.getElementById("instafeed"),
    display_profile: false,
    display_biography: false,
    // display_biography: true,
    // display_gallery: true,
    // callback: null,
    styling: false,
    items: 4
  }); // var feed = new Instafeed({
  //   get: "user",
  //   limit: 4,
  //   accessToken: "296366000.1677ed0.5880677c1fd8462d9f99a523c2f77e40",
  //   userId: 296366000,
  //   resolution: "standard_resolution",
  //   template:
  //     '<a class="instagram bg {{orientation}}" href="{{link}}" target="_blank" style="background-image:url({{image}})"/><span class="instagram__caption"><span class="instagram__caption-text"><span class="icon-instagram instagram__caption-icon"></span><span class="caption__text">{{caption}}</span></span></span></a>'
  // });
  // if (document.getElementById("instafeed")) {
  //   feed.run();
  // }
}; // App.bindListeners().

/*
  Add the click events for flipping the about us cards and the beer cards.
*/


App.addFlipEvents = function () {
  //Add toggle events for back and front of cards.
  $(".flip").on("click", function () {
    $(this).parents(".flip-container").toggleClass("hover");
    return false;
  });
}; // App.addFlipEvents.
//On document ready, run App's init function.


jQuery(document).ready(function ($) {
  App.init();
});
},{"./instagramFeed":"client/instagramFeed.js"}],"../../node_modules/parcel-bundler/src/builtins/bundle-url.js":[function(require,module,exports) {
var bundleURL = null;

function getBundleURLCached() {
  if (!bundleURL) {
    bundleURL = getBundleURL();
  }

  return bundleURL;
}

function getBundleURL() {
  // Attempt to find the URL of the current script and use that as the base URL
  try {
    throw new Error();
  } catch (err) {
    var matches = ('' + err.stack).match(/(https?|file|ftp|chrome-extension|moz-extension):\/\/[^)\n]+/g);

    if (matches) {
      return getBaseURL(matches[0]);
    }
  }

  return '/';
}

function getBaseURL(url) {
  return ('' + url).replace(/^((?:https?|file|ftp|chrome-extension|moz-extension):\/\/.+)?\/[^/]+(?:\?.*)?$/, '$1') + '/';
}

exports.getBundleURL = getBundleURLCached;
exports.getBaseURL = getBaseURL;
},{}],"../../node_modules/parcel-bundler/src/builtins/css-loader.js":[function(require,module,exports) {
var bundle = require('./bundle-url');

function updateLink(link) {
  var newLink = link.cloneNode();

  newLink.onload = function () {
    link.remove();
  };

  newLink.href = link.href.split('?')[0] + '?' + Date.now();
  link.parentNode.insertBefore(newLink, link.nextSibling);
}

var cssTimeout = null;

function reloadCSS() {
  if (cssTimeout) {
    return;
  }

  cssTimeout = setTimeout(function () {
    var links = document.querySelectorAll('link[rel="stylesheet"]');

    for (var i = 0; i < links.length; i++) {
      if (bundle.getBaseURL(links[i].href) === bundle.getBundleURL()) {
        updateLink(links[i]);
      }
    }

    cssTimeout = null;
  }, 50);
}

module.exports = reloadCSS;
},{"./bundle-url":"../../node_modules/parcel-bundler/src/builtins/bundle-url.js"}],"../styles/v1.scss":[function(require,module,exports) {
var reloadCSS = require('_css_loader');

module.hot.dispose(reloadCSS);
module.hot.accept(reloadCSS);
},{"./fonts/icomoon.eot":[["icomoon.d7278af2.eot","../styles/fonts/icomoon.eot"],"../styles/fonts/icomoon.eot"],"./fonts/icomoon.woff":[["icomoon.4b356e9e.woff","../styles/fonts/icomoon.woff"],"../styles/fonts/icomoon.woff"],"./fonts/icomoon.ttf":[["icomoon.7e225895.ttf","../styles/fonts/icomoon.ttf"],"../styles/fonts/icomoon.ttf"],"./fonts/icomoon.svg":[["icomoon.5d9f3c9a.svg","../styles/fonts/icomoon.svg"],"../styles/fonts/icomoon.svg"],"./../images/stripe.png":[["stripe.8de33a32.png","../images/stripe.png"],"../images/stripe.png"],"./../images/bg.png":[["bg.dd4562a6.png","../images/bg.png"],"../images/bg.png"],"_css_loader":"../../node_modules/parcel-bundler/src/builtins/css-loader.js"}],"../styles/main.scss":[function(require,module,exports) {
var reloadCSS = require('_css_loader');

module.hot.dispose(reloadCSS);
module.hot.accept(reloadCSS);
},{"./../images/flip.svg":[["flip.11338403.svg","../images/flip.svg"],"../images/flip.svg"],"./../images/flip-reverse.svg":[["flip-reverse.e51443a1.svg","../images/flip-reverse.svg"],"../images/flip-reverse.svg"],"./../images/stripe.png":[["stripe.8de33a32.png","../images/stripe.png"],"../images/stripe.png"],"./../images/bg.png":[["bg.dd4562a6.png","../images/bg.png"],"../images/bg.png"],"_css_loader":"../../node_modules/parcel-bundler/src/builtins/css-loader.js"}],"index.js":[function(require,module,exports) {
"use strict";

require("./client/gf.placeholders.js");

require("./client/app.js");

require("../styles/v1.scss");

require("../styles/main.scss");
},{"./client/gf.placeholders.js":"client/gf.placeholders.js","./client/app.js":"client/app.js","../styles/v1.scss":"../styles/v1.scss","../styles/main.scss":"../styles/main.scss"}],"../../node_modules/parcel-bundler/src/builtins/hmr-runtime.js":[function(require,module,exports) {
var global = arguments[3];
var OVERLAY_ID = '__parcel__error__overlay__';
var OldModule = module.bundle.Module;

function Module(moduleName) {
  OldModule.call(this, moduleName);
  this.hot = {
    data: module.bundle.hotData,
    _acceptCallbacks: [],
    _disposeCallbacks: [],
    accept: function (fn) {
      this._acceptCallbacks.push(fn || function () {});
    },
    dispose: function (fn) {
      this._disposeCallbacks.push(fn);
    }
  };
  module.bundle.hotData = null;
}

module.bundle.Module = Module;
var checkedAssets, assetsToAccept;
var parent = module.bundle.parent;

if ((!parent || !parent.isParcelRequire) && typeof WebSocket !== 'undefined') {
  var hostname = "" || location.hostname;
  var protocol = location.protocol === 'https:' ? 'wss' : 'ws';
  var ws = new WebSocket(protocol + '://' + hostname + ':' + "53751" + '/');

  ws.onmessage = function (event) {
    checkedAssets = {};
    assetsToAccept = [];
    var data = JSON.parse(event.data);

    if (data.type === 'update') {
      var handled = false;
      data.assets.forEach(function (asset) {
        if (!asset.isNew) {
          var didAccept = hmrAcceptCheck(global.parcelRequire, asset.id);

          if (didAccept) {
            handled = true;
          }
        }
      }); // Enable HMR for CSS by default.

      handled = handled || data.assets.every(function (asset) {
        return asset.type === 'css' && asset.generated.js;
      });

      if (handled) {
        console.clear();
        data.assets.forEach(function (asset) {
          hmrApply(global.parcelRequire, asset);
        });
        assetsToAccept.forEach(function (v) {
          hmrAcceptRun(v[0], v[1]);
        });
      } else if (location.reload) {
        // `location` global exists in a web worker context but lacks `.reload()` function.
        location.reload();
      }
    }

    if (data.type === 'reload') {
      ws.close();

      ws.onclose = function () {
        location.reload();
      };
    }

    if (data.type === 'error-resolved') {
      console.log('[parcel] ✨ Error resolved');
      removeErrorOverlay();
    }

    if (data.type === 'error') {
      console.error('[parcel] 🚨  ' + data.error.message + '\n' + data.error.stack);
      removeErrorOverlay();
      var overlay = createErrorOverlay(data);
      document.body.appendChild(overlay);
    }
  };
}

function removeErrorOverlay() {
  var overlay = document.getElementById(OVERLAY_ID);

  if (overlay) {
    overlay.remove();
  }
}

function createErrorOverlay(data) {
  var overlay = document.createElement('div');
  overlay.id = OVERLAY_ID; // html encode message and stack trace

  var message = document.createElement('div');
  var stackTrace = document.createElement('pre');
  message.innerText = data.error.message;
  stackTrace.innerText = data.error.stack;
  overlay.innerHTML = '<div style="background: black; font-size: 16px; color: white; position: fixed; height: 100%; width: 100%; top: 0px; left: 0px; padding: 30px; opacity: 0.85; font-family: Menlo, Consolas, monospace; z-index: 9999;">' + '<span style="background: red; padding: 2px 4px; border-radius: 2px;">ERROR</span>' + '<span style="top: 2px; margin-left: 5px; position: relative;">🚨</span>' + '<div style="font-size: 18px; font-weight: bold; margin-top: 20px;">' + message.innerHTML + '</div>' + '<pre>' + stackTrace.innerHTML + '</pre>' + '</div>';
  return overlay;
}

function getParents(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return [];
  }

  var parents = [];
  var k, d, dep;

  for (k in modules) {
    for (d in modules[k][1]) {
      dep = modules[k][1][d];

      if (dep === id || Array.isArray(dep) && dep[dep.length - 1] === id) {
        parents.push(k);
      }
    }
  }

  if (bundle.parent) {
    parents = parents.concat(getParents(bundle.parent, id));
  }

  return parents;
}

function hmrApply(bundle, asset) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (modules[asset.id] || !bundle.parent) {
    var fn = new Function('require', 'module', 'exports', asset.generated.js);
    asset.isNew = !modules[asset.id];
    modules[asset.id] = [fn, asset.deps];
  } else if (bundle.parent) {
    hmrApply(bundle.parent, asset);
  }
}

function hmrAcceptCheck(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (!modules[id] && bundle.parent) {
    return hmrAcceptCheck(bundle.parent, id);
  }

  if (checkedAssets[id]) {
    return;
  }

  checkedAssets[id] = true;
  var cached = bundle.cache[id];
  assetsToAccept.push([bundle, id]);

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    return true;
  }

  return getParents(global.parcelRequire, id).some(function (id) {
    return hmrAcceptCheck(global.parcelRequire, id);
  });
}

function hmrAcceptRun(bundle, id) {
  var cached = bundle.cache[id];
  bundle.hotData = {};

  if (cached) {
    cached.hot.data = bundle.hotData;
  }

  if (cached && cached.hot && cached.hot._disposeCallbacks.length) {
    cached.hot._disposeCallbacks.forEach(function (cb) {
      cb(bundle.hotData);
    });
  }

  delete bundle.cache[id];
  bundle(id);
  cached = bundle.cache[id];

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    cached.hot._acceptCallbacks.forEach(function (cb) {
      cb();
    });

    return true;
  }
}
},{}]},{},["../../node_modules/parcel-bundler/src/builtins/hmr-runtime.js","index.js"], null)
//# sourceMappingURL=index.js.map