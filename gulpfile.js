const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const order = require('gulp-order');
const sourcemaps = require('gulp-sourcemaps');

// ---------- CSS ----------
// Ensure _variables.css is processed first
// to make sure CSS variables are available to all other CSS files
// and avoid duplication of _variables.css in final output
// ---------- CSS ----------
function minifyAndConcatCSS() {
  return gulp.src('css/**/*.css')
    .pipe(sourcemaps.init()) // <-- Initialize sourcemaps
    .pipe(order([
      '_variables.css',
      '**/*.css'
    ]))
    .pipe(concat('style.min.css'))
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(sourcemaps.write('.')) // <-- Write sourcemap alongside CSS
    .pipe(gulp.dest('assets/css'));
}

// ---------- JS (all) ----------
function minifyAndConcatJS() {
  return gulp.src([
      'js/**/*.js',
    ])
    .pipe(concat('scripts.min.js'))
    .pipe(terser())
    .pipe(gulp.dest('assets/js'));
}

// ---------- Watch ----------
function watchFiles() {
  gulp.watch('css/**/*.css', minifyAndConcatCSS);
  gulp.watch('js/**/*.js', minifyAndConcatJS);
}

// ---------- Expose tasks ----------
exports.css    = minifyAndConcatCSS;
exports.js     = minifyAndConcatJS;
exports.watch  = watchFiles;
exports.default = gulp.series(
  gulp.parallel(minifyAndConcatCSS, minifyAndConcatJS),
  watchFiles
);