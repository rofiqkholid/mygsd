<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermitController extends CI_Controller
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
