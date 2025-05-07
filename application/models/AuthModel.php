<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    public function check_login($identity) {
        return $this->db->get_where('users', ['identity' => $identity])->row_array();
    }
}

?>