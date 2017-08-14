'use strict';
var pkg = require('./package.json');
var fs = require('fs');

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');

gulp.task('css', ['sass'], function () {
    return gulp.src('./web/assets/css/dest/**/*.css')
        .pipe(concatCss("web/assets/css/style.css"))
        .pipe(gulp.dest('./'));
});

gulp.task('sass', function () {
    return gulp.src('./web/assets/sass/**/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./web/assets/css/dest'))
});

gulp.task('sass:watch', function () {
    gulp.watch('./web/assets/sass/**/*.scss', ['sass', 'css']);
});

gulp.task('default', ['sass', 'css']);