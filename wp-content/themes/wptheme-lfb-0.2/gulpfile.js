"use strict";

// Include Gulp & tools we'll use
var gulp = require("gulp");
var $ = require("gulp-load-plugins")();

var paths = {
  dist: "dist",
  src: "src"
};

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

gulp.task("default", ["images", "svgs"]);
