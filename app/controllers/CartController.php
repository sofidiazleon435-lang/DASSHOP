<?php

namespace App\Controllers;

class CartController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $cart = $_SESSION['cart'] ?? [];

        $title = "DASSHOP | Tu Carrito";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cart/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newItem = [
                'id' => uniqid(),
                'nombre' => $_POST['nombre'] ?? 'Producto Personalizado',
                'precio' => (float)($_POST['precio'] ?? 65000),
                'color' => $_POST['color'] ?? 'Rosa Cuarzo',
                'talla' => $_POST['talla'] ?? 'M',
                'texto' => $_POST['texto_custom'] ?? '',
                'cantidad' => 1
            ];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $_SESSION['cart'][] = $newItem;
        }

        header("Location: /dasshop/carrito");
        exit;
    }

    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $cart = $_SESSION['cart'] ?? [];

        $title = "DASSHOP | Finalizar Compra";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cart/checkout.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}