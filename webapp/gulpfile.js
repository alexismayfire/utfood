/**
 * Gulpfile setup
 * @link https://ahmadawais.com/my-advanced-gulp-workflow-for-wordpress-themes/
 */

// Project configuration
var project 		     = 'utFood-webapp',      // Project name, used for build zip.
	url 			     = 'utFood-webapp.dev',  // Local Development URL for BrowserSync. Change as-needed.
	url_subdir           = '',   				 // Url where the project runs
	paths = {
		dest_dir		 : '.',				     // Destination dir
		angular_dir		 : './app',				 // Angular app dir
		tmp_dir          : './.tmp',			 // Angular temporary dir
		node_modules_dir : './node_modules'
	};


// Load plugins
var gulp          = require('gulp'),
	debug         = require('gulp-debug'),
	notify        = require('gulp-notify'),

	// JS and CSS
	concat        = require('gulp-concat'),
	uglify        = require('gulp-uglify'),
	assetVersion  = require('gulp-asset-version'),
	pixrem		  = require('gulp-pixrem'), 	  // Generates pixel fallbacks for rem units
	autoprefixer  = require('gulp-autoprefixer'), // Autoprefixing magic
	plumber       = require('gulp-plumber'),      // Helps prevent stream crashing on errors
	sourcemaps    = require('gulp-sourcemaps'),
	minifycss     = require('gulp-uglifycss'),
	stripcomments = require('gulp-strip-css-comments'),
	filter        = require('gulp-filter'),
	rename        = require('gulp-rename'),
	sass          = require('gulp-sass'),
	jshint        = require('gulp-jshint'),
	browser_sync  = require('browser-sync').create(),

	// AngularJS
	templateCache = require('gulp-angular-templatecache'),
	htmlmin       = require('gulp-htmlmin'),

	// Images and Zip
	imagemin      = require('gulp-imagemin'),
	newer         = require('gulp-newer'),		  // Helps to pass through newer files only
	rimraf        = require('gulp-rimraf'),       // Helps with removing files and directories in our run tasks
	zip           = require('gulp-zip');          // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!

// Timestamp for cache busting
var getStamp = function() {
	var myDate = new Date();

	var myYear = myDate.getFullYear().toString();
	var myMonth = ('0' + (myDate.getMonth() + 1)).slice(-2);
	var myDay = ('0' + myDate.getDate()).slice(-2);
	var mySeconds = myDate.getSeconds().toString();

	return myYear + myMonth + myDay;
};

/**
 * Styles
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 * Sass output styles: https://web-design-weekly.com/2014/06/15/different-sass-output-styles/
 */
gulp.task('styles', function () {
	gulp.src('./sass/*.scss')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({
			errLogToConsole: true,
			outputStyle: 'expanded', // 'compressed', 'compact', 'nested', 'expanded'
			precision: 10
		}))
		.pipe(pixrem())
		.pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		.pipe(stripcomments({ preserve : /^# sourceMappingURL=/ })) // Strip comments from CSS - except for sourceMappingUrl
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest(paths.dest_dir + '/css/'))
		.pipe(filter('**/*.css'))                // Filtering stream to only css files
		//.pipe(debug())						 // Debug Vinyl file streams to see what files are run through your Gulp pipeline
		.pipe(sourcemaps.init())
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss())
		//.pipe(sourcemaps.write('./maps')) // maps for minified css?
		.pipe(gulp.dest(paths.dest_dir + '/css/'))
		.pipe(notify({ message: 'Styles task complete', onLast: true }))
});

/**
 * Load assets
 * Copy the fonts, js and styles from used libs to the correct public place
 */
gulp.task('load-assets', function() {
	gulp.src([
		paths.node_modules_dir + '/font-awesome/fonts/*',               // Font-Awesome Fonts
		paths.node_modules_dir + '/bootstrap-sass/assets/fonts/**'      // Bootstrap Fonts - We copy this, but by default we don't use it
	])
		.pipe(gulp.dest(paths.dest_dir + '/fonts'))
		.pipe(notify({ message: 'Load Fonts task complete', onLast: true }));
});


