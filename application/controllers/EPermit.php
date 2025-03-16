<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EPermit extends CI_Controller
{
    public function monitoring_permit()
    {
        $this->load->view('dashboard/permit/monitoring_permit');
    }

    public function permit_grafik()
    {
        $this->load->view('dashboard/permit/permit_grafik');
    }
}
