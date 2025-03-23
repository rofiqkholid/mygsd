<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 */
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

        $hashed_password = hash('sha256', $password);

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
    public function logout()
    {
        $this->session->sess_destroy();

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        redirect('auth');
        exit;
    }
}
