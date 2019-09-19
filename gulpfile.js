'use strict';
const gulp=require('gulp');
const sass=require('gulp-sass');
const watch=require('gulp-watch');
const imagemin = require('gulp-imagemin');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');



gulp.task('sass',function(){
    return gulp.src('src/css/*.scss')
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(sass())
    .pipe(uglifycss({
        "maxLineLen": 80,
        "uglyComments": true
      }))
    .pipe(autoprefixer({
        browsers: ['last 12 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('dist/css'));
});

gulp.task('sass:watch',function(){
    return gulp.watch('src/**/*.scss',['sass']);
});

gulp.task('uglify', function() {
    gulp.src('src/js/*.js')
      .pipe(uglify())
      .pipe(gulp.dest('dist/js'))
  });

gulp.task('img:watch', () =>
gulp.src('src/img/**/*.{jpg,jpeg,gif,png,svg,JPG,ico}')
    .pipe(imagemin([
        imagemin.gifsicle({interlaced: true}),
        imagemin.jpegtran({progressive: true}),
        imagemin.optipng({optimizationLevel: 5}),
        imagemin.svgo({
            plugins: [
                {removeViewBox: true},
                {cleanupIDs: false}
            ]
        })
    ]))
    .pipe(gulp.dest('dist/img'))
);

gulp.task('js',() =>
    gulp.src('src/**/*.js')
    .pipe(gulp.dest('dist'))
);
gulp.task('js:watch',() =>
    gulp.watch('src/**/*.js')
    
);
gulp.task('php',() =>
    gulp.src('src/**/*.php')
    .pipe(gulp.dest('dist'))
);
gulp.task('php:watch',() =>
    gulp.watch('src/**/*.php')
    
);


gulp.task('html',() =>
gulp.src('src/**/*.html')
.pipe(gulp.dest('dist'))
);
gulp.task('html:watch',() =>
gulp.watch('src/**/*.html',['html'])
);

gulp.task('fonts',() =>
gulp.src('src/**/*.{ttf,otf}')
.pipe(gulp.dest('dist/fonts'))
);
gulp.task('fonts:watch',() =>
gulp.watch('src/**/*.*')
);

gulp.task('serve', function() {
    browserSync.init({
        server: {
            baseDir: "dist/"
        }
    });
    gulp.watch("src/*.scss", ['sass']);
    gulp.watch('index.php').on('change', bs.reload);
    gulp.watch("src/js/*.js", ['js']);
});

gulp.task('build',['sass','sass:watch','img:watch','uglify','js','js:watch','html','html:watch','php','php:watch','fonts','fonts:watch','serve']);