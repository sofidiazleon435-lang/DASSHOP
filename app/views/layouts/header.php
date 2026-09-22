<?php
// Obtener cantidad de items en carrito
$cartCount = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += intval($item['cantidad'] ?? 1);
    }
}

// Detectar la página activa para el subrayado elegante
$currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$isHome = ($currentUri === '/dasshop' || $currentUri === '/dasshop/' || $currentUri === '/dasshop/home' || $currentUri === '/dasshop/inicio');
$isColeccion = (strpos($currentUri, '/dasshop/productos') !== false || strpos($currentUri, '/dasshop/coleccion') !== false);
$isUsuarios = (strpos($currentUri, '/dasshop/usuarios') !== false);

// Nombre de usuario en sesión
$userName = '';
if (isset($_SESSION['user'])) {
    if (is_array($_SESSION['user'])) {
        $userName = $_SESSION['user']['nombre'] ?? $_SESSION['user']['name'] ?? $_SESSION['user']['email'] ?? '';
    } else {
        $userName = $_SESSION['user'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'DASSHOP | Tienda Online' ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dass-burgundy': '#4A1525',
                        'dass-gold': '#D4AF37'
                    },
                    fontFamily: {
                        'serif': ['Playfair Display', 'serif'],
                        'sans': ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#FAF8F5] text-gray-800 font-sans min-h-screen flex flex-col justify-between">

    <!-- HEADER / NAVEGACIÓN -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- LOGO DASSHOP -->
                <a href="/dasshop/home" class="flex items-center gap-2 group">
                    <span class="font-serif text-3xl font-bold tracking-tight text-dass-burgundy transition group-hover:opacity-80">
                        Dasshop
                    </span>
                </a>

                <!-- MENÚ DE NAVEGACIÓN CON SUBRAYADO ACTIVO -->
                <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold uppercase tracking-wider text-gray-600">
                    <a href="/dasshop/home" class="relative py-2 transition hover:text-dass-burgundy <?= $isHome ? 'text-dass-burgundy font-bold' : '' ?>">
                        Inicio
                        <?php if ($isHome): ?>
                            <span class="absolute bottom-0 left-0 w-full h-[2px] bg-dass-burgundy rounded-full"></span>
                        <?php endif; ?>
                    </a>
                    <a href="/dasshop/productos" class="relative py-2 transition hover:text-dass-burgundy <?= $isColeccion ? 'text-dass-burgundy font-bold' : '' ?>">
                        Colección
                        <?php if ($isColeccion): ?>
                            <span class="absolute bottom-0 left-0 w-full h-[2px] bg-dass-burgundy rounded-full"></span>
                        <?php endif; ?>
                    </a>
                    <a href="/dasshop/usuarios" class="relative py-2 transition hover:text-dass-burgundy <?= $isUsuarios ? 'text-dass-burgundy font-bold' : '' ?>">
                        Usuarios
                        <?php if ($isUsuarios): ?>
                            <span class="absolute bottom-0 left-0 w-full h-[2px] bg-dass-burgundy rounded-full"></span>
                        <?php endif; ?>
                    </a>
                </nav>

                <!-- ACCIONES: CARRITO Y SESIÓN -->
                <div class="flex items-center gap-5">
                    
                    <!-- Carrito -->
                    <a href="/dasshop/carrito" class="relative p-1 text-dass-burgundy hover:opacity-80 transition" title="Ver Carrito">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <?php if ($cartCount > 0): ?>
                            <span class="absolute -top-1 -right-2 bg-dass-burgundy text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-md">
                                <?= $cartCount ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <!-- Autenticación -->
                    <?php if (!empty($userName)): ?>
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-dass-burgundy tracking-wide uppercase">
                                <?= htmlspecialchars($userName) ?>
                            </span>
                            <a href="/dasshop/logout" class="text-xs text-gray-400 hover:text-red-600 transition font-medium">
                                Salir
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="/dasshop/login" class="text-xs font-semibold text-gray-700 hover:text-dass-burgundy transition px-2 py-1">
                            Ingresar
                        </a>
                        <a href="/dasshop/registro" class="bg-dass-burgundy text-white text-xs font-medium px-5 py-2.5 rounded-full shadow-md hover:bg-opacity-90 transition">
                            Unirse
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </header>