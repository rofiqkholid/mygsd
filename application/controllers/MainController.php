<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property NewsModel $NewsModel
 */
class MainController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('NewsModel');

        if (!$this->session->userdata('role') || !in_array($this->session->userdata('role'), ['user'])) {
            $this->session->set_flashdata('error', 'Please log in to access this page.');
            redirect('auth');
            exit;
        }
    }

    public function index()
    {
        $news = $this->NewsModel->get_found_items();

        $this->load->view('main/main_page', ['news' => $news]);
    }
}
