<?php

abstract class BaseModel {
    protected $table;
    protected $wpdb; // <-- declare it here

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function all() {
        return $this->wpdb->get_results("SELECT * FROM {$this->table}");
    }

    public function find($id) {
        return $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM {$this->table} WHERE id = %d", $id));
    }

    public function create($data) {
        $this->wpdb->insert($this->table, $data);
        return $this->wpdb->insert_id;
    }

    public function update($id, $data) {
        return $this->wpdb->update($this->table, $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->wpdb->delete($this->table, ['id' => $id]);
    }
}
