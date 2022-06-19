var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var shell = require('gulp-shell');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();

// Compiling sass files
gulp.task('sass', function () {
    return gulp.src('./sass/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./'));
});

// Make binary files for languages
gulp.task('languages', function () {
    return gulp.src('./languages/*')
        .pipe(shell([
            'msgfmt -o ./languages/en_UK.mo ./languages/en_UK.po; msgfmt -o ./languages/fa_IR.mo ./languages/fa_IR.po; msgfmt -o ./languages/en_US.mo ./languages/en_US.po'
        ]));
});

gulp.task('browser-sync', function () {

    //gulp.watch('./js/app.js', ['js']).on('change', browserSync.reload);
});

// gulp watchers
gulp.task('default', function() {
    if(false) {
        browserSync.init({
            proxy: "http://hardippatel.test",
            host: "hardippatel.test",
            open: 'external',
            port: 81,
            https: {
                key:
                    '/Users/' +
                    'knightkill' +
                    '/.config/valet/Certificates/' +
                    'hardippatel.test' +
                    '.key',
                cert:
                    '/Users/' +
                    'knightkill' +
                    '/.config/valet/Certificates/' +
                    'hardippatel.test' +
                    '.crt'
            },
            notify: false
        });
    }
    gulp.watch('./sass/*', gulp.parallel(['sass'])).addListener;
    gulp.watch('./languages/*', gulp.parallel(['languages'])).addListener;
});
