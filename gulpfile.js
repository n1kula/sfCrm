// config
var rootAssetsDir = 'bower_components';
var projectAssetsDir = 'app/Resources/public';
var webDir = 'web';
var targetAssetsDir = webDir + '/assets';

// main
var gulp = require('gulp');

var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var changed = require('gulp-changed');
var less = require('gulp-less');

gulp.task('default', ['copy-fonts', 'copy-css', 'less', 'styles', 'scripts'], function() {
});

// JS concat and minify
gulp.task('scripts', function() {
    gulp.src([
        rootAssetsDir + '/jquery/dist/jquery.js',
        rootAssetsDir + '/jquery-ui/jquery-ui.js',
        rootAssetsDir + '/bootstrap/dist/js/bootstrap.js',
        projectAssetsDir + '/js/*.js'
    ])
    .pipe(concat('scripts.js'))
    .pipe(uglify())
    .pipe(gulp.dest(targetAssetsDir + '/js'));
});

// CSS concat and minify
gulp.task('styles', function() {
    gulp.src([
        rootAssetsDir + '/bootstrap/dist/css/bootstrap.min.css',
        rootAssetsDir + '/bootstrap/dist/css/bootstrap-theme.min.css',
        rootAssetsDir + '/font-awesome/css/font-awesome.min.css',
        projectAssetsDir + '/less/compiled/*.css' // less compiled css
    ])
    .pipe(concat('styles.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest(targetAssetsDir + '/css'));
});

// less files
gulp.task('less', function () {
    return gulp.src(projectAssetsDir + '/less/*.less')
        .pipe(less())
        .pipe(gulp.dest(projectAssetsDir + '/less/compiled/'));
});

//copy fonts
gulp.task('copy-fonts', function() {
    
    var filesToCopy = [
        rootAssetsDir + '/font-awesome/fonts/*',
        rootAssetsDir + '/bootstrap/dist/fonts/*'
    ];
    
    return gulp.src(filesToCopy)
        .pipe(gulp.dest(targetAssetsDir + '/fonts')); 
});

//copy files
gulp.task('copy-css', function() {
    
    var filesToCopy = [
        projectAssetsDir + '/css/*'
    ];
    
    return gulp.src(filesToCopy)
        .pipe(gulp.dest(targetAssetsDir + '/css')); 
});
