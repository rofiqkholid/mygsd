<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Model extends CI_Model {

    public function find_all()
    {
        $query = $this->db->get('account');
        return $query->result();
    }

    public function find_by_id($id)
    {
        $query = $this->db->get_where('account', ['id' => $id]);
        return $query->row();
    }

}
