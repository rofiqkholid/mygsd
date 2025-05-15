<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FoundModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function submit_found($data) {
        return $this->db->insert('found', $data);
    }
}