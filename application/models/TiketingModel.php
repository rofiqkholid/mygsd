<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TiketingModel extends CI_Model
{
    public function insert_tiketing($data)
    {
        return $this->db->insert('TiketingByDate', $data);
    }
}
?>
