<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property NewsModel $NewsModel
 */
class NewsController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('NewsModel');
    }

    public function index() {
        $data['news'] = $this->NewsModel->get_found_items();
        $this->load->view('news_view', $data);
    }
}