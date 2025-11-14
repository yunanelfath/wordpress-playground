<?php

require_once get_template_directory() . '/models/BaseModel.php';
require_once get_template_directory() . '/models/School.php';
require_once get_template_directory() . '/controllers/SchoolController.php';
require_once get_template_directory() . '/routes/api.php';

function reactplayground_enqueue_scripts() {
    $dist_path = get_template_directory() . '/contents/dist/';
    $dist_uri  = get_template_directory_uri() . '/contents/dist/';

    // Find app.*.js file
    $files = glob($dist_path . 'app.*.js');
    if (!empty($files)) {
        $file = basename($files[0]);
        wp_enqueue_script(
            'react-app',
            $dist_uri . $file,
            [],
            null,
            true
        );
    }

    // Enqueue extracted CSS (optional)
    wp_enqueue_style(
        'my-react-style',
        get_template_directory_uri() . '/contents/dist/app.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'reactplayground_enqueue_scripts');
