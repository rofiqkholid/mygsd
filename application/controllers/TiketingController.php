<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Session $session
 * @property CI_DB_sqlsrv_driver $db
 * @property TiketingModel $TiketingModel
 * @property CI_Upload $upload
 * @property CI_Form_Validation $form_validation
 * @property Input $input
 */
class TiketingController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->helper(['url', 'form']);
        $this->load->database();
        $this->load->model('TiketingModel');

        if (!$this->session->userdata('role') || $this->session->userdata('role') !== 'user') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai User untuk mengakses halaman ini.');
            redirect('auth');
            exit;
        }
    }

    public function index()
    {
        $data['nama_pelapor'] = $this->session->userdata('nama_lengkap');
        $data['email_pelapor'] = $this->session->userdata('email');
        $data['title'] = 'Form Pengaduan e-Tiketing';
        $this->load->view('tiketing/e-tiketing', $data);
    }

    public function submit_tiketing()
    {
        $this->form_validation->set_rules('nama_pelapor', 'Nama Pelapor', 'trim|required', [
            'required' => '%s harus diisi.'
        ]);
        $this->form_validation->set_rules('email', 'Email Pelapor', 'trim|required|valid_email', [
            'required' => '%s harus diisi.',
            'valid_email' => '%s tidak valid.'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori Layanan', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        $this->form_validation->set_rules('subjek', 'Subjek Tiket', 'trim|required|min_length[5]', [
            'required' => '%s harus diisi.',
            'min_length' => '%s minimal {param} karakter.'
        ]);
        $this->form_validation->set_rules('prioritas', 'Tingkat Prioritas', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[10]', [
            'required' => '%s harus diisi.',
            'min_length' => '%s minimal {param} karakter.'
        ]);
        $this->form_validation->set_rules('lokasi', 'Lokasi Terkait', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        $this->form_validation->set_rules('detail_lokasi', 'Detail Lokasi', 'trim|required', [
            'required' => '%s harus diisi.'
        ]);
        $this->form_validation->set_rules('tanggal_kejadian', 'Tanggal Kejadian', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        if ($this->input->post('jadwal_kunjungan')) {
            $this->form_validation->set_rules('jadwal_kunjungan', 'Jadwal Kunjungan', 'trim');
        }
        if ($this->input->post('catatan_tambahan')) {
            $this->form_validation->set_rules('catatan_tambahan', 'Catatan Tambahan', 'trim');
        }

        $this->form_validation->set_error_delimiters('<div class="validation-message text-red-500 text-xs mt-1" style="display:block;">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Formulir gagal dikirim. Periksa kembali isian Anda.<br>' . validation_errors());
            $this->session->set_flashdata('form_data', $this->input->post());
            $this->index();
        } else {
            $uploaded_file_names = [];
            $upload_error = null;
            $upload_path = './uploads/tiket/';

            if (!is_dir($upload_path)) {
                if (!mkdir($upload_path, 0777, TRUE)) {
                    $this->session->set_flashdata('error', 'Gagal membuat direktori unggahan.');
                    $this->index();
                    return;
                }
            }

            $file_count = isset($_FILES['upload_foto']['name']) ? count($_FILES['upload_foto']['name']) : 0;
            $files_actually_present = $file_count > 0 && !empty($_FILES['upload_foto']['name'][0]);

            if ($files_actually_present) {
                if ($file_count > 3) {
                    $upload_error = 'Anda hanya dapat mengunggah maksimal 3 file foto.';
                } else {
                    $config['upload_path']   = $upload_path;
                    $config['allowed_types'] = 'jpg|jpeg';
                    $config['max_size']      = 2048;
                    $config['encrypt_name']  = TRUE;

                    $this->upload->initialize($config);

                    for ($i = 0; $i < $file_count; $i++) {
                        if (!empty($_FILES['upload_foto']['name'][$i])) {
                            $_FILES['userfile']['name']     = $_FILES['upload_foto']['name'][$i];
                            $_FILES['userfile']['type']     = $_FILES['upload_foto']['type'][$i];
                            $_FILES['userfile']['tmp_name'] = $_FILES['upload_foto']['tmp_name'][$i];
                            $_FILES['userfile']['error']    = $_FILES['upload_foto']['error'][$i];
                            $_FILES['userfile']['size']     = $_FILES['upload_foto']['size'][$i];

                            if ($_FILES['userfile']['size'] > (2048 * 1024)) { // 2MB
                                $upload_error = 'File "' . htmlspecialchars($_FILES['userfile']['name']) . '" melebihi batas ukuran 2MB.';
                                break;
                            }

                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                            $mime = finfo_file($finfo, $_FILES['userfile']['tmp_name']);
                            finfo_close($finfo);
                            if (!in_array($mime, ['image/jpeg'])) {
                                $upload_error = 'File "' . htmlspecialchars($_FILES['userfile']['name']) . '" bukan format JPG/JPEG yang diizinkan (Server Check: ' . $mime . ').';
                                break;
                            }

                            if ($this->upload->do_upload('userfile')) {
                                $upload_data = $this->upload->data();
                                $uploaded_file_names[] = $upload_data['file_name'];
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
            }

            if ($upload_error === null) {
                $id_user = $this->session->userdata('id_user');

                if (!$id_user) {
                    $this->session->set_flashdata('error', 'Sesi User tidak valid. Silakan login kembali.');
                    redirect('auth');
                    exit;
                }

                $data_pengaduan = [
                    'id_user'          => $id_user,
                    'reporter_name'    => $this->input->post('nama_pelapor', TRUE),
                    'reporter_email'   => $this->input->post('email', TRUE),
                    'category'         => $this->input->post('kategori', TRUE),
                    'subject'          => $this->input->post('subjek', TRUE),
                    'priority'         => $this->input->post('prioritas', TRUE),
                    'description'      => $this->input->post('deskripsi', TRUE),
                    'location'         => $this->input->post('lokasi', TRUE),
                    'detail_location'  => $this->input->post('detail_lokasi', TRUE),
                    'incident_date'    => $this->input->post('tanggal_kejadian', TRUE),
                    'visit_schedule'   => !empty($this->input->post('jadwal_kunjungan', TRUE)) ? date('Y-m-d H:i:s', strtotime($this->input->post('jadwal_kunjungan', TRUE))) : NULL,
                    'additional_notes' => !empty($this->input->post('catatan_tambahan', TRUE)) ? $this->input->post('catatan_tambahan', TRUE) : NULL,
                    'status'           => 'Menunggu',
                    'created_date'     => date('Y-m-d H:i:s'),
                    'update_date'      => date('Y-m-d H:i:s'),
                    'attachments'      => !empty($uploaded_file_names) ? implode(',', $uploaded_file_names) : NULL
                ];

                $insert_id = $this->TiketingModel->simpan_tiketing($data_pengaduan);

                if ($insert_id) {
                    $this->session->set_flashdata('success', 'Pengaduan Anda dengan ID #' . $insert_id . ' telah berhasil dikirim.');
                    redirect('tiketingcontroller');
                } else {
                    foreach ($uploaded_file_names as $file_to_delete) {
                        @unlink($upload_path . $file_to_delete);
                    }
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan pengaduan ke database.');
                    $this->session->set_flashdata('form_data', $this->input->post());
                    $this->index();
                }
            } else {
                foreach ($uploaded_file_names as $file_to_delete) {
                    @unlink($upload_path . $file_to_delete);
                }
                $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $upload_error);
                $this->session->set_flashdata('form_data', $this->input->post());
                $this->index();
            }
        }
    }

    public function status_laporan()
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $this->session->set_flashdata('error', 'Sesi User tidak valid. Silakan login kembali.');
            redirect('auth');
            exit;
        }

        $data['laporan'] = $this->TiketingModel->getLaporanByUser($id_user);
        $data['title'] = 'Status Laporan';
        $this->load->view('tiketing/status_laporan', $data);
    }

    public function edit_tiketing($id_tiket)
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $this->session->set_flashdata('error', 'Sesi User tidak valid. Silakan login kembali.');
            redirect('auth');
            exit;
        }

        $ticket = $this->TiketingModel->getTicketById($id_tiket);
        if (!$ticket || $ticket['id_user'] != $id_user) {
            $this->session->set_flashdata('error', 'Tiket tidak ditemukan atau Anda tidak memiliki akses.');
            redirect('tiketingcontroller/status_laporan');
            exit;
        }

        $data['ticket'] = $ticket;
        $data['title'] = 'Edit Tiket';
        $this->load->view('tiketing/edit_tiketing', $data);
    }

    public function update_tiketing($id_tiket)
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $this->session->set_flashdata('error', 'Sesi User tidak valid. Silakan login kembali.');
            redirect('auth');
            exit;
        }

        $ticket = $this->TiketingModel->getTicketById($id_tiket);
        if (!$ticket || $ticket['id_user'] != $id_user) {
            $this->session->set_flashdata('error', 'Tiket tidak ditemukan atau Anda tidak memiliki akses.');
            redirect('tiketingcontroller/status_laporan');
            exit;
        }

        $this->form_validation->set_rules('nama_pelapor', 'Nama Pelapor', 'trim|required', [
            'required' => '%s harus diisi.'
        ]);
        $this->form_validation->set_rules('email', 'Email Pelapor', 'trim|required|valid_email', [
            'required' => '%s harus diisi.',
            'valid_email' => '%s tidak valid.'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori Layanan', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        $this->form_validation->set_rules('subjek', 'Subjek Tiket', 'trim|required|min_length[5]', [
            'required' => '%s harus diisi.',
            'min_length' => '%s minimal {param} karakter.'
        ]);
        $this->form_validation->set_rules('prioritas', 'Tingkat Prioritas', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[10]', [
            'required' => '%s harus diisi.',
            'min_length' => '%s minimal {param} karakter.'
        ]);
        $this->form_validation->set_rules('lokasi', 'Lokasi Terkait', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);
        $this->form_validation->set_rules('detail_lokasi', 'Detail Lokasi', 'trim|required', [
            'required' => '%s harus diisi.'
        ]);
        $this->form_validation->set_rules('tanggal_kejadian', 'Tanggal Kejadian', 'trim|required', [
            'required' => '%s harus dipilih.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Formulir gagal dikirim. Periksa kembali isian Anda.<br>' . validation_errors());
            $this->session->set_flashdata('form_data', $this->input->post());
            $this->edit_tiketing($id_tiket);
        } else {
            $data_pengaduan = [
                'reporter_name'    => $this->input->post('nama_pelapor', TRUE),
                'reporter_email'   => $this->input->post('email', TRUE),
                'category'         => $this->input->post('kategori', TRUE),
                'subject'          => $this->input->post('subjek', TRUE),
                'priority'         => $this->input->post('prioritas', TRUE),
                'description'      => $this->input->post('deskripsi', TRUE),
                'location'         => $this->input->post('lokasi', TRUE),
                'detail_location'  => $this->input->post('detail_lokasi', TRUE),
                'incident_date'    => $this->input->post('tanggal_kejadian', TRUE),
                'visit_schedule'   => !empty($this->input->post('jadwal_kunjungan', TRUE)) ? date('Y-m-d H:i:s', strtotime($this->input->post('jadwal_kunjungan', TRUE))) : NULL,
                'additional_notes' => !empty($this->input->post('catatan_tambahan', TRUE)) ? $this->input->post('catatan_tambahan', TRUE) : NULL,
                'update_date'      => date('Y-m-d H:i:s')
            ];

            $updated = $this->TiketingModel->update_tiketing($id_tiket, $data_pengaduan);

            if ($updated) {
                $this->session->set_flashdata('success', 'Tiket #' . $id_tiket . ' berhasil diperbarui.');
                redirect('tiketingcontroller/status_laporan');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui tiket.');
                $this->edit_tiketing($id_tiket);
            }
        }
    }

    public function detail_tiketing($id_tiket)
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            $this->session->set_flashdata('error', 'Sesi User tidak valid. Silakan login kembali.');
            redirect('auth');
            exit;
        }

        $ticket = $this->TiketingModel->getTicketById($id_tiket);
        if (!$ticket || $ticket['id_user'] != $id_user) {
            $this->session->set_flashdata('error', 'Tiket tidak ditemukan atau Anda tidak memiliki akses.');
            redirect('tiketingcontroller/status_laporan');
            exit;
        }

        $data['ticket'] = $ticket;
        $data['title'] = 'Detail Tiket';
        $this->load->view('tiketing/detail_tiketing', $data);
    }
}
