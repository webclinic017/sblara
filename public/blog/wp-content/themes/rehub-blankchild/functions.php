<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function enable_extended_upload ( $mime_types =array() ) {
    //http://www.sitepoint.com/web-foundations/mime-types-complete-list/
    // The MIME types listed here will be allowed in the media library.
    // You can add as many MIME types as you want.
    $mime_types['gz']  = 'application/x-gzip';
    $mime_types['zip']  = 'application/zip';
    $mime_types['rtf'] = 'application/rtf';
    $mime_types['ppt'] = 'application/mspowerpoint';
    $mime_types['ps'] = 'application/postscript';
    $mime_types['flv'] = 'video/x-flv';
    $mime_types['afl'] = 'text/plain';

    // If you want to forbid specific file types which are otherwise allowed,
    // specify them here.  You can add as many as possible.
    unset( $mime_types['exe'] );
    unset( $mime_types['bin'] );

    return $mime_types;
}

add_filter('upload_mimes', 'enable_extended_upload');
?>