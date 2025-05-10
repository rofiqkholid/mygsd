<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cors {
    public function handleCors() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        // Untuk menangani preflight request (OPTIONS request)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
}
