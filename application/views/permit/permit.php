<?php

if (!$this->session->userdata('role') || !in_array($this->session->userdata('role'), ['mahasiswa', 'dosen'])) {
    redirect('auth');
    exit;
}
?>