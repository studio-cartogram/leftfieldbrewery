
'use strict';

// Include Gulp & tools we'll use
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var del = require('del');
var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var pagespeed = require('psi');
var reload = browserSync.reload;
var args = require('yargs').argv;

var AUTOPREFIXER_BROWSERS = [
  'ie >= 10',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'bb >= 10'
];

var paths = {
    dist : 'dist',
    src : 'src',
};

// Lint JavaScript
gulp.task('jshint', function () {
    return gulp.src([
        paths.src + '/scripts/main.js'
    ])
    .pipe(reload({stream: true, once: true}))
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'))
    .pipe($.if(!browserSync.active, $.jshint.reporter('fail')));
});

// Optimize Scripts
gulp.task('scripts',['jshint'], function () {
    return gulp.src([paths.src + '/scripts/main.js'])
    .pipe($.browserify({
        insertGlobals : true,
        debug : args.debug 
    }))
    .pipe($.print())
    .pipe(gulp.dest(paths.dist + '/scripts'))
    .pipe($.size({title: 'scripts'}));
});

// Build Vendor Script File
gulp.task('vendor', function () {
    return gulp.src([paths.src + '/scripts/vendor/*.js'])
    .pipe($.concat('vendor.js'))
    .pipe($.if(!args.debug, $.uglify()))
    .pipe($.print())
    .pipe(gulp.dest(paths.dist + '/scripts/'))
    .pipe($.size({title: 'scripts'}));
});

// Compile and automatically prefix stylesheets
gulp.task('styles', function () {
  // For best performance, don't add Sass partials to `gulp.src`
  return gulp.src([
    paths.src + '/styles/*.scss',
  ])
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      precision: 10,
      onError: console.error.bind(console, 'Sass error:')
    }))
    .pipe($.autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
    .pipe($.sourcemaps.write())
    .pipe($.rename('main.css'))
    // Concatenate and minify styles
    .pipe($.if('*.css', $.csso()))
    .pipe(gulp.dest(paths.dist + '/styles'))
    .pipe($.size({title: 'styles'}));
});

// Optimize images
gulp.task('images', function () {
  return gulp.src(paths.src + '/images/**/*')
    .pipe($.cache($.imagemin({
      progressive: true,
      interlaced: true
    })))
    .pipe($.print())
    .pipe(gulp.dest(paths.dist + '/images'))
    .pipe($.size({title: 'images'}));
});

// Copy web fonts to dist
gulp.task('fonts', function () {
  return gulp.src([paths.src + '/fonts/**'])
    .pipe(gulp.dest(paths.dist + '/fonts'))
    .pipe($.size({title: 'fonts'}));
});

//SVGS
gulp.task('svgs', function () {
    var config = {
    mode: {
        symbol: {
            sprite:'svgs.php',
            inline: true,
            dest: '../'
        }
    }}
    gulp.src(['images/**/*.svg'], {cwd: paths.src})
        .pipe($.svgSprite(config))
        .pipe(gulp.dest(paths.src));
});

// copy legacy code to dist
gulp.task('v1', function () {
    gulp.src([
        paths.src + '/styles/v1.css'
    ])
    .pipe(gulp.dest(paths.dist + '/styles'));

    gulp.src([
        paths.src + '/scripts/v1.js',
        paths.src + '/scripts/modernizr.custom.js'
    ])
    .pipe(gulp.dest(paths.dist + '/scripts'));
});

// Clean output directory
gulp.task('clean', del.bind(null, ['.tmp', paths.dist], {dot: true}));

// Watch files for changes & reload
gulp.task('default', [
    'styles',
    'images',
    'svgs',
    'fonts',
    'v1',
    'scripts'
], function () {
  browserSync({
    notify: false,
    // Customize the BrowserSync console logging prefix
    logPrefix: 'WSK',
    // Run as an https by uncommenting 'https: true'
    // Note: this uses an unsigned certificate which on first access
    //       will present a certificate warning in the browser.
    // https: true,
    // server: ['.tmp', '/']
    proxy: 'leftfieldbrewery.dev'
  });

  gulp.watch(['**/*.php'], reload);
  gulp.watch([paths.src + '/styles/**/*.{scss,css}'], ['styles', reload]);
  gulp.watch([paths.src + '/scripts/**/*.js'], ['scripts']);
  gulp.watch([paths.src + '/scripts/vendor/*.js'], ['vendor']);
  gulp.watch([paths.src + '/images/**/*'], reload);
});

