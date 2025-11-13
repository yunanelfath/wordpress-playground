<?php
// controllers/school-controller.php

namespace SchoolManager\Controllers;

use SchoolManager\Models\School;
use WP_REST_Request;
use WP_REST_Response;

class SchoolController {
  public function index(WP_REST_Request $request) {
      $schoolModel = new School();
      $schools = $schoolModel->all();
      return new WP_REST_Response($schools, 200);
  }

  public function show(WP_REST_Request $request) {
      $id = $request->get_param('id');
      $schoolModel = new School();
      $school = $schoolModel->find($id);

      if (!$school) {
          return new WP_REST_Response(['message' => 'School not found'], 404);
      }

      return new WP_REST_Response($school, 200);
  }

  public function store(WP_REST_Request $request) {
      $data = [
          'name'    => sanitize_text_field($request->get_param('name')),
          'address' => sanitize_text_field($request->get_param('address')),
      ];

      $schoolModel = new School();
      $id = $schoolModel->create($data);

      return new WP_REST_Response(['id' => $id, 'message' => 'School created'], 201);
  }

  public function destroy(WP_REST_Request $request) {
      $id = $request->get_param('id');
      $schoolModel = new School();
      $deleted = $schoolModel->delete($id);

      if ($deleted) {
          return new WP_REST_Response(['message' => 'Deleted successfully'], 200);
      } else {
          return new WP_REST_Response(['message' => 'Failed to delete or not found'], 400);
      }
  }
}
