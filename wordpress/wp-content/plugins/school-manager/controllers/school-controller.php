<?php
// controllers/school-controller.php

class SchoolController {

  public static function save($request) {
    global $wpdb;
    $table = $wpdb->prefix . 'schools';

    $name = sanitize_text_field($request->get_param('name'));
    $address = sanitize_text_field($request->get_param('address'));

    $wpdb->insert($table, compact('name', 'address'));

    return rest_ensure_response([
      'success' => (bool) $wpdb->insert_id,
      'id' => $wpdb->insert_id,
    ]);
  }

  public static function list() {
    global $wpdb;
    $table = $wpdb->prefix . 'schools';
    $results = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC");
    return rest_ensure_response($results);
  }
}
