<?php

class School extends BaseModel {
    protected $table;

    public function __construct() {
        parent::__construct();
        $this->table = $this->wpdb->prefix . 'schools';
    }

    // You can add School-specific logic here if needed
}
