<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_Model $TiketingModel
 */

class TiketingController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'upload']);
        $this->load->model('TiketingModel');
    }

    public function index()
    {
        $this->load->view('tiketing/e-tiketing');
    }

    public function submit_tiketing()
    {

        $data = array(
            'UserID'         => $this->session->userdata('user_id'),
            'SubjectService' => $this->input->post('kategori'),
            'Desc'           => $this->input->post('deskripsi'),
            'Location'       => $this->input->post('lokasi'),
            'StatusTiketing' => 'Pending',
            'Years'          => date('Y'),
            'Months'         => date('m'),
            'Days'           => date('d')
        );

        if (!empty($_FILES['upload_foto']['name'][0])) {
            $upload_images = $this->upload_images('upload_foto');
            $data['Image'] = json_encode($upload_images);
        }

        if ($this->TiketingModel->insert_tiketing($data)) {
            $this->session->set_flashdata('success', 'Pengaduan berhasil dikirim!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan, coba lagi.');
        }

        redirect('tiketing');
    }

    private function upload_images($field_name)
    {
        $this->load->library('upload'); 

        $files = $_FILES[$field_name];
        $uploaded_files = array();

        for ($i = 0; $i < count($files['name']); $i++) {
            $_FILES['file']['name']     = $files['name'][$i];
            $_FILES['file']['type']     = $files['type'][$i];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['file']['error']    = $files['error'][$i];
            $_FILES['file']['size']     = $files['size'][$i];

            $config['upload_path']   = './assets/uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png'; 
            $config['max_size']      = 2048;
            $config['file_name']     = time() . '_' . str_replace(' ', '_', $files['name'][$i]); // Hindari spasi di nama file

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $data = $this->upload->data();
                $uploaded_files[] = $data['file_name'];

                $this->db->insert('nama_tabel', ['image_name' => $data['file_name'], 'created_at' => date('Y-m-d H:i:s')]);
            } else {
                echo "Upload gagal: " . $this->upload->display_errors(); // Debugging error upload
            }
        }
        return $uploaded_files;
    }
}