/**
 * Scripts
 * Look at /app/ files, concatenate and send to /js where we then minimize the concatenated file.
 */
gulp.task('scripts', function() {
	gulp.src([
		//node_modules_dir + '/jquery/dist/jquery.min.js',

		paths.node_modules_dir + '/angular/angular.min.js',
		paths.node_modules_dir + '/angular-ui-router/release/angular-ui-router.min.js',
		paths.node_modules_dir + '/angular-animate/angular-animate.min.js',
		paths.node_modules_dir + '/angular-ui-bootstrap/dist/ui-bootstrap.js',

		paths.angular_dir + '/app.module.js',
		paths.angular_dir + '/app.constant.js',
		paths.angular_dir + '/app.route.js',

		paths.angular_dir + '/app.controller.js',
		paths.angular_dir + '/footer/footer.controller.js',
		paths.angular_dir + '/toolbar/toolbar.controller.js',
		paths.angular_dir + '/content/content.controller.js',
		paths.angular_dir + '/navigation/navigation.controller.js',
        paths.angular_dir + '/navigation/estabelecimentos.controller.js',

		paths.angular_dir + '/home/home.controller.js',
	])
		//.pipe(debug())						 // Debug Vinyl file streams to see what files are run through your Gulp pipeline
		.pipe(concat('scripts.js'))
		.pipe(gulp.dest(paths.dest_dir + '/js/'))
		.pipe(rename({
			basename: 'scripts',
			suffix: '.min'
		}))
		.pipe(uglify())
		.pipe(gulp.dest(paths.dest_dir + '/js/'))
		.pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

/**
 * Asset versioning
 * Add version after file's name by content hash
 */
gulp.task('asset-version', function() {
	gulp.src('./index.html', { base: './' })
		//.pipe(debug())						 // Debug Vinyl file streams to see what files are run through your Gulp pipeline
    	.pipe(assetVersion())
    	.pipe(gulp.dest(paths.dest_dir + '/'))
		.pipe(notify({ message: 'Assets Versioning task complete', onLast: true }));
});

/**
 * Angular template cache
 * Fills in the Angular template cache, to prevent loading the html templates via separate http requests
 */
//gulp.task('build-template-cache', function() {
//
//    return gulp.src(paths.angular_dir + "/**/*.html")
//    	.pipe(htmlmin({collapseWhitespace: true, removeComments: true}))
//        .pipe(templateCache({
//        	module: 'app.core',
//            standalone: false,
//        	root: 'app/'
//        }))
//        .pipe(concat("templateCacheHtml.js"))
//        .pipe(gulp.dest(paths.tmp_dir));
//});

/**
 * jshint
 * runs jshint
 */
gulp.task('jshint', function() {
    gulp.src(paths.angular_dir + '/**/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(notify({ message: 'JS Hint task complete', onLast: true }));
});

// ==== TASKS ==== //

/**
 * Gulp Default Task
 * Compiles styles, fires-up browser sync, watches js and php files. Note browser sync task watches php files
 */

// Default Task
gulp.task('default', ['load-assets', 'styles', 'scripts', 'jshint', 'asset-version'], function () {

});

/**
 * Browser Sync
 * Creates a small server that runs our project
 */
gulp.task('browser-sync', function() {
	browser_sync.init({
        server: {
            baseDir: './'
        }
    });
});

// Watch Task
gulp.task('watch', ['browser-sync'], function () {
	gulp.watch('./sass/*.scss', ['styles', 'asset-version']);
	gulp.watch( paths.angular_dir + '/**/*.js', ['scripts', 'jshint', 'asset-version']);
	gulp.watch('./*.html').on('change', browser_sync.reload);
});
