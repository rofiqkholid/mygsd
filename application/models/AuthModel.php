<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function check_user($no_identity)
    {
        $sql = "SELECT id_user, long_name, role, password FROM Users WHERE no_identity = ?";
        $query = $this->db->query($sql, array($no_identity));

        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }
}
