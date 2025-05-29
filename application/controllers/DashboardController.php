<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_sqlsrv_driver $db
 */
class DashboardController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load database library
        $this->load->database();
        // Check database connection
        if (!$this->db->conn_id) {
            log_message('error', 'Database connection failed: ' . $this->db->error()['message']);
            show_error('Database connection failed. Please check the configuration.');
        }
    }

    public function index() {
        // Koneksi ke database
        $conn = $this->db->conn_id;

        // Query untuk top cards
        $topCards = [];
        $topCardQueries = [
            "SELECT COUNT(*) as total FROM tiketing WHERE status IN ('Menunggu', 'Sedang Proses', 'Selesai', 'Dibatalkan')" => ["Tiket Masuk", "bg-blue-800", "bi-ticket-fill"],
            "SELECT COUNT(*) as total FROM found WHERE status IN ('Karantina', 'Belum diklaim', 'Diklaim')"=> ["Total Penemuan", "bg-green-600", "bi-search"],
        ];

        foreach ($topCardQueries as $query => $details) {
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                log_message('error', 'Prepare failed: ' . $conn->error);
                continue;
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $topCards[] = [$details[0], $row['total'], $details[1], $details[2]];
            $stmt->close();
        }

        // Query untuk tiket data berdasarkan status
        $statuses = ["Menunggu", "Sedang Proses", "Selesai", "Dibatalkan"];
        $tiketData = [];

        foreach ($statuses as $status) {
            $query = "SELECT COUNT(*) as total FROM tiketing WHERE status = ?";
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                log_message('error', 'Prepare failed: ' . $conn->error);
                $tiketData[] = ["status" => $status, "total" => 0, "color" => "bg-blue-800", "icon" => $this->getIcon($status)];
                continue;
            }
            $stmt->bind_param("s", $status);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $tiketData[] = [
                "status" => $status,
                "total" => $row['total'],
                "color" => "bg-blue-800",
                "icon" => $this->getIcon($status)
            ];
            $stmt->close();
        }

        // Query untuk kehilangan dan penemuan dari tabel found
        $penemuanData = [];
        $penemuanStatuses = ["Karantina", "Belum diklaim", "Diklaim"];
        foreach ($penemuanStatuses as $status) {
            $query = "SELECT COUNT(*) as total FROM found WHERE status = ?";
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                log_message('error', 'Prepare failed: ' . $conn->error);
                $penemuanData[] = [$status, 0, "bg-green-600", $this->getPenemuanIcon($status)];
                continue;
            }
            $stmt->bind_param("s", $status);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $penemuanData[] = [$status, $row['total'], "bg-green-600", $this->getPenemuanIcon($status)];
            $stmt->close();
        }

        // Kirim data ke view
        $data = [
            'topCards' => $topCards,
            'tiketData' => $tiketData,
            'penemuanData' => $penemuanData
        ];

        $this->load->view('dashboard/dashboard', $data);
    }

    private function getIcon($status) {
        $icons = [
            "Menunggu" => "bi-hourglass-split",
            "Sedang Proses" => "bi-hourglass-split",
            "Selesai" => "bi-clipboard-check",
            "Dibatalkan" => "bi-x-circle"
        ];
        return $icons[$status] ?? "bi-question-circle";
    }

    private function getPenemuanIcon($status) {
        $icons = [
            "Karantina" => "bi-lock",
            "Belum diklaim" => "bi-box",
            "Diklaim" => "bi-check-square",
        ];
        return $icons[$status] ?? "bi-question-circle";
    }
}