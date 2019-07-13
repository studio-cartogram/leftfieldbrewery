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
},{}],"client/instafeed.js":[function(require,module,exports) {
var define;
function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

// Generated by CoffeeScript 1.9.3
(function () {
  var Instafeed;

  Instafeed = function () {
    function Instafeed(params, context) {
      var option, value;
      this.options = {
        target: 'instafeed',
        get: 'popular',
        resolution: 'thumbnail',
        sortBy: 'none',
        links: true,
        mock: false,
        useHttp: false
      };

      if (_typeof(params) === 'object') {
        for (option in params) {
          value = params[option];
          this.options[option] = value;
        }
      }

      this.context = context != null ? context : this;
      this.unique = this._genKey();
    }

    Instafeed.prototype.hasNext = function () {
      return typeof this.context.nextUrl === 'string' && this.context.nextUrl.length > 0;
    };

    Instafeed.prototype.next = function () {
      if (!this.hasNext()) {
        return false;
      }

      return this.run(this.context.nextUrl);
    };

    Instafeed.prototype.run = function (url) {
      var header, instanceName, script;

      if (typeof this.options.clientId !== 'string') {
        if (typeof this.options.accessToken !== 'string') {
          throw new Error("Missing clientId or accessToken.");
        }
      }

      if (typeof this.options.accessToken !== 'string') {
        if (typeof this.options.clientId !== 'string') {
          throw new Error("Missing clientId or accessToken.");
        }
      }

      if (this.options.before != null && typeof this.options.before === 'function') {
        this.options.before.call(this);
      }

      if (typeof document !== "undefined" && document !== null) {
        script = document.createElement('script');
        script.id = 'instafeed-fetcher';
        script.src = url || this._buildUrl();
        header = document.getElementsByTagName('head');
        header[0].appendChild(script);
        instanceName = "instafeedCache" + this.unique;
        window[instanceName] = new Instafeed(this.options, this);
        window[instanceName].unique = this.unique;
      }

      return true;
    };

    Instafeed.prototype.parse = function (response) {
      var anchor, childNodeCount, childNodeIndex, childNodesArr, e, eMsg, fragment, header, htmlString, httpProtocol, i, image, imageObj, imageString, imageUrl, images, img, imgHeight, imgOrient, imgUrl, imgWidth, instanceName, j, k, len, len1, len2, node, parsedLimit, reverse, sortSettings, targetEl, tmpEl;

      if (_typeof(response) !== 'object') {
        if (this.options.error != null && typeof this.options.error === 'function') {
          this.options.error.call(this, 'Invalid JSON data');
          return false;
        } else {
          throw new Error('Invalid JSON response');
        }
      }

      if (response.meta.code !== 200) {
        if (this.options.error != null && typeof this.options.error === 'function') {
          this.options.error.call(this, response.meta.error_message);
          return false;
        } else {
          throw new Error("Error from Instagram: " + response.meta.error_message);
        }
      }

      if (response.data.length === 0) {
        if (this.options.error != null && typeof this.options.error === 'function') {
          this.options.error.call(this, 'No images were returned from Instagram');
          return false;
        } else {
          throw new Error('No images were returned from Instagram');
        }
      }

      if (this.options.success != null && typeof this.options.success === 'function') {
        this.options.success.call(this, response);
      }

      this.context.nextUrl = '';

      if (response.pagination != null) {
        this.context.nextUrl = response.pagination.next_url;
      }

      if (this.options.sortBy !== 'none') {
        if (this.options.sortBy === 'random') {
          sortSettings = ['', 'random'];
        } else {
          sortSettings = this.options.sortBy.split('-');
        }

        reverse = sortSettings[0] === 'least' ? true : false;

        switch (sortSettings[1]) {
          case 'random':
            response.data.sort(function () {
              return 0.5 - Math.random();
            });
            break;

          case 'recent':
            response.data = this._sortBy(response.data, 'created_time', reverse);
            break;

          case 'liked':
            response.data = this._sortBy(response.data, 'likes.count', reverse);
            break;

          case 'commented':
            response.data = this._sortBy(response.data, 'comments.count', reverse);
            break;

          default:
            throw new Error("Invalid option for sortBy: '" + this.options.sortBy + "'.");
        }
      }

      if (typeof document !== "undefined" && document !== null && this.options.mock === false) {
        images = response.data;
        parsedLimit = parseInt(this.options.limit, 10);

        if (this.options.limit != null && images.length > parsedLimit) {
          images = images.slice(0, parsedLimit);
        }

        fragment = document.createDocumentFragment();

        if (this.options.filter != null && typeof this.options.filter === 'function') {
          images = this._filter(images, this.options.filter);
        }

        if (this.options.template != null && typeof this.options.template === 'string') {
          htmlString = '';
          imageString = '';
          imgUrl = '';
          tmpEl = document.createElement('div');

          for (i = 0, len = images.length; i < len; i++) {
            image = images[i];
            imageObj = image.images[this.options.resolution];

            if (_typeof(imageObj) !== 'object') {
              eMsg = "No image found for resolution: " + this.options.resolution + ".";
              throw new Error(eMsg);
            }

            imgWidth = imageObj.width;
            imgHeight = imageObj.height;
            imgOrient = "square";

            if (imgWidth > imgHeight) {
              imgOrient = "landscape";
            }

            if (imgWidth < imgHeight) {
              imgOrient = "portrait";
            }

            imageUrl = imageObj.url;
            httpProtocol = window.location.protocol.indexOf("http") >= 0;

            if (httpProtocol && !this.options.useHttp) {
              imageUrl = imageUrl.replace(/https?:\/\//, '//');
            }

            imageString = this._makeTemplate(this.options.template, {
              model: image,
              id: image.id,
              link: image.link,
              type: image.type,
              image: imageUrl,
              width: imgWidth,
              height: imgHeight,
              orientation: imgOrient,
              caption: this._getObjectProperty(image, 'caption.text'),
              likes: image.likes.count,
              comments: image.comments.count,
              location: this._getObjectProperty(image, 'location.name')
            });
            htmlString += imageString;
          }

          tmpEl.innerHTML = htmlString;
          childNodesArr = [];
          childNodeIndex = 0;
          childNodeCount = tmpEl.childNodes.length;

          while (childNodeIndex < childNodeCount) {
            childNodesArr.push(tmpEl.childNodes[childNodeIndex]);
            childNodeIndex += 1;
          }

          for (j = 0, len1 = childNodesArr.length; j < len1; j++) {
            node = childNodesArr[j];
            fragment.appendChild(node);
          }
        } else {
          for (k = 0, len2 = images.length; k < len2; k++) {
            image = images[k];
            img = document.createElement('img');
            imageObj = image.images[this.options.resolution];

            if (_typeof(imageObj) !== 'object') {
              eMsg = "No image found for resolution: " + this.options.resolution + ".";
              throw new Error(eMsg);
            }

            imageUrl = imageObj.url;
            httpProtocol = window.location.protocol.indexOf("http") >= 0;

            if (httpProtocol && !this.options.useHttp) {
              imageUrl = imageUrl.replace(/https?:\/\//, '//');
            }

            img.src = imageUrl;

            if (this.options.links === true) {
              anchor = document.createElement('a');
              anchor.href = image.link;
              anchor.appendChild(img);
              fragment.appendChild(anchor);
            } else {
              fragment.appendChild(img);
            }
          }
        }

        targetEl = this.options.target;

        if (typeof targetEl === 'string') {
          targetEl = document.getElementById(targetEl);
        }

        if (targetEl == null) {
          eMsg = "No element with id=\"" + this.options.target + "\" on page.";
          throw new Error(eMsg);
        }

        targetEl.appendChild(fragment);
        header = document.getElementsByTagName('head')[0];
        header.removeChild(document.getElementById('instafeed-fetcher'));
        instanceName = "instafeedCache" + this.unique;
        window[instanceName] = void 0;

        try {
          delete window[instanceName];
        } catch (_error) {
          e = _error;
        }
      }

      if (this.options.after != null && typeof this.options.after === 'function') {
        this.options.after.call(this);
      }

      return true;
    };

    Instafeed.prototype._buildUrl = function () {
      var base, endpoint, final;
      base = "https://api.instagram.com/v1";

      switch (this.options.get) {
        case "popular":
          endpoint = "media/popular";
          break;

        case "tagged":
          if (!this.options.tagName) {
            throw new Error("No tag name specified. Use the 'tagName' option.");
          }

          endpoint = "tags/" + this.options.tagName + "/media/recent";
          break;

        case "location":
          if (!this.options.locationId) {
            throw new Error("No location specified. Use the 'locationId' option.");
          }

          endpoint = "locations/" + this.options.locationId + "/media/recent";
          break;

        case "user":
          if (!this.options.userId) {
            throw new Error("No user specified. Use the 'userId' option.");
          }

          endpoint = "users/" + this.options.userId + "/media/recent";
          break;

        default:
          throw new Error("Invalid option for get: '" + this.options.get + "'.");
      }

      final = base + "/" + endpoint;

      if (this.options.accessToken != null) {
        final += "?access_token=" + this.options.accessToken;
      } else {
        final += "?client_id=" + this.options.clientId;
      }

      if (this.options.limit != null) {
        final += "&count=" + this.options.limit;
      }

      final += "&callback=instafeedCache" + this.unique + ".parse";
      return final;
    };

    Instafeed.prototype._genKey = function () {
      var S4;

      S4 = function S4() {
        return ((1 + Math.random()) * 0x10000 | 0).toString(16).substring(1);
      };

      return "" + S4() + S4() + S4() + S4();
    };

    Instafeed.prototype._makeTemplate = function (template, data) {
      var output, pattern, ref, varName, varValue;
      pattern = /(?:\{{2})([\w\[\]\.]+)(?:\}{2})/;
      output = template;

      while (pattern.test(output)) {
        varName = output.match(pattern)[1];
        varValue = (ref = this._getObjectProperty(data, varName)) != null ? ref : '';
        output = output.replace(pattern, function () {
          return "" + varValue;
        });
      }

      return output;
    };

    Instafeed.prototype._getObjectProperty = function (object, property) {
      var piece, pieces;
      property = property.replace(/\[(\w+)\]/g, '.$1');
      pieces = property.split('.');

      while (pieces.length) {
        piece = pieces.shift();

        if (object != null && piece in object) {
          object = object[piece];
        } else {
          return null;
        }
      }

      return object;
    };

    Instafeed.prototype._sortBy = function (data, property, reverse) {
      var sorter;

      sorter = function sorter(a, b) {
        var valueA, valueB;
        valueA = this._getObjectProperty(a, property);
        valueB = this._getObjectProperty(b, property);

        if (reverse) {
          if (valueA > valueB) {
            return 1;
          } else {
            return -1;
          }
        }

        if (valueA < valueB) {
          return 1;
        } else {
          return -1;
        }
      };

      data.sort(sorter.bind(this));
      return data;
    };

    Instafeed.prototype._filter = function (images, filter) {
      var filteredImages, fn, i, image, len;
      filteredImages = [];

      fn = function fn(image) {
        if (filter(image)) {
          return filteredImages.push(image);
        }
      };

      for (i = 0, len = images.length; i < len; i++) {
        image = images[i];
        fn(image);
      }

      return filteredImages;
    };

    return Instafeed;
  }();

  (function (root, factory) {
    if (typeof define === 'function' && define.amd) {
      return define([], factory);
    } else if ((typeof module === "undefined" ? "undefined" : _typeof(module)) === 'object' && module.exports) {
      return module.exports = factory();
    } else {
      return root.Instafeed = factory();
    }
  })(this, function () {
    return Instafeed;
  });
}).call(this);
},{}],"client/twitterFetcher.js":[function(require,module,exports) {
var define;
function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*********************************************************************
 *  #### Twitter Post Fetcher v18.0.3 ####
 *  Coded by Jason Mayes 2015. A present to all the developers out there.
 *  www.jasonmayes.com
 *  Please keep this disclaimer with my code if you use it. Thanks. :-)
 *  Got feedback or questions, ask here:
 *  http://www.jasonmayes.com/projects/twitterApi/
 *  Github: https://github.com/jasonmayes/Twitter-Post-Fetcher
 *  Updates will be posted to this site.
 *********************************************************************/
(function (root, factory) {
  if (typeof define === "function" && define.amd) {
    // AMD. Register as an anonymous module.
    define([], factory);
  } else if ((typeof exports === "undefined" ? "undefined" : _typeof(exports)) === "object") {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory();
  } else {
    // Browser globals.
    factory();
  }
})(this, function () {
  var domNode = "";
  var maxTweets = 20;
  var parseLinks = true;
  var queue = [];
  var inProgress = false;
  var printTime = true;
  var printUser = true;
  var formatterFunction = null;
  var supportsClassName = true;
  var showRts = true;
  var customCallbackFunction = null;
  var showInteractionLinks = true;
  var showImages = false;
  var useEmoji = false;
  var targetBlank = true;
  var lang = "en";
  var permalinks = true;
  var dataOnly = false;
  var script = null;
  var scriptAdded = false;

  function handleTweets(tweets) {
    if (customCallbackFunction === null) {
      var x = tweets.length;
      var n = 0;
      var element = document.getElementById(domNode);
      var html = "<ul>";

      while (n < x) {
        html += "<li>" + tweets[n] + "</li>";
        n++;
      }

      html += "</ul>";
      element.innerHTML = html;
    } else {
      customCallbackFunction(tweets);
    }
  }

  function strip(data) {
    return data.replace(/<b[^>]*>(.*?)<\/b>/gi, function (a, s) {
      return s;
    }).replace(/class="(?!(tco-hidden|tco-display|tco-ellipsis))+.*?"|data-query-source=".*?"|dir=".*?"|rel=".*?"/gi, "");
  }

  function targetLinksToNewWindow(el) {
    var links = el.getElementsByTagName("a");

    for (var i = links.length - 1; i >= 0; i--) {
      links[i].setAttribute("target", "_blank");
      links[i].setAttribute("rel", "noopener");
    }
  }

  function getElementsByClassName(node, classname) {
    var a = [];
    var regex = new RegExp("(^| )" + classname + "( |$)");
    var elems = node.getElementsByTagName("*");

    for (var i = 0, j = elems.length; i < j; i++) {
      if (regex.test(elems[i].className)) {
        a.push(elems[i]);
      }
    }

    return a;
  }

  function extractImagesUrl(image_data) {
    if (image_data !== undefined && image_data.innerHTML.indexOf("data-image") >= 0) {
      var data_src = image_data.innerHTML.match(/data-image=\"([A-z0-9]+:\/\/[A-z0-9]+\.[A-z0-9]+\.[A-z0-9]+\/[A-z0-9]+\/[A-z0-9\-]+)\"/gi);

      for (var i = 0; i < data_src.length; i++) {
        data_src[i] = data_src[i].match(/data-image=\"([A-z0-9]+:\/\/[A-z0-9]+\.[A-z0-9]+\.[A-z0-9]+\/[A-z0-9]+\/[A-z0-9\-]+)\"/i)[1];
        data_src[i] = decodeURIComponent(data_src[i]) + ".jpg";
      }

      return data_src;
    }
  }

  var twitterFetcher = {
    fetch: function fetch(config) {
      if (config.maxTweets === undefined) {
        config.maxTweets = 20;
      }

      if (config.enableLinks === undefined) {
        config.enableLinks = true;
      }

      if (config.showUser === undefined) {
        config.showUser = true;
      }

      if (config.showTime === undefined) {
        config.showTime = true;
      }

      if (config.dateFunction === undefined) {
        config.dateFunction = "default";
      }

      if (config.showRetweet === undefined) {
        config.showRetweet = true;
      }

      if (config.customCallback === undefined) {
        config.customCallback = null;
      }

      if (config.showInteraction === undefined) {
        config.showInteraction = true;
      }

      if (config.showImages === undefined) {
        config.showImages = false;
      }

      if (config.useEmoji === undefined) {
        config.useEmoji = false;
      }

      if (config.linksInNewWindow === undefined) {
        config.linksInNewWindow = true;
      }

      if (config.showPermalinks === undefined) {
        config.showPermalinks = true;
      }

      if (config.dataOnly === undefined) {
        config.dataOnly = false;
      }

      if (inProgress) {
        queue.push(config);
      } else {
        inProgress = true;
        domNode = config.domId;
        maxTweets = config.maxTweets;
        parseLinks = config.enableLinks;
        printUser = config.showUser;
        printTime = config.showTime;
        showRts = config.showRetweet;
        formatterFunction = config.dateFunction;
        customCallbackFunction = config.customCallback;
        showInteractionLinks = config.showInteraction;
        showImages = config.showImages;
        useEmoji = config.useEmoji;
        targetBlank = config.linksInNewWindow;
        permalinks = config.showPermalinks;
        dataOnly = config.dataOnly;
        var head = document.getElementsByTagName("head")[0];

        if (script !== null) {
          head.removeChild(script);
        }

        script = document.createElement("script");
        script.type = "text/javascript";

        if (config.list !== undefined) {
          script.src = "https://syndication.twitter.com/timeline/list?" + "callback=__twttrf.callback&dnt=false&list_slug=" + config.list.listSlug + "&screen_name=" + config.list.screenName + "&suppress_response_codes=true&lang=" + (config.lang || lang) + "&rnd=" + Math.random();
        } else if (config.profile !== undefined) {
          script.src = "https://syndication.twitter.com/timeline/profile?" + "callback=__twttrf.callback&dnt=false" + "&screen_name=" + config.profile.screenName + "&suppress_response_codes=true&lang=" + (config.lang || lang) + "&rnd=" + Math.random();
        } else if (config.likes !== undefined) {
          script.src = "https://syndication.twitter.com/timeline/likes?" + "callback=__twttrf.callback&dnt=false" + "&screen_name=" + config.likes.screenName + "&suppress_response_codes=true&lang=" + (config.lang || lang) + "&rnd=" + Math.random();
        } else {
          script.src = "https://cdn.syndication.twimg.com/widgets/timelines/" + config.id + "?&lang=" + (config.lang || lang) + "&callback=__twttrf.callback&" + "suppress_response_codes=true&rnd=" + Math.random();
        }

        head.appendChild(script);
      }
    },
    callback: function callback(data) {
      if (data === undefined || data.body === undefined) {
        inProgress = false;

        if (queue.length > 0) {
          twitterFetcher.fetch(queue[0]);
          queue.splice(0, 1);
        }

        return;
      } // Remove emoji and summary card images.


      if (!useEmoji) {
        data.body = data.body.replace(/(<img[^c]*class="Emoji[^>]*>)|(<img[^c]*class="u-block[^>]*>)/g, "");
      } // Remove display images.


      if (!showImages) {
        data.body = data.body.replace(/(<img[^c]*class="NaturalImage-image[^>]*>|(<img[^c]*class="CroppedImage-image[^>]*>))/g, "");
      } // Remove avatar images.


      if (!printUser) {
        data.body = data.body.replace(/(<img[^c]*class="Avatar"[^>]*>)/g, "");
      }

      var div = document.createElement("div");
      div.innerHTML = data.body;

      if (typeof div.getElementsByClassName === "undefined") {
        supportsClassName = false;
      }

      function swapDataSrc(element) {
        var avatarImg = element.getElementsByTagName("img")[0];

        if (avatarImg) {
          avatarImg.src = avatarImg.getAttribute("data-src-2x");
        } else {
          var screenName = element.getElementsByTagName("a")[0].getAttribute("href").split("twitter.com/")[1];
          var img = document.createElement("img");
          img.setAttribute("src", "https://twitter.com/" + screenName + "/profile_image?size=bigger");
          element.prepend(img);
        }

        return element;
      }

      var tweets = [];
      var authors = [];
      var times = [];
      var images = [];
      var rts = [];
      var tids = [];
      var permalinksURL = [];
      var x = 0;

      if (supportsClassName) {
        var tmp = div.getElementsByClassName("timeline-Tweet");

        while (x < tmp.length) {
          if (tmp[x].getElementsByClassName("timeline-Tweet-retweetCredit").length > 0) {
            rts.push(true);
          } else {
            rts.push(false);
          }

          if (!rts[x] || rts[x] && showRts) {
            tweets.push(tmp[x].getElementsByClassName("timeline-Tweet-text")[0]);
            tids.push(tmp[x].getAttribute("data-tweet-id"));

            if (printUser) {
              authors.push(swapDataSrc(tmp[x].getElementsByClassName("timeline-Tweet-author")[0]));
            }

            times.push(tmp[x].getElementsByClassName("dt-updated")[0]);
            permalinksURL.push(tmp[x].getElementsByClassName("timeline-Tweet-timestamp")[0]);

            if (tmp[x].getElementsByClassName("timeline-Tweet-media")[0] !== undefined) {
              images.push(tmp[x].getElementsByClassName("timeline-Tweet-media")[0]);
            } else {
              images.push(undefined);
            }
          }

          x++;
        }
      } else {
        var tmp = getElementsByClassName(div, "timeline-Tweet");

        while (x < tmp.length) {
          if (getElementsByClassName(tmp[x], "timeline-Tweet-retweetCredit").length > 0) {
            rts.push(true);
          } else {
            rts.push(false);
          }

          if (!rts[x] || rts[x] && showRts) {
            tweets.push(getElementsByClassName(tmp[x], "timeline-Tweet-text")[0]);
            tids.push(tmp[x].getAttribute("data-tweet-id"));

            if (printUser) {
              authors.push(swapDataSrc(getElementsByClassName(tmp[x], "timeline-Tweet-author")[0]));
            }

            times.push(getElementsByClassName(tmp[x], "dt-updated")[0]);
            permalinksURL.push(getElementsByClassName(tmp[x], "timeline-Tweet-timestamp")[0]);

            if (getElementsByClassName(tmp[x], "timeline-Tweet-media")[0] !== undefined) {
              images.push(getElementsByClassName(tmp[x], "timeline-Tweet-media")[0]);
            } else {
              images.push(undefined);
            }
          }

          x++;
        }
      }

      if (tweets.length > maxTweets) {
        tweets.splice(maxTweets, tweets.length - maxTweets);
        authors.splice(maxTweets, authors.length - maxTweets);
        times.splice(maxTweets, times.length - maxTweets);
        rts.splice(maxTweets, rts.length - maxTweets);
        images.splice(maxTweets, images.length - maxTweets);
        permalinksURL.splice(maxTweets, permalinksURL.length - maxTweets);
      }

      var arrayTweets = [];
      var x = tweets.length;
      var n = 0;

      if (dataOnly) {
        while (n < x) {
          arrayTweets.push({
            tweet: tweets[n].innerHTML,
            author: authors[n] ? authors[n].innerHTML : "Unknown Author",
            author_data: {
              profile_url: authors[n] ? authors[n].querySelector('[data-scribe="element:user_link"]').href : null,
              profile_image: authors[n] ? "https://twitter.com/" + authors[n].querySelector('[data-scribe="element:screen_name"]').title.split("@")[1] + "/profile_image?size=bigger" : null,
              profile_image_2x: authors[n] ? "https://twitter.com/" + authors[n].querySelector('[data-scribe="element:screen_name"]').title.split("@")[1] + "/profile_image?size=original" : null,
              screen_name: authors[n] ? authors[n].querySelector('[data-scribe="element:screen_name"]').title : null,
              name: authors[n] ? authors[n].querySelector('[data-scribe="element:name"]').title : null
            },
            time: times[n].textContent,
            timestamp: times[n].getAttribute("datetime").replace("+0000", "Z").replace(/([\+\-])(\d\d)(\d\d)/, "$1$2:$3"),
            image: extractImagesUrl(images[n]) ? extractImagesUrl(images[n])[0] : undefined,
            images: extractImagesUrl(images[n]),
            rt: rts[n],
            tid: tids[n],
            permalinkURL: permalinksURL[n] === undefined ? "" : permalinksURL[n].href
          });
          n++;
        }
      } else {
        while (n < x) {
          if (typeof formatterFunction !== "string") {
            var datetimeText = times[n].getAttribute("datetime");
            var newDate = new Date(times[n].getAttribute("datetime").replace(/-/g, "/").replace("T", " ").split("+")[0]);
            var dateString = formatterFunction(newDate, datetimeText);
            times[n].setAttribute("aria-label", dateString);

            if (tweets[n].textContent) {
              // IE hack.
              if (supportsClassName) {
                times[n].textContent = dateString;
              } else {
                var h = document.createElement("p");
                var t = document.createTextNode(dateString);
                h.appendChild(t);
                h.setAttribute("aria-label", dateString);
                times[n] = h;
              }
            } else {
              times[n].textContent = dateString;
            }
          }

          var op = "";

          if (parseLinks) {
            if (targetBlank) {
              targetLinksToNewWindow(tweets[n]);

              if (printUser) {
                targetLinksToNewWindow(authors[n]);
              }
            }

            if (printUser) {
              op += '<div class="user">' + strip(authors[n].innerHTML) + "</div>";
            }

            op += '<p class="tweet">' + strip(tweets[n].innerHTML) + "</p>";

            if (printTime) {
              if (permalinks) {
                op += '<p class="timePosted"><a href="' + permalinksURL[n] + '">' + times[n].getAttribute("aria-label") + "</a></p>";
              } else {
                op += '<p class="timePosted">' + times[n].getAttribute("aria-label") + "</p>";
              }
            }
          } else {
            if (tweets[n].textContent) {
              if (printUser) {
                op += '<p class="user">' + authors[n].textContent + "</p>";
              }

              op += '<p class="tweet">' + tweets[n].textContent + "</p>";

              if (printTime) {
                op += '<p class="timePosted">' + times[n].textContent + "</p>";
              }
            } else {
              if (printUser) {
                op += '<p class="user">' + authors[n].textContent + "</p>";
              }

              op += '<p class="tweet">' + tweets[n].textContent + "</p>";

              if (printTime) {
                op += '<p class="timePosted">' + times[n].textContent + "</p>";
              }
            }
          }

          if (showInteractionLinks) {
            op += '<p class="interact"><a href="https://twitter.com/intent/' + "tweet?in_reply_to=" + tids[n] + '" class="twitter_reply_icon"' + (targetBlank ? ' target="_blank" rel="noopener">' : ">") + 'Reply</a><a href="https://twitter.com/intent/retweet?' + "tweet_id=" + tids[n] + '" class="twitter_retweet_icon"' + (targetBlank ? ' target="_blank" rel="noopener">' : ">") + "Retweet</a>" + '<a href="https://twitter.com/intent/favorite?tweet_id=' + tids[n] + '" class="twitter_fav_icon"' + (targetBlank ? ' target="_blank" rel="noopener">' : ">") + "Favorite</a></p>";
          }

          if (showImages && images[n] !== undefined && extractImagesUrl(images[n]) !== undefined) {
            var extractedImages = extractImagesUrl(images[n]);

            for (var i = 0; i < extractedImages.length; i++) {
              op += '<div class="media">' + '<img src="' + extractedImages[i] + '" alt="Image from tweet" />' + "</div>";
            }
          }

          if (showImages) {
            arrayTweets.push(op);
          } else if (!showImages && tweets[n].textContent.length) {
            arrayTweets.push(op);
          }

          n++;
        }
      }

      handleTweets(arrayTweets);
      inProgress = false;

      if (queue.length > 0) {
        twitterFetcher.fetch(queue[0]);
        queue.splice(0, 1);
      }
    }
  }; // It must be a global variable because it will be called by JSONP.

  window.__twttrf = twitterFetcher;
  window.twitterFetcher = twitterFetcher;
  return twitterFetcher;
}); // Prepend polyfill for IE/Edge.


(function (arr) {
  arr.forEach(function (item) {
    if (item.hasOwnProperty("prepend")) {
      return;
    }

    Object.defineProperty(item, "prepend", {
      configurable: true,
      enumerable: true,
      writable: true,
      value: function prepend() {
        var argArr = Array.prototype.slice.call(arguments),
            docFrag = document.createDocumentFragment();
        argArr.forEach(function (argItem) {
          var isNode = argItem instanceof Node;
          docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
        });
        this.insertBefore(docFrag, this.firstChild);
      }
    });
  });
})([Element.prototype, Document.prototype, DocumentFragment.prototype]);
},{}],"client/app.js":[function(require,module,exports) {
"use strict";

var _instafeed = _interopRequireDefault(require("./instafeed"));

require("../client/twitterFetcher.js");

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
    profile: {
      screenName: "LFBrewery"
    },
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

  var feed = new _instafeed.default({
    get: "user",
    limit: 4,
    accessToken: "296366000.1677ed0.5880677c1fd8462d9f99a523c2f77e40",
    userId: 296366000,
    resolution: "standard_resolution",
    template: '<a class="instagram bg {{orientation}}" href="{{link}}" target="_blank" style="background-image:url({{image}})"/><span class="instagram__caption"><span class="instagram__caption-text"><span class="icon-instagram instagram__caption-icon"></span><span class="caption__text">{{caption}}</span></span></span></a>'
  });

  if (document.getElementById("instafeed")) {
    feed.run();
  }
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
},{"./instafeed":"client/instafeed.js","../client/twitterFetcher.js":"client/twitterFetcher.js"}],"../../node_modules/parcel-bundler/src/builtins/bundle-url.js":[function(require,module,exports) {
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
  return ('' + url).replace(/^((?:https?|file|ftp|chrome-extension|moz-extension):\/\/.+)\/[^/]+$/, '$1') + '/';
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
  var ws = new WebSocket(protocol + '://' + hostname + ':' + "50121" + '/');

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
      } else {
        window.location.reload();
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