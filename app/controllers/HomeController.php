<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        $title = "DASSHOP | Inicio";

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}