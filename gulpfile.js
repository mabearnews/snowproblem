var gulp       = require('gulp');
var gutil      = require('gulp-util');
var compass    = require('gulp-compass');
var coffee     = require('gulp-coffee');
var concat     = require('gulp-concat');
var zip        = require('gulp-zip');
var connect    = require('gulp-connect-php');
var minifyCSS  = require( 'gulp-minify-css' );
var reactify   = require('reactify');
var browserify = require('browserify');
var source     = require('vinyl-source-stream');
var del        = require('del');

function swallowError( error ) {
    // If you want details of the error in the console
    console.log(error.toString());
    this.emit('end');
}


gulp.task('compass', function() {
    gulp.src('./sass/*.scss')
        .pipe(compass({
            images: 'images',
            css: 'stylesheets',
            sass: 'sass'
        }))
        .on( 'error', swallowError )
        .pipe(gulp.dest( 'dist/css' ));
});

gulp.task('js', function() {
    gulp.src('./js/*.js')
        .pipe(concat('main.js'))
        .pipe(gulp.dest('dist/js'));

    gulp.src('./js/ajax/*.js')
        .pipe(concat('ajax.js'))
        .pipe(gulp.dest('dist/js'));

    gulp.src('./js/plugins/*.js')
        .pipe(concat('plugins.js'))
        .pipe(gulp.dest('dist/js'));
});

gulp.task('react', function() {
    return browserify('./js/front/app.jsx')
    .transform(reactify)
    .bundle()
    .pipe(source('front.js'))
    .pipe(gulp.dest('./dist/js'));
})

gulp.task('clean', function() {
    del('dist');
});

gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', [ 'compass' ]);
    gulp.watch('js/**/*.js', [ 'js' ]);
    gulp.watch('js/front/**/*.jsx', ['react']);
});


gulp.task('serve', function() {
    connect.server({
        base: '../../..'
    });
});

gulp.task('default', ['compass', 'js', 'react']);
