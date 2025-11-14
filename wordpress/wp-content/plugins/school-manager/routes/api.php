<?php
// For not logged-in users
add_action('admin_post_nopriv_index_school', ['SchoolController', 'index']);

// For logged-in users
add_action('wp_ajax_store_school', ['SchoolController', 'store']);
// need to nopriv for same endpoint so it can trigger must authentication error message
add_action('wp_ajax_nopriv_store_school', ['SchoolController', 'store']);