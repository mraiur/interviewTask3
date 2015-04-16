var gulp = require('gulp'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    copy = require('gulp-copy'),
    bowerFiles = require('main-bower-files');

gulp.task('bower', function(){
    return gulp.src(bowerFiles())
        .pipe( gulp.dest('public/bower/') );
});

gulp.task('clean', function(){
    //TODO make any cleaning of directories or assets
});

gulp.task('sass', function(){
    gulp.src('./resources/sass/*.scss')
        .pipe( sass() )
        .pipe( gulp.dest('./public/stylesheets/') );
});

gulp.task('scripts', function(){
    gulp.src([
            './public/bower/jquery.js',
            './public/bower/bootstrap.js',
            './public/bower/jquery.event.swipe.js',
            './resources/js/main.js',
        ])
        .pipe( concat('app.js') )
        .pipe( gulp.dest('./public/javascript/') );
});

gulp.task('copy', function(){
    gulp.src([
        './public/bower/glyphicons*'
    ])
    .pipe( gulp.dest('./public/fonts/bootstrap/') );
});

gulp.task('default', [], function(){
    gulp.start('bower', 'sass', 'copy', 'scripts');
});