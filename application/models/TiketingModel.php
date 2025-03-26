<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TiketingModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_tiketing($data)
    {
        $this->db->insert('TiketingByDate', $data);
        log_message('debug', 'Insert Tiketing Query: ' . $this->db->last_query());

        return $this->db->affected_rows() > 0;
    }

    public function get_tiketing_data()
    {
        $query = $this->db->select('Years, Months, Days, IDTiketing, SubjectService, Desc, Location, StatusTiketing')
            ->from('TiketingByDate')
            ->get();
        return $query->result();
    }
}
