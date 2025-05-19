<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_found_items($limit = 3) {
        $this->db->select('id_found, reporter_name, item_name, found_date, found_time, location_found, info, status, description, attachments, created_at');
        $this->db->from('found');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}