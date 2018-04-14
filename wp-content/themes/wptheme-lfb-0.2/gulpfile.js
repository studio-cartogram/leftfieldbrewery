"use strict";

// Include Gulp & tools we'll use
var gulp = require("gulp");
var $ = require("gulp-load-plugins")();
var del = require("del");
var runSequence = require("run-sequence");
var browserSync = require("browser-sync");
var pagespeed = require("psi");
var reload = browserSync.reload;
var args = require("yargs").argv;
// var browserify = require("browserify");
// var babelify = require("babelify");
// var source = require("vinyl-source-stream");
var webpack = require("webpack-stream");

var AUTOPREFIXER_BROWSERS = [
  "ie >= 10",
  "ie_mob >= 10",
  "ff >= 30",
  "chrome >= 34",
  "safari >= 7",
  "opera >= 23",
  "bb >= 10"
];

var paths = {
  dist: "dist",
  src: "src"
};

// Lint JavaScript
gulp.task("jshint", function() {
  return gulp
    .src([paths.src + "/scripts/main.jsx"])
    .pipe(reload({ stream: true, once: true }))
    .pipe($.jshint())
    .pipe($.jshint.reporter("jshint-stylish"))
    .pipe($.if(!browserSync.active, $.jshint.reporter("fail")));
});

gulp.task("scripts", function() {
  return gulp
    .src(paths.src + "scripts/index.js")
    .pipe(webpack(require("./webpack.config.js")))
    .pipe(gulp.dest(paths.dist + "/scripts"));
});

// Build Version 1 Script File
gulp.task("legacy", function() {
  return (
    gulp
      .src([
        paths.src + "/scripts/foundation/jquery.foundation.mediaQueryToggle.js",
        paths.src + "/scripts/foundation/jquery.foundation.forms.js",
        paths.src + "/scripts/foundation/jquery.foundation.navigation.js",
        paths.src + "/scripts/foundation/jquery.foundation.buttons.js",
        paths.src + "/scripts/foundation/jquery.foundation.tabs.js",
        paths.src + "/scripts/foundation/jquery.placeholder.js",
        paths.src + "/scripts/foundation/jquery.foundation.topbar.js",
        paths.src + "/scripts/foundation/jquery.cookie.js",
        paths.src + "/scripts/foundation/app.js",
        paths.src + "/scripts/client/jquery.flexslider.js",
        paths.src + "/scripts/client/twitterFetcher.js",
        paths.src + "/scripts/client/instafeed.js",
        paths.src + "/scripts/client/gf.placeholders.js",
        paths.src + "/scripts/client/app.js"
      ])
      // .pipe($.print())
      .pipe($.concat("legacy.js"))
      .pipe($.if(!args.debug, $.uglify()))
      .pipe(gulp.dest(paths.dist + "/scripts/"))
      .pipe($.size({ title: "scripts" }))
  );
});

// Compile and automatically prefix stylesheets
gulp.task("styles", function() {
  // For best performance, don't add Sass partials to `gulp.src`
  return (
    gulp
      .src([paths.src + "/styles/*.scss"])
      .pipe($.sourcemaps.init())
      .pipe(
        $.sass({
          precision: 10,
          onError: console.error.bind(console, "Sass error:")
        })
      )
      .pipe($.autoprefixer({ browsers: AUTOPREFIXER_BROWSERS }))
      .pipe($.sourcemaps.write())
      .pipe($.rename("main.css"))
      // Concatenate and minify styles
      .pipe($.if("*.css", $.csso()))
      .pipe(gulp.dest(paths.dist + "/styles"))
      .pipe($.size({ title: "styles" }))
  );
});

// Optimize images
gulp.task("images", function() {
  return (
    gulp
      .src(paths.src + "/images/**/*")
      .pipe(
        $.cache(
          $.imagemin({
            progressive: true,
            interlaced: true
          })
        )
      )
      // .pipe($.print())
      .pipe(gulp.dest(paths.dist + "/images"))
      .pipe($.size({ title: "images" }))
  );
});

// Copy web fonts to dist
gulp.task("fonts", function() {
  return gulp
    .src([paths.src + "/fonts/**"])
    .pipe(gulp.dest(paths.dist + "/fonts"))
    .pipe($.size({ title: "fonts" }));
});

//SVGS
gulp.task("svgs", function() {
  var config = {
    mode: {
      symbol: {
        sprite: "svgs.php",
        inline: true,
        dest: "../"
      }
    }
  };
  gulp
    .src(["images/**/*.svg"], { cwd: paths.src })
    .pipe($.svgSprite(config))
    .pipe(gulp.dest(paths.src));
});

// copy legacy code to dist
gulp.task("v1", function() {
  gulp
    .src([paths.src + "/styles/v1.css"])
    .pipe(gulp.dest(paths.dist + "/styles"));

  gulp
    .src([paths.src + "/scripts/modernizr.custom.js"])
    .pipe(gulp.dest(paths.dist + "/scripts"));
});

// Clean output directory
gulp.task("clean", del.bind(null, [".tmp", paths.dist], { dot: true }));

// Watch files for changes & reload
gulp.task(
  "default",
  [/*"styles", "images", "svgs", "fonts", "v1", "legacy",*/ "scripts"],
  function() {
    browserSync({
      notify: false,
      // Customize the BrowserSync console logging prefix
      logPrefix: "WSK",
      // Run as an https by uncommenting 'https: true'
      // Note: this uses an unsigned certificate which on first access
      //       will present a certificate warning in the browser.
      // https: true,
      // server: ['.tmp', '/']
      proxy: "leftfieldbrewery.local"
    });

    gulp.watch(["**/*.php"], reload);
    gulp.watch([paths.src + "/styles/**/*.{scss,css}"], ["styles", reload]);
    gulp.watch([paths.src + "/scripts/**/*.{js,jsx}"], ["scripts", reload]);
    gulp.watch(
      [
        paths.src + "/scripts/foundation/*.js",
        paths.src + "/scripts/client/*.js"
      ],
      ["legacy"]
    );
    gulp.watch([paths.src + "/images/**/*"], reload);
  }
);
