const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .css(
        "node_modules/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
        "public/css"
    );

//datatable
mix.copy(
        "node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
        "public/js/datatables"
    )
    .copy(
        "node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js",
        "public/js/datatables"
    )
    .copy(
        "node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
        "public/css/datatables"
    )
    .copy(
        "node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
        "public/css/datatables"
    )
    //fixer column
    .copy(
        "node_modules/admin-lte/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css",
        "public/css/datatables"
    )
    .copy(
        "node_modules/admin-lte/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js",
        "public/js/datatables"
    )
    .copy(
        "node_modules/admin-lte/plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js",
        "public/js/datatables"
    );

//admin
mix.sass("resources/sass/admin/timekeeping.scss", "public/css/admin");