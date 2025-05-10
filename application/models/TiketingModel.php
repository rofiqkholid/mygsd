<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TiketingModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function simpan_tiketing($data)
    {
        $this->db->insert('tiketing', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    public function getLaporanByUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tiketing');
        $this->db->where('id_user', $id_user);
        $this->db->order_by('created_date', 'DESC');
        return $this->db->get()->result_array();
    }
}
