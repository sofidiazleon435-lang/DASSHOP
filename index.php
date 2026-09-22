<?php
// ==========================================
// DASSHOP - Enrutador Principal (Front Controller)
// ==========================================

session_start();

// Autoload de clases bajo el namespace App\
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Normalización de la URL solicitada
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($requestUri, '/');
if (empty($path)) {
    $path = '/';
}

// ==========================================
// RUTAS DINÁMICAS (Expresiones Regulares)
// ==========================================

// Detalle y personalizador de producto por ID (ej. /dasshop/productos/1)
if (preg_match('/^\/dasshop\/productos\/([0-9]+)$/', $path, $matches)) {
    $productId = $matches[1];
    (new App\Controllers\ProductController())->detail($productId);
    exit;
}

// ==========================================
// EVALUACIÓN DE RUTAS ESTÁTICAS
// ==========================================
switch ($path) {

    // --- INICIO Y COLECCIÓN ---
    case '':
    case '/':
    case '/dasshop':
    case '/dasshop/home':
    case '/dasshop/inicio':
        (new App\Controllers\HomeController())->index();
        break;

    case '/dasshop/productos':
    case '/dasshop/coleccion':
        (new App\Controllers\ProductController())->index();
        break;

    case '/dasshop/producto/detalle':
        (new App\Controllers\ProductController())->detail();
        break;

    // --- CARRITO DE COMPRAS ---
    case '/dasshop/carrito':
        (new App\Controllers\CartController())->index();
        break;

    case '/dasshop/carrito/agregar':
        (new App\Controllers\CartController())->add();
        break;

    case '/dasshop/carrito/eliminar':
        (new App\Controllers\CartController())->remove();
        break;

    // --- CHECKOUT / PAGO ---
    case '/dasshop/checkout':
    case '/dasshop/pago':
    case '/dasshop/carrito/checkout':
    case '/dasshop/carrito/pago':
        (new App\Controllers\CartController())->checkout();
        break;

    case '/dasshop/procesar-pago':
    case '/dasshop/carrito/procesar-pago':
        (new App\Controllers\CartController())->processCheckout();
        break;

    // --- AUTENTICACIÓN Y SESIONES ---
    case '/dasshop/login':
    case '/dasshop/ingresar':
    case '/dasshop/auth/login':
    case '/dasshop/auth/ingresar':
        (new App\Controllers\AuthController())->login();
        break;

    case '/dasshop/registro':
    case '/dasshop/unirse':
    case '/dasshop/auth/registro':
    case '/dasshop/auth/unirse':
        (new App\Controllers\AuthController())->register();
        break;

    case '/dasshop/logout':
    case '/dasshop/salir':
    case '/dasshop/auth/logout':
        (new App\Controllers\AuthController())->logout();
        break;

    // --- CRUD DE USUARIOS (NUEVO) ---
    case '/dasshop/usuarios':
        (new App\Controllers\UserController())->index();
        break;

    case '/dasshop/usuarios/guardar':
        (new App\Controllers\UserController())->store();
        break;

    case '/dasshop/usuarios/eliminar':
        (new App\Controllers\UserController())->delete();
        break;

    // --- PÁGINA NO ENCONTRADA (404) ---
    default:
        http_response_code(404);
        $title = "DASSHOP | Página no encontrada";
        require_once __DIR__ . '/app/views/layouts/header.php';
        ?>
        <main class="max-w-md mx-auto py-20 px-4 text-center space-y-4">
            <h1 class="font-serif text-6xl font-bold text-dass-burgundy">404</h1>
            <p class="text-sm font-medium text-gray-700">La página que buscas no existe o ha sido movida.</p>
            <div class="pt-4">
                <a href="/dasshop/home" class="inline-block bg-dass-burgundy text-white text-xs px-8 py-3.5 rounded-full shadow-lg hover:bg-opacity-95 transition">
                    Volver al Inicio
                </a>
            </div>
        </main>
        <?php
        require_once __DIR__ . '/app/views/layouts/footer.php';
        break;
}