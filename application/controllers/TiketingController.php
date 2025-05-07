<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_sqlsrv_driver $db
 * @property Session $session
 * @property Form $form_validation
 * @property Upload $upload
 * @property Input $input
 * @property URL $url
 * @property Form $form
 * @property TiketingModel $TiketingModel
 */
class TiketingController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->helper(['url', 'form']);
        $this->load->database();
        $this->load->model('TiketingModel');

        if (!$this->session->userdata('role') || $this->session->userdata('role') !== 'user') {
            $this->session->set_flashdata('error', 'Anda harus login seabgai User untuk mengakses halaman ini.');
            redirect('auth');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Form Pengaduan e-Tiketing';
        $this->load->view('tiketing/e-tiketing');
    }

    public function submit_tiketing()
    {
        $this->form_validation->set_rules('kategori', 'Kategori Layanan', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[10]', [
            'required' => '%s harus diisi.',
            'min_length' => '%s minimal harus {param} karakter.'
        ]);
        $this->form_validation->set_rules('lokasi', 'Lokasi Terkait', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);

        $this->form_validation->set_error_delimiters('<div class="validation-message" style="display:block;">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Formulir gagal dikirim. Periksa kembali isian Anda.');
            $this->index();
        } else {
            $uploaded_file_names = [];
            $upload_error = null;
            $upload_path = './uploads/tiket/';

            if (!is_dir($upload_path)) {
                 mkdir($upload_path, 0777, TRUE);
            }

            $file_count = isset($_FILES['upload_foto']['name']) ? count($_FILES['upload_foto']['name']) : 0;
            $actual_files_uploaded = 0;

            if ($file_count > 0 && !empty($_FILES['upload_foto']['name'][0])) {

                if ($file_count > 3) {
                   $upload_error = 'Anda hanya dapat mengunggah maksimal 3 file foto.';
                } else {
                    $config['upload_path']   = $upload_path;
                    $config['allowed_types'] = 'jpg|jpeg';
                    $config['max_size']      = 2048;
                    $config['encrypt_name']  = TRUE;

                    $this->upload->initialize($config);

                    for ($i = 0; $i < $file_count; $i++) {
                        $_FILES['userfile']['name']     = $_FILES['upload_foto']['name'][$i];
                        $_FILES['userfile']['type']     = $_FILES['upload_foto']['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $_FILES['upload_foto']['tmp_name'][$i];
                        $_FILES['userfile']['error']    = $_FILES['upload_foto']['error'][$i];
                        $_FILES['userfile']['size']     = $_FILES['upload_foto']['size'][$i];

                         if ($_FILES['upload_foto']['size'][$i] > (2048 * 1024)) {
                            $upload_error = 'File "' . htmlspecialchars($_FILES['upload_foto']['name'][$i]) . '" melebihi batas ukuran 2MB.';
                            break;
                         }

                         $finfo = finfo_open(FILEINFO_MIME_TYPE);
                         $mime = finfo_file($finfo, $_FILES['upload_foto']['tmp_name'][$i]);
                         finfo_close($finfo);
                         if (!in_array($mime, ['image/jpeg', 'image/jpg'])) {
                             $upload_error = 'File "' . htmlspecialchars($_FILES['upload_foto']['name'][$i]) . '" bukan format JPG/JPEG yang diizinkan.';
                             break;
                         }


                        if ($this->upload->do_upload('userfile')) {
                            $upload_data = $this->upload->data();
                            $uploaded_file_names[] = $upload_data['file_name'];
                            $actual_files_uploaded++;
                        } else {
                            $upload_error = $this->upload->display_errors('', '');
                            foreach ($uploaded_file_names as $file_to_delete) {
                                @unlink($upload_path . $file_to_delete);
                            }
                            $uploaded_file_names = [];
                            break;
                        }
                    }
                }
            }


            if ($upload_error === null) {
                $user_id = $this->session->userdata('UserID');

                if (!$user_id) {
                     $this->session->set_flashdata('error', 'Sesi User tidak valid. Silakan login kembali.');
                     redirect('auth');
                     exit;
                }

                $data_pengaduan = [
                    'UserID'        => $user_id,
                    'Category'      => $this->input->post('kategori', TRUE),
                    'Description'   => $this->input->post('deskripsi', TRUE),
                    'Location'      => $this->input->post('lokasi', TRUE),
                    'Status'        => 'Baru',
                    'CreatedDate'   => date('Y-m-d H:i:s'),
                    'UpdateDate'    => date('Y-m-d H:i:s')
                ];

                $insert_id = $this->TiketingModel->simpan_tiketing($data_pengaduan);

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Pengaduan Anda dengan ID #' . $insert_id . ' telah berhasil dikirim.');
                    redirect('tiketing');
                } else {
                    foreach ($uploaded_file_names as $file_to_delete) {
                         @unlink($upload_path . $file_to_delete);
                    }
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan pengaduan ke database.');
                    $this->index();
                }

            } else {
                $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $upload_error);
                $this->index();
            }
        }
    }
}