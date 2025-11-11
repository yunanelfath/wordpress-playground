<?php
function reactplayground_enqueue_scripts() {
    // Enqueue React bundle
    wp_enqueue_script(
        'my-react-app',
        get_template_directory_uri() . '/contents/dist/app.js',
        array(), // dependencies (none for now)
        '1.0',
        true // load in footer
    );

    // Enqueue extracted CSS (optional)
    wp_enqueue_style(
        'my-react-style',
        get_template_directory_uri() . '/contents/dist/app.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'reactplayground_enqueue_scripts');
