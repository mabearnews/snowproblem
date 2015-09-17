'use strict';

var gulp = require('gulp');
var gutil = require('gulp-util');
var compass = require('gulp-compass');
var coffee = require('gulp-coffee');
var zip = require('gulp-zip');

gulp.task('compass', function() {
  gulp.src('./sass/*.scss')
    .pipe(compass({
    config_file: './config.rb',
      css: 'stylesheets',
      sass: 'sass'
    }))
  //.pipe(gulp.dest('app/assets/temp'));
  });

  gulp.task('coffee', function() {
  gulp.src('./coffee/*.coffee')
    .pipe(coffee({bare: true}).on('error', gutil.log))
    .pipe(gulp.dest('./js/'))
  });

  gulp.task('zip', ["compass", "coffee"], function() {
  gulp.src(['./**',
    '!./coffee/**',
    '!./sass/**',
    '!./scripts/**',
    '!./.sass-cache/**',
    '!./.git/**',
    '!./dist/**'
  ])
    .pipe(zip('snowproblem.zip'))
    .pipe(gulp.dest('dist'));

  });

  gulp.task('default', ['zip']);
