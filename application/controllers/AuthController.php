<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function index()
    {
        $this->load->view('auth/login/page_login');
    }
}
