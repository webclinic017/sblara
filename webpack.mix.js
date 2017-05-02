const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.combine([
    'public/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css',
    'public/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
    'public/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css',
    'public/metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
    'public/metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
    'public/metronic/assets/global/plugins/morris/morris.css',
    'public/metronic/assets/global/plugins/fullcalendar/fullcalendar.min.css',
    'public/metronic/assets/global/plugins/jqvmap/jqvmap/jqvmap.css',
    'public/metronic/assets/global/css/components-md.min.css',
    'public/metronic/assets/global/css/plugins-md.min.css',
    'public/metronic/assets/layouts/layout5/css/layout.min.css',
    'public/metronic_custom/custom.css'
], 'public/metronic_home.css');

mix.scripts([
    'public/metronic/assets/global/plugins/jquery.min.js',
    'public/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js',
    'public/metronic/assets/global/plugins/js.cookie.min.js',
    'public/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
    'public/metronic/assets/global/plugins/jquery.blockui.min.js',
    'public/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    'public/metronic/assets/global/plugins/moment.min.js',
    'public/metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
    'public/metronic/assets/global/plugins/morris/morris.min.js',
    'public/metronic/assets/global/plugins/morris/raphael-min.js',
    'public/metronic/assets/global/plugins/counterup/jquery.waypoints.min.js',
    'public/metronic/assets/global/plugins/counterup/jquery.counterup.min.js',
    'public/metronic/assets/global/plugins/fullcalendar/fullcalendar.min.js',
    'public/metronic/assets/global/plugins/horizontal-timeline/horizontal-timeline.js',
    'public/metronic/assets/global/plugins/flot/jquery.flot.min.js',
    'public/metronic/assets/global/plugins/flot/jquery.flot.resize.min.js',
    'public/metronic/assets/global/plugins/flot/jquery.flot.categories.min.js',
    'public/metronic/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js',
    'public/metronic/assets/global/plugins/jquery.sparkline.min.js',
    'public/metronic/assets/global/scripts/app.min.js',
    'public/metronic/assets/pages/scripts/dashboard.min.js',
    'public/metronic/assets/layouts/layout5/scripts/layout.min.js',
    'public/metronic/assets/layouts/global/scripts/quick-sidebar.min.js',
    'public/metronic/assets/layouts/global/scripts/quick-nav.min.js',
], 'public/metronic_home.js');


/*
*
* =>1st install node for windows
=> Go to project root
 => npm install  (npm install --no-bin-links does not work in our case)
 => Open webpack.mix.js from root of project
 => Run “npm run production” command
 => Add  following in head
 => <link href="{{ mix('/metronic_home.css') }}" rel="stylesheet" type="text/css" />
 => Copy all font to  public/fonts
 => Browse site from http://127.0.0.1:8000/
*
* */