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
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getLaporanByUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tiketing');
        $this->db->where('id_user', $id_user);
        $this->db->order_by('created_date', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getTicketById($id_tiket)
    {
        $this->db->select('*');
        $this->db->from('tiketing');
        $this->db->where('id_tiket', $id_tiket);
        return $this->db->get()->row_array();
    }

    public function update_tiketing($id_tiket, $data)
    {
        $this->db->where('id_tiket', $id_tiket);
        $this->db->update('tiketing', $data);
        return $this->db->affected_rows() > 0;
    }
}