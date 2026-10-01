<?php

namespace App\Controllers;

use App\Config\Database;
use PDO;

class ProductController
{
    public function index()
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->query("SELECT * FROM productos");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $products = [];
        }

        $title = "DASSHOP | Colección Boutique";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/products/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function customize()
    {
        $id = $_GET['id'] ?? null;
        $product = null;

        if ($id) {
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("SELECT * FROM productos WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (\Exception $e) {
                $product = null;
            }
        }

        $title = "DASSHOP | Personalizador Interactivo";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/products/customize.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}