<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FoundModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function submit_found($data)
    {
        return $this->db->insert('found', $data);
    }


    public function get_all_found_items()
    {
        $query = $this->db->get('found');
        return $query->result_array();
    }

    public function get_found_items_by_user($user_id)
    {
        $this->db->where('id_user', $user_id);
        $query = $this->db->get('found');
        return $query->result_array();
    }

    public function get_found_item_by_id($id_found)
    {
        $query = $this->db->get_where('found', array('id_found' => $id_found));
        return $query->row_array();
    }

    public function update_status($id_found, $status)
    {
        $this->db->where('id_found', $id_found);
        $this->db->update('found', array('status' => $status));
        return $this->db->affected_rows();
    }
}
