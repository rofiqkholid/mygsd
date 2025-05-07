<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property input $input
 * @property Session $session
 * @property AuthModel $AuthModel
 */
class AuthController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function index() {
        $this->load->view('auth/login/page_login');
    }

    public function proses_login() {
        $identity = $this->input->post('identity', TRUE);
        $password = $this->input->post('password', TRUE);
    
        $user = $this->AuthModel->check_login($identity);
    
        if ($user) {
            $salt = $user['salt'];
            $hashed_password = hash('sha256', $password . $salt);
            
            if ($hashed_password === $user['password']) {
                $this->session->set_userdata([
                    'id_user' => $user['id_user'],
                    'identity' => $user['identity'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'logged_in' => true
                ]);
                redirect('main'); 
            } else {
                $this->session->set_flashdata('error', 'Identity atau Password salah!');
                redirect('AuthController');
            }
        } else {
            $this->session->set_flashdata('error', 'Identity atau Password salah!');
            redirect('AuthController');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('AuthController');
    }
}
