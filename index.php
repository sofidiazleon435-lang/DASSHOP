<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoload automático
spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class);
    if (strpos($classPath, 'App/') === 0) {
        $classPath = 'app/' . substr($classPath, 4);
    }
    $file = __DIR__ . '/' . $classPath . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\UserController;

$request = $_SERVER['REQUEST_URI'];
$basePath = '/dasshop';
$route = str_replace($basePath, '', strtok($request, '?'));
$route = rtrim($route, '/');

switch ($route) {
    case '':
    case '/home':
    case '/inicio':
        if (class_exists('App\Controllers\HomeController')) {
            (new HomeController())->index();
        } else {
            $title = "DASSHOP | Inicio Boutique";
            require_once __DIR__ . '/app/views/layouts/header.php';
            require_once __DIR__ . '/app/views/home/index.php';
            require_once __DIR__ . '/app/views/layouts/footer.php';
        }
        break;

    case '/productos':
    case '/coleccion':
        if (class_exists('App\Controllers\ProductController')) {
            (new ProductController())->index();
        } else {
            $title = "DASSHOP | Colección Boutique";
            require_once __DIR__ . '/app/views/layouts/header.php';
            require_once __DIR__ . '/app/views/products/index.php';
            require_once __DIR__ . '/app/views/layouts/footer.php';
        }
        break;

    case '/personalizar':
        if (class_exists('App\Controllers\ProductController')) {
            (new ProductController())->customize();
        } else {
            $title = "DASSHOP | Estudio Creativo";
            require_once __DIR__ . '/app/views/layouts/header.php';
            require_once __DIR__ . '/app/views/products/customize.php';
            require_once __DIR__ . '/app/views/layouts/footer.php';
        }
        break;

    case '/login':
        $controller = new AuthController();
        $_SERVER['REQUEST_METHOD'] === 'POST' ? $controller->login() : $controller->showLogin();
        break;

    case '/registro':
        $controller = new AuthController();
        $_SERVER['REQUEST_METHOD'] === 'POST' ? $controller->register() : $controller->showRegister();
        break;

    case '/logout':
        (new AuthController())->logout();
        break;

    // VISTA DE PERFIL DIRECTA (SIN DEPENDER DE ARCHIVOS EXTERNOS)
    case '/perfil':
        $title = "DASSHOP | Mi Perfil Boutique";
        require_once __DIR__ . '/app/views/layouts/header.php';
        ?>
        <main class="max-w-4xl mx-auto my-12 px-4">
            <div class="bg-white p-8 rounded-3xl border border-pink-100 shadow-md">
                <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 border-b border-pink-100 pb-6">
                    <div class="w-24 h-24 rounded-full bg-dass-burgundy text-dass-gold flex items-center justify-center font-bold text-3xl shadow-md border-4 border-pink-50">
                        <?= strtoupper(substr($_SESSION['user']['nombre'] ?? 'D', 0, 1)) ?>
                    </div>
                    <div class="text-center sm:text-left">
                        <h2 class="font-serif text-2xl font-bold text-dass-burgundy">
                            <?= htmlspecialchars($_SESSION['user']['nombre'] ?? 'Danna Sofía Díaz') ?>
                        </h2>
                        <p class="text-xs text-gray-500"><?= htmlspecialchars($_SESSION['user']['email'] ?? 'danna@dasshop.com') ?></p>
                        <div class="mt-2 flex items-center gap-2">
                            <span class="text-[10px] bg-dass-gold text-white px-3 py-1 rounded-full font-bold">
                                ROL: <?= strtoupper($_SESSION['user']['rol'] ?? 'ADMIN') ?>
                            </span>
                            <span class="text-[10px] bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold">
                                CLIENTE VIP
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 space-y-6">
                    <h3 class="font-serif text-lg font-bold text-dass-burgundy">Información de Cuenta & Envío</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-gray-600 bg-pink-50/40 p-6 rounded-2xl border border-pink-100">
                        <div>
                            <span class="font-bold text-dass-burgundy block">Nombre Completo:</span>
                            <?= htmlspecialchars($_SESSION['user']['nombre'] ?? 'Danna Sofía Díaz') ?>
                        </div>
                        <div>
                            <span class="font-bold text-dass-burgundy block">Correo Registrado:</span>
                            <?= htmlspecialchars($_SESSION['user']['email'] ?? 'danna@dasshop.com') ?>
                        </div>
                        <div>
                            <span class="font-bold text-dass-burgundy block">Ciudad Predeterminada:</span>
                            Bogotá D.C., Colombia
                        </div>
                        <div>
                            <span class="font-bold text-dass-burgundy block">Estado de la Cuenta:</span>
                            Verificada / Activa
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        require_once __DIR__ . '/app/views/layouts/footer.php';
        break;

    case '/nosotros':
        $title = "DASSHOP | Sobre Nosotros";
        require_once __DIR__ . '/app/views/layouts/header.php';
        ?>
        <main class="max-w-4xl mx-auto my-12 px-4">
            <div class="bg-white p-8 rounded-3xl border border-pink-100 shadow-sm text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-dass-gold">Nuestra Esencia</span>
                <h1 class="font-serif text-3xl font-bold text-dass-burgundy mt-1 mb-4">Sobre DASSHOP</h1>
                <p class="text-xs text-gray-600 leading-relaxed max-w-2xl mx-auto">
                    DASSHOP es una marca boutique enfocada en la creación y personalización de artículos de alta calidad, combinando elegancia, diseño exclusivo y tecnología en estampado HD.
                </p>
            </div>
        </main>
        <?php
        require_once __DIR__ . '/app/views/layouts/footer.php';
        break;

    case '/contacto':
        $title = "DASSHOP | Contacto";
        require_once __DIR__ . '/app/views/layouts/header.php';
        ?>
        <main class="max-w-4xl mx-auto my-12 px-4">
            <div class="bg-white p-8 rounded-3xl border border-pink-100 shadow-sm text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-dass-gold">Atención al Cliente</span>
                <h1 class="font-serif text-3xl font-bold text-dass-burgundy mt-1 mb-4">Contáctanos</h1>
                <p class="text-xs text-gray-600 mb-2"><strong>Atención WhatsApp:</strong> +57 300 000 0000</p>
                <p class="text-xs text-gray-600"><strong>Correo:</strong> contacto@dasshop.com</p>
            </div>
        </main>
        <?php
        require_once __DIR__ . '/app/views/layouts/footer.php';
        break;

    case '/usuarios':
        if (class_exists('App\Controllers\UserController')) {
            (new UserController())->index();
        }
        break;

    case '/carrito':
        if (class_exists('App\Controllers\CartController')) {
            (new CartController())->index();
        } else {
            $title = "DASSHOP | Carrito";
            require_once __DIR__ . '/app/views/layouts/header.php';
            require_once __DIR__ . '/app/views/cart/index.php';
            require_once __DIR__ . '/app/views/layouts/footer.php';
        }
        break;

    case '/carrito/agregar':
        if (class_exists('App\Controllers\CartController')) {
            (new CartController())->add();
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
                $_SESSION['cart'][] = [
                    'id' => uniqid(),
                    'nombre' => $_POST['nombre'] ?? 'Producto Custom',
                    'precio' => (float)($_POST['precio'] ?? 65000),
                    'color' => $_POST['color'] ?? 'Borgoña Boutique',
                    'talla' => $_POST['talla'] ?? 'M',
                    'texto' => $_POST['texto_custom'] ?? '',
                    'cantidad' => 1
                ];
            }
            header("Location: /dasshop/carrito");
            exit;
        }
        break;

    case '/checkout':
        if (class_exists('App\Controllers\CartController')) {
            (new CartController())->checkout();
        } else {
            $title = "DASSHOP | Finalizar Pago";
            require_once __DIR__ . '/app/views/layouts/header.php';
            require_once __DIR__ . '/app/views/cart/checkout.php';
            require_once __DIR__ . '/app/views/layouts/footer.php';
        }
        break;

    default:
        http_response_code(404);
        $title = "DASSHOP | 404";
        require_once __DIR__ . '/app/views/layouts/header.php';
        echo '<div class="max-w-md mx-auto my-20 text-center"><h1 class="font-serif text-4xl font-bold text-dass-burgundy">404</h1><p class="text-xs text-gray-500 mt-2">Página no encontrada</p></div>';
        require_once __DIR__ . '/app/views/layouts/footer.php';
        break;
}