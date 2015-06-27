/* jshint node: true */
/* global $: true */
"use strict";

var gulp = require( "gulp" ),
    /** @type {Object} Loader of Gulp plugins from `package.json` */
    $ = require( "gulp-load-plugins" )(),
    /** @type {Array} JS source files to concatenate and uglify */
    uglifySrc = [
      /** Modernizr */
      "src/bower_components/modernizr/modernizr.js",
      /** Conditionizr */
      "src/js/lib/conditionizr-4.3.0.min.js",
      /** jQuery */
      "src/bower_components/jquery/dist/jquery.js",
      /** MixItUp */
      "src/bower_components/bower-mixitup/src/jquery.mixitup.js",
      /** Sticky Kit */
      "src/bower_components/sticky-kit/jquery.sticky-kit.js",
      /** GSAP */
      "src/bower_components/gsap/src/uncompressed/TweenMax.js",
      /** Fullpage.js */
      "src/bower_components/fullpage.js/jquery.fullPage.js",
      /** Animsition */
      "src/bower_components/animsition/dist/js/jquery.animsition.js",
      /** TextFill */
      "src/bower_components/jquery-textfill/source/jquery.textfill.js",
      /** Page scripts */
      "src/js/scripts.js"
    ],
    /** @type {Object of Array} CSS source files to concatenate and minify */
    cssminSrc = {
      development: [
        /** The banner of `style.css` */
        "src/css/banner.css",
        /** Animsition */
        "src/bower_components/animsition/dist/css/animsition.css",
        /** Theme style */
        "src/css/style.css"
      ],
      production: [
        /** The banner of `style.css` */
        "src/css/banner.css",
        /** Normalize */
        "src/bower_components/normalize.css/normalize.css",
        /** Animsition **/
        "src/bower_components/animsition/dist/css/animsition.css",
        /** Theme style */
        "src/css/style.css"
      ]
    },
    /** @type {String} Used inside task for set the mode to 'development' or 'production' */
    env = (function() {
      /** @type {String} Default value of env */
      var env = "development";

      /** Test if there was a different value from CLI to env
        Example: gulp styles --env=production
        When ES6 will be default. `find` will replace `some`  */
      process.argv.some(function( key ) {
        var matches = key.match( /^\-{2}env\=([A-Za-z]+)$/ );

        if ( matches && matches.length === 2 ) {
          env = matches[1];
          return true;
        }
      });

      return env;
    } ());

/** Clean */
gulp.task( "clean", require( "del" ).bind( null, [ ".tmp", "dist" ] ) );

/** Copy */
gulp.task( "copy", function() {
  return gulp.src([
      "src/*.{php,png,css}",
      "src/modules/*.php",
      "src/img/**/*.{jpg,png,svg,gif,webp,ico}",
      "src/fonts/*.{woff,woff2,ttf,otf,eot,svg}",
      "src/languages/*.{po,mo,pot}"
  ], {
    base: "src"
  })
  .pipe( gulp.dest( "dist" ) );
});

/** CSS Preprocessors */
gulp.task( "sass", function () {
  return gulp.src( "src/css/sass/style.scss" )
    .pipe( $.rubySass({
      style: "expanded",
      precision: 10
    }))
  .on( "error", function( e ) {
    console.error( e );
  })
  .pipe( gulp.dest( "src/css" ) );
});

/** STYLES */
gulp.task( "styles", [ "sass" ], function() {
  console.log( "`styles` task run in `" + env + "` environment" );

  var stream = gulp.src( cssminSrc[ env ] )
    .pipe( $.concat( "style.css" ))
    .pipe( $.autoprefixer( "last 2 version" ) );

  console.log(cssminSrc[ env ]);

  if ( env === "production" ) {
    stream = stream.pipe( $.csso() );
  }

  return stream.on( "error", function( e ) {
    console.error( e );
  })
  .pipe( gulp.dest( "src" ) );
});

/** JSHint */
gulp.task( "jshint", function () {
  /** Test all `js` files exclude those in the `lib` folder */
  return gulp.src( "src/js/{!(lib)/*.js,*.js}" )
    .pipe( $.jshint() )
    .pipe( $.jshint.reporter( "jshint-stylish" ) )
    .pipe( $.jshint.reporter( "fail" ) );
});

/** Templates */
gulp.task( "template", function() {
  console.log( "`template` task run in `" + env + "` environment" );

  var is_debug = ( env === "production" ? "false" : "true" );

  return gulp.src( "src/dev-templates/is-debug.php" )
    .pipe( $.template({ is_debug: is_debug }) )
    .pipe( gulp.dest( "src/modules" ) );
});

/** Uglify */
gulp.task( "uglify", function() {
  return gulp.src( uglifySrc )
    .pipe( $.concat( "scripts.min.js" ) )
    .pipe( $.uglify() )
    .pipe( gulp.dest( "dist/js" ) );
});

/** SVG Store for Icons */
gulp.task('svgstore', function () {
  var svgs = gulp
    .src('src/img/**/*.svg')
                      .pipe($.svgmin())
                      .pipe($.svgstore({ inlineSvg: true }));

                      function fileContents (filePath, file) {
                      return file.contents.toString();
                      }

                      return gulp
                      .src('src/header.php')
                      .pipe($.inject(svgs, { transform: fileContents }))
                      .pipe(gulp.dest('src'));
                      });

/** `env` to 'production' */
gulp.task( "envProduction", function() {
  env = "production";
});

/** Livereload */
gulp.task( "watch", [ "template", "styles", "jshint", "svgstore" ], function() {
  var server = $.livereload();

  /** Watch for livereoad */
  gulp.watch([
      "src/js/**/*.js",
      "src/*.php",
      "src/*.css",
      "src/img/**/*.svg"
  ]).on( "change", function( file ) {
    console.log( file.path );
    server.changed( file.path );
  });

  /** Watch for autoprefix */
  gulp.watch( [
      "src/css/*.css",
      "src/css/sass/**/*.scss"
  ], [ "styles" ] );

  /** Watch for JSHint */
  gulp.watch( "src/js/{!(lib)/*.js,*.js}", ["jshint"] );

  /** Watch for SVGstore */
  gulp.watch( "src/img/**/*.svg", ["svgstore"] );
});

gulp.task('default', function () {
  return gulp.src('src/img/*')
                            .pipe(imagemin({
                            progressive: true,
                            svgoPlugins: [{removeViewBox: false}],
                            use: [pngquant()]
                            }))
                            .pipe(gulp.dest('dist/img'));
                            });

/** Build */
gulp.task( "build", [
    "envProduction",
    "clean",
    "template",
    "styles",
    "jshint",
    "copy",
    "uglify"
], function () {
  console.log("Build is finished");
});
