<?php

/**
 * Plugin Name: School Manager
 * Plugin URI: https://example.com/school-manager
 * Description: A plugin to manage school data (students, teachers, classes) directly from the WordPress admin panel.
 * Version: 1.0.0
 * Author: Yunan Fatah
 * Author URI: https://example.com
 * License: GPL2
 * Text Domain: school-manager
 * Domain Path: /languages
 */

register_activation_hook(__FILE__, 'school_manager_install');

function school_manager_install() {
  global $wpdb;
  $table = $wpdb->prefix . 'schools';
  $charset = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    address varchar(255) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
  ) $charset;";

  require_once ABSPATH . 'wp-admin/includes/upgrade.php';
  dbDelta($sql);
}
