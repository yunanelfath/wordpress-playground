<?php
// routes/school-route.php

add_action('rest_api_init', function() {
  register_rest_route('school/v1', '/save', [
    'methods' => 'POST',
    'callback' => 'SchoolController::save',
    'permission_callback' => function() {
      return current_user_can('edit_posts');
    },
  ]);

  register_rest_route('school/v1', '/list', [
    'methods' => 'GET',
    'callback' => 'SchoolController::list',
    'permission_callback' => function() {
      return current_user_can('read');
    },
  ]);
});