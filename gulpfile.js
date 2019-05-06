const {
    src,
    dest,
    watch,
    series,
    parallel
} = require('gulp');
const browsersync = require('browser-sync').create();
const autoprefixer = require('gulp-autoprefixer');
const purgecss = require("gulp-purgecss");
const cleanCSS = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const tailwindcss = require('tailwindcss');
const sass = require('gulp-sass');
const del = require('del');
const package = require('./package.json');
const sasslint = require('gulp-sass-lint');
const exit = require('gulp-exit');

const filesToExclude = [
    "**/*",
    "!.vscode",
    "!node_modules{,/**}",
    "!src{,/**}",
    "!sass{,/**}",
    "!scss{,/**}",
    "!.babelrc",
    "!.gitignore",
    "!gulpfile.babel.js",
    "!package.json",
    "!package-lock.json",
    "!tailwind.config.js",
    "!gulpfile.js",
    "!purgecssWhitelist.php"
]

class TailwindExtractor {
    static extract(content) {
        return content.match(/[A-z0-9-:\/]+/g) || [];
    }
}

// Compile CSS from Sass.
function buildStyles() {
    return src('sass/style.scss')
        .pipe(sass())
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7']))
        .pipe(postcss([
            autoprefixer,
            tailwindcss
        ]))
        .pipe(dest('./'))
        .pipe(browsersync.reload({
            stream: true
        }));
}

// Watch changes on all *.scss files, lint them and
// trigger buildStyles() at the end.
function watchFiles() {
    watch(
        ['sass/*.scss', 'sass/**/*.scss'], {
            events: 'all',
            ignoreInitial: false
        },
        series(sassLint, buildStyles)
    );
}

// Reload when files change
browsersync.watch(['*.php', 'js/**/*.js']).on('change', browsersync.reload);

// Init BrowserSync.
function browserSync(done) {
    browsersync.init({
        proxy: 'http://localhost:8888/wordpress-starter/' // Change this value to match your local URL.
    });
    done();
}

// Init Sass linter.
function sassLint() {
    return src(['scss/*.scss', 'scss/**/*.scss'])
        .pipe(sasslint({
            configFile: '.sass-lint.yml'
        }))
        .pipe(sasslint.format())
        .pipe(sasslint.failOnError());
}

// Remove build folder 
function clean() {
    return del(['build/']);
}

// Purge and minify css
function purge() {
    return src('style.css')
        .pipe(
            purgecss({
                content: ["*.php"],
                extractors: [{
                    extractor: TailwindExtractor,
                    extensions: ["html", "php", "js", "sass", "scss", "css"]
                }]
            })
        )
        .pipe(cleanCSS())
        .pipe(dest('./'))
}

// Add files to build folder
function copy() {
    return src(filesToExclude)
        .pipe(dest('build/'))
        .pipe(exit());
}

// Export commands.
exports.default = parallel(browserSync, watchFiles); // $ gulp
exports.sass = buildStyles; // $ gulp sass
exports.watch = watchFiles; // $ gulp watch
exports.build = series(clean, purge, copy); // $ gulp build