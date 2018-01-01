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
'public/metronic/assets/global/plugins/bootstrap-sweetalert/sweetalert.css',
'public/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
'public/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css',
'public/metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
'public/metronic/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css',

'public/metronic/assets/global/plugins/select2/css/select2.min.css',
'public/metronic/assets/global/plugins/select2/css/select2-bootstrap.min.css',
'public/metronic/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
'public/metronic/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
'public/metronic/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
'public/metronic/assets/global/plugins/clockface/css/clockface.css',
'public/metronic/assets/global/plugins/bootstrap-toastr/toastr.min.css',

'public/metronic/assets/pages/css/profile.min.css',
'public/metronic/assets/layouts/layout5/css/layout.min.css',
'public/metronic/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
'public/metronic/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
'public/metronic/assets/pages/css/search.min.css',
'public/metronic/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
'public/metronic/assets/global/css/components-md.min.css',
'public/metronic/assets/global/css/plugins-md.min.css',
'public/css/filter.css',
'public/vendor/jfu/css/jquery.fileupload-ui.css',
'public/maxazan-jquery-treegrid/css/jquery.treegrid.css',
'public/vendor/feedback/feedback.min.css',

], 'public/metronic_home.css');

mix.scripts([
'public/metronic/assets/global/plugins/jquery.min.js',
'public/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js',
'public/metronic/assets/global/plugins/js.cookie.min.js',
'public/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
'public/metronic/assets/global/plugins/jquery.blockui.min.js',
'public/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
'public/metronic/assets/global/plugins/counterup/jquery.waypoints.min.js',
'public/metronic/assets/global/plugins/counterup/jquery.counterup.min.js',
'public/metronic/assets/global/plugins/horizontal-timeline/horizontal-timeline.js',
'public/metronic/assets/global/plugins/jquery.sparkline.min.js',
'public/metronic/assets/global/scripts/app.min.js',
'public/js/sweetalert.js',
'public/metronic/assets/layouts/layout5/scripts/layout.min.js',
'public/metronic/assets/layouts/global/scripts/quick-sidebar.min.js',
'public/metronic/assets/layouts/global/scripts/quick-nav.min.js',
'public/metronic_custom/highstock/code/js/highstock.js',
'public/metronic/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js',
'public/metronic/assets/pages/scripts/components-bootstrap-select.min.js',
'public/metronic/assets/global/plugins/select2/js/select2.full.min.js',
'public/metronic/assets/global/plugins/moment.min.js',
'public/metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
'public/metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
'public/metronic/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
'public/metronic/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
'public/metronic/assets/global/plugins/clockface/js/clockface.js',
'public/metronic/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js',
'public/metronic/assets/pages/scripts/ui-confirmations.min.js',
'public/metronic/assets/global/plugins/horizontal-timeline/horizontal-timeline.js',
'public/metronic/assets/global/plugins/horizontal-timeline/horizontal-timeline.js',
'public/metronic/assets/global/plugins/bootstrap-toastr/toastr.min.js',
'public/maxazan-jquery-treegrid/js/jquery.treegrid.min.js',
'public/jquery-easy-ticker-master/test/jquery.easing.min.js',
'public/jquery-easy-ticker-master/jquery.easy-ticker.js',
'public/vendor/feedback/feedback.js',
'public/vendor/feedback/html2canvas.min.js',
'public/js/slimscroll.min.js',
'public/vendor/laravel-filemanager/js/lfm.js',
], 'public/metronic_home.js');


mix.js('resources/assets/js/app.js', 'public/js/passport-vue.js');


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