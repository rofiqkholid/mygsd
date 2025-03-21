<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_sqlsrv_driver $db
 */
class DatabaseController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
        if ($this->db->conn_id) {
            echo "<b> [YUHU] : Koneksi ke SQL Server berhasil!";
        } else {
            echo "[GAGAL] : Koneksi gagal: " . print_r($this->db->error(), true);
        }
    }
}
