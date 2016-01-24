// Requis
var gulp = require('gulp');

var less = require('gulp-less');
var watchLess = require('gulp-watch-less');
var path = require('path');


gulp.task('css', function () {
  return gulp.src('www/css/style.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('www/css/'));
});

gulp.task('watch', function () {
  gulp.watch(
      'www/css/style.less', ['css']
  )
});

/*gulp.task('css', function () {
return gulp.src('www/css/style.less')
  .pipe(plugins.less())
  .pipe(gulp.dest('www/css/'));
});*/
