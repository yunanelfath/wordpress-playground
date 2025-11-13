<?php
// routes/school-route.php

use SchoolManager\Controllers\SchoolController;

add_action('rest_api_init', function() {
  $controller = new SchoolController();

  register_rest_route('school-manager/v1', '/schools', [
      'methods'  => 'GET',
      'callback' => [$controller, 'index'],
      'permission_callback' => '__return_true', // change later if you need auth
  ]);

  register_rest_route('school-manager/v1', '/schools/(?P<id>\d+)', [
      'methods'  => 'GET',
      'callback' => [$controller, 'show'],
      'permission_callback' => '__return_true',
  ]);

  register_rest_route('school-manager/v1', '/schools', [
      'methods'  => 'POST',
      'callback' => [$controller, 'store'],
      'permission_callback' => '__return_true',
  ]);

  register_rest_route('school-manager/v1', '/schools/(?P<id>\d+)', [
      'methods'  => 'DELETE',
      'callback' => [$controller, 'destroy'],
      'permission_callback' => '__return_true',
  ]);
});