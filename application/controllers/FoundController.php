<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Session $session
 * @property CI_DB_sqlsrv_driver $db
 * @property FoundModel $FoundModel
 * @property CI_Upload $upload
 * @property CI_Form_Validation $form_validation
 * @property Input $input
 */
class FoundController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('FoundModel');
    $this->load->library('session');
    $this->load->helper('form', 'url');
  }

  public function index()
  {
    $data['title'] = 'Lapor Barang Ditemukan';
    $this->load->view('layout/header', $data);
    $this->load->view('lostfound/found');
    $this->load->view('layout/footer');
  }

  public function submit_found()
  {
    $this->form_validation->set_rules('reporter_name', 'Nama Pelapor', 'required|trim|max_length[50]');
    $this->form_validation->set_rules('item_name', 'Nama Barang', 'required|trim');
    $this->form_validation->set_rules('found_date', 'Tanggal Ditemukan', 'required|trim');
    $this->form_validation->set_rules('found_time', 'Waktu Ditemukan', 'required|trim');
    $this->form_validation->set_rules('location_found', 'Lokasi Ditemukan', 'required|trim');
    $this->form_validation->set_rules('info', 'Informasi Tambahan', 'trim');
    $this->form_validation->set_rules('status', 'Status', 'required|trim|in_list[Belum diklaim,Diklaim,Karantina]');
    $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim|min_length[10]');
    $this->form_validation->set_rules('attachments[]', 'Lampiran', 'trim');

    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('form_data', $this->input->post());
      $this->session->set_flashdata('error', validation_errors());
      redirect('found');
    } else {
      $data = [
        'id_user' => $this->session->userdata('id_user') ?? $this->session->userdata('user_id'),
        'reporter_name' => $this->input->post('reporter_name'),
        'item_name' => $this->input->post('item_name'),
        'found_date' => $this->input->post('found_date'),
        'found_time' => $this->input->post('found_time'),
        'location_found' => $this->input->post('location_found'),
        'info' => $this->input->post('info'),
        'status' => $this->input->post('status'),
        'description' => $this->input->post('description'),
        'created_at' => date('Y-m-d H:i:s'),
        'attachments'      => !empty($uploaded_file_names) ? implode(',', $uploaded_file_names) : NULL
      ];

      $attachments = [];
      if (!empty($_FILES['attachments']['name'][0])) {
        $config['upload_path'] = './uploads/found/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['max_filename'] = 200;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        foreach ($_FILES['attachments']['name'] as $key => $value) {
          $_FILES['temp']['name'] = $_FILES['attachments']['name'][$key];
          $_FILES['temp']['type'] = $_FILES['attachments']['type'][$key];
          $_FILES['temp']['tmp_name'] = $_FILES['attachments']['tmp_name'][$key];
          $_FILES['temp']['error'] = $_FILES['attachments']['error'][$key];
          $_FILES['temp']['size'] = $_FILES['attachments']['size'][$key];

          if ($this->upload->do_upload('temp')) {
            $upload_data = $this->upload->data();
            $attachments[] = $upload_data['file_name'];
          } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('found');
          }
        }
        $data['attachments'] = implode(',', $attachments);
      }

      if ($this->FoundModel->submit_found($data)) {
        $this->session->set_flashdata('success', 'Laporan barang ditemukan berhasil dikirim.');
      } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan laporan. Coba lagi.');
      }
      redirect('found');
    }
  }
  public function detail_penemuan() {
        $this->load->view('lostfound/detail_penemuan');

  }
}
