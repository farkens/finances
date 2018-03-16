var gulp = require('gulp');
var postcss = require('gulp-postcss'); // npm install --save-dev gulp-postcss
var sass = require('gulp-sass'); //npm install gulp-sass --save-dev 
var nested = require('postcss-nested');//позволяет делать вложенности  npm install --save-dev postcss-nested
var autoprefixer = require('autoprefixer'); // npm install --save-dev autoprefixer



gulp.task('css', function () {
    var processors = [
        //nested,
        autoprefixer({browsers: ['last 2 version']}),
    ];
    return gulp.src('./web/scss/**/*')
    .pipe(sass())
    .pipe(postcss(processors))
    .pipe(gulp.dest('./web/css'));
});

//автозапуск при изменении 

// по команде gulp запускает task watch:css 
gulp.task('default', [ 'watch:css']);

// наблюдает за изменениями в указаном файле и запускает по ним task css
gulp.task('watch:css', function() {
  gulp.watch('./web/scss/**/*', ['css']);
});