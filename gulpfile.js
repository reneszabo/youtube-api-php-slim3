var gulp = require('gulp'),
  connect = require('gulp-connect-php'),
  browserSync = require('browser-sync');

gulp.task('connect-sync', function() {
  connect.server({
    port:8001,
    base:'public'
  }, function (){
    browserSync({
      proxy: 'localhost:8001'
    });
  });
});

gulp.task('reload', function(){
  browserSync.reload();
});

gulp.task("default",['connect-sync'], function() {
  gulp.watch([
    "./src/**/*.*",
    "./templates/**/*.*"
  ],["reload"]);
});
