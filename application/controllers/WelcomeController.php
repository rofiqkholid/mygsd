<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WelcomeController extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome');
    }
}
