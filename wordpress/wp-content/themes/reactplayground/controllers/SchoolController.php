<?php

class SchoolController {
  public static function index() {
      $schoolModel = new School();
      $schools = $schoolModel->all();
      status_header(200);
      wp_send_json([
        'data'=> $schools
      ]);
  }

  public static function show() {
    try {
        $id = $request->get_param('id');
        $schoolModel = new School();
        $school = $schoolModel->find($id);
  
        if (!$school) {
            throw new \Exception('School not found', 404);
        }
        
        status_header(200);
        wp_send_json([
            'data'=> $school
        ]);
    } catch (\Exception $e) {
        
        status_header($e->getCode());
        wp_send_json_error([
            'success' => false,
            'message' => $e->getMessage(),
        ]);
    }
  }

  public static function store() {
    try {
        // 1. AUTHENTICATION CHECK
        if (!is_user_logged_in()) {
            throw new \Exception("You must be logged in to perform this action", 401);
        }
        $data = [
            'name'    => sanitize_text_field($_POST['email']),
            'address' => sanitize_text_field($_POST['address']),
        ];
  
        $schoolModel = new School();
        $id = $schoolModel->create($data);
  
  
        status_header(200);
        wp_send_json(
          [
              'id' => $id, 
              'test'=> is_user_logged_in(),
              'message' => 'School created'
          ]
        );
    } catch (\Throwable $th) {
        
        error_log($th->getMessage());
        status_header($th->getCode());
        wp_send_json_error([
            'success' => false,
            'message' => $th->getMessage(),
        ]);
    }
  }

}
