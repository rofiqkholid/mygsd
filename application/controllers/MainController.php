<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Session $session
 */
class MainController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('role') || !in_array($this->session->userdata('role'), ['user'])) {
            redirect('auth');
            exit;
        }
    }
    public function index()
    {
        $this->load->view('main/main_page');
    }
    
}
