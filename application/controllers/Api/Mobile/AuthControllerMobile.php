<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property db $db
 * @property Session $session
 * @property output $output
 */
class AuthControllerMobile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(200);
      exit();
    }
  }
  public function proses_login_mobile()
  {
    header('Content-Type: application/json');

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
      header("Access-Control-Allow-Headers: Content-Type");
      http_response_code(200);
      exit();
    }

    $identity = $data['identity'] ?? '';
    $password = $data['password'] ?? '';

    $query = $this->db->get_where('users', ['identity' => $identity]);

    if ($query->num_rows() > 0) {
      $user = $query->row_array();
      $hashed_password = hash('sha256', $password);

      if ($hashed_password === $user['password']) {
        $response = [
          'status' => true,
          'message' => 'Login berhasil',
          'data' => [
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'email' => $user['email'],
            'identity' => $user['identity'],
            'name' => $user['name'],
            'role' => $user['role'],
          ]
        ];
        echo json_encode($response);
        return;
      }
    }

    $this->output->set_status_header(401);
    echo json_encode([
      'status' => false,
      'message' => 'Identity atau Password salah!'
    ]);
  }
}
