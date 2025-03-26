<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 */

class TiketingController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'upload']);
        $this->load->model('TiketingModel'); 
    }

    public function index() {
        $this->load->view('tiketing/e-tiketing');
    }

    public function submit_tiketing() {

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
        $files = $_FILES[$field_name];
        $uploaded_files = array();

        for ($i = 0; $i < count($files['name']); $i++) {
            $_FILES['file']['name']     = $files['name'][$i];
            $_FILES['file']['type']     = $files['type'][$i];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['file']['error']    = $files['error'][$i];
            $_FILES['file']['size']     = $files['size'][$i];

            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['file_name']     = time() . '_' . $files['name'][$i];

            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $uploaded_files[] = $this->upload->data('file_name');
            }
        }
        return $uploaded_files;
    }
}
?>
