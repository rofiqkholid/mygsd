<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('auth/login/page_login');
    }

    public function proses_login()
    {
        $no_identity = $this->input->post('no_identity');
        $password = $this->input->post('password');

        // Hash password dengan SHA-256 dalam bentuk string
        $hashed_password = hash('sha256', $password);

        // Query untuk mencocokkan IdentityNum dan Password
        $query = $this->db->query(
            "SELECT * FROM users WHERE IdentityNum = ? AND Password = ?",
            array($no_identity, $hashed_password)
        );

        $user = $query->row();

        if ($user) {
            $session_data = [
                'user_id' => $user->UserID,
                'role' => $user->Role,
                'logged_in' => true
            ];
            $this->session->set_userdata($session_data);

            if ($user->Role == 'mahasiswa') {
                redirect('main');
            } elseif ($user->Role == 'staff') {
                redirect('dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Identity Number or Password');
            redirect('auth');
        }
    }
}
