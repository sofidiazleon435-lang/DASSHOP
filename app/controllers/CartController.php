<?php
namespace App\Controllers;

class CartController {

    public function index() {
        $title = "DASSHOP | Carrito de Compras";
        $cart = $_SESSION['cart'] ?? [];
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += floatval($item['precio']) * intval($item['cantidad']);
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cart/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 1;
            $nombre = $_POST['nombre'] ?? 'Camiseta Personalizada';
            $precio = floatval($_POST['precio'] ?? 45000);
            $color = $_POST['color'] ?? '#4A1525';
            $corte = $_POST['corte'] ?? 'Cuello Redondo';
            $imagen = $_POST['imagen'] ?? '';

            $itemKey = $id . '_' . str_replace('#', '', $color) . '_' . md5($corte);

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$itemKey])) {
                $_SESSION['cart'][$itemKey]['cantidad'] += 1;
            } else {
                $_SESSION['cart'][$itemKey] = [
                    'id' => $id,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'color' => $color,
                    'corte' => $corte,
                    'imagen' => $imagen,
                    'cantidad' => 1
                ];
            }
        }
        header("Location: /dasshop/carrito");
        exit;
    }

    public function remove() {
        $key = $_GET['key'] ?? null;
        if ($key && isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
        header("Location: /dasshop/carrito");
        exit;
    }

    // Vista de Checkout / Proceso de Pago
    public function checkout() {
        if (empty($_SESSION['cart'])) {
            header("Location: /dasshop/productos");
            exit;
        }

        $title = "DASSHOP | Finalizar Compra";
        $cart = $_SESSION['cart'];
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += floatval($item['precio']) * intval($item['cantidad']);
        }
        $envio = 10000;
        $total = $subtotal + $envio;

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cart/checkout.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Procesar Pedido y Confirmar
    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedido = [
                'id_pedido' => 'DASS-' . strtoupper(substr(md5(uniqid()), 0, 6)),
                'cliente' => $_POST['nombre_completo'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'ciudad' => $_POST['ciudad'] ?? '',
                'metodo_pago' => $_POST['metodo_pago'] ?? 'transferencia',
                'items' => $_SESSION['cart'] ?? [],
                'subtotal' => $_POST['subtotal'] ?? 0,
                'envio' => $_POST['envio'] ?? 0,
                'total' => $_POST['total'] ?? 0,
                'fecha' => date('Y-m-d H:i:s')
            ];

            // Vaciar carrito tras la compra exitosa
            unset($_SESSION['cart']);

            $title = "DASSHOP | Pedido Confirmado";
            require_once __DIR__ . '/../views/layouts/header.php';
            ?>
            <main class="max-w-2xl mx-auto py-16 px-4 text-center space-y-6">
                <div class="w-20 h-20 bg-pink-100 text-dass-burgundy rounded-full flex items-center justify-center mx-auto text-4xl shadow-inner">
                    ✨
                </div>
                <div class="space-y-2">
                    <h1 class="font-serif text-3xl font-bold text-dass-burgundy">¡Pedido Confirmado!</h1>
                    <p class="text-sm font-semibold text-gray-700">Código de Orden: <span class="text-dass-burgundy"><?= htmlspecialchars($pedido['id_pedido']) ?></span></p>
                    <p class="text-xs text-gray-500 max-w-md mx-auto leading-relaxed">
                        Gracias, <strong><?= htmlspecialchars($pedido['cliente']) ?></strong>. Hemos recibido tu pedido con todas las especificaciones de diseño y personalización.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-dass-rose/60 text-left space-y-3 text-xs shadow-sm">
                    <h3 class="font-bold text-dass-burgundy border-b border-gray-100 pb-2">Resumen de Entrega</h3>
                    <p><strong>Dirección:</strong> <?= htmlspecialchars($pedido['direccion']) ?>, <?= htmlspecialchars($pedido['ciudad']) ?></p>
                    <p><strong>Teléfono:</strong> <?= htmlspecialchars($pedido['telefono']) ?></p>
                    <p><strong>Método de Pago:</strong> <?= strtoupper(htmlspecialchars($pedido['metodo_pago'])) ?></p>
                    <p><strong>Total Pagado:</strong> <span class="font-bold text-dass-burgundy">$<?= number_format($pedido['total'], 0, ',', '.') ?> COP</span></p>
                </div>

                <div class="pt-4">
                    <a href="/dasshop/home" class="inline-block bg-dass-burgundy text-white text-xs px-8 py-3.5 rounded-full shadow-lg hover:bg-opacity-95 transition">
                        Volver a la Tienda
                    </a>
                </div>
            </main>
            <?php
            require_once __DIR__ . '/../views/layouts/footer.php';
            exit;
        }
    }
}