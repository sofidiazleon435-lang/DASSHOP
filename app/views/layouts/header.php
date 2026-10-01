<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = str_replace('/dasshop', '', $currentUri);
$route = rtrim($route, '/');
if (empty($route)) $route = '/home';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'DASSHOP | Boutique & Custom' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'dass-burgundy': '#4A1525',
              'dass-gold': '#D4AF37',
              'dass-pink': '#FAF8F5',
            }
          }
        }
      }
    </script>
    <!-- Fuentes Boutique: Playfair Display, Plus Jakarta Sans y Alex Brush (Cursiva Elegante) -->
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FAF8F5; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        .font-cursive { font-family: 'Alex Brush', cursive; }
    </style>
</head>
<body class="bg-[#FAF8F5] text-gray-800 antialiased min-h-screen flex flex-col justify-between">

<header class="bg-white border-b border-pink-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <a href="/dasshop/home" class="font-serif text-3xl font-bold text-dass-burgundy tracking-tight">DASSHOP</a>
        
        <nav class="hidden md:flex space-x-8 text-xs font-semibold uppercase tracking-widest text-gray-600">
            <a href="/dasshop/home" class="<?= ($route === '/home' || $route === '') ? 'text-dass-burgundy font-bold border-b-2 border-dass-burgundy pb-1' : 'hover:text-dass-burgundy transition' ?>">Inicio</a>
            <a href="/dasshop/productos" class="<?= ($route === '/productos' || $route === '/coleccion') ? 'text-dass-burgundy font-bold border-b-2 border-dass-burgundy pb-1' : 'hover:text-dass-burgundy transition' ?>">Colección</a>
            <a href="/dasshop/personalizar" class="<?= ($route === '/personalizar') ? 'text-dass-gold font-bold border-b-2 border-dass-gold pb-1' : 'hover:text-dass-gold transition' ?>">Personalizar</a>
            <a href="/dasshop/usuarios" class="<?= ($route === '/usuarios') ? 'text-dass-burgundy font-bold border-b-2 border-dass-burgundy pb-1' : 'hover:text-dass-burgundy transition' ?>">Usuarios</a>
        </nav>

        <div class="flex items-center space-x-4">
            <?php if (isset($_SESSION['user'])): ?>
                <div class="flex items-center space-x-3">
                    <a href="/dasshop/perfil" class="flex items-center space-x-2 bg-pink-50 px-3 py-1.5 rounded-full border border-pink-100 hover:bg-pink-100/60 transition">
                        <div class="w-6 h-6 rounded-full bg-dass-burgundy text-white flex items-center justify-center font-bold text-[10px]">
                            <?= strtoupper(substr($_SESSION['user']['nombre'] ?? 'D', 0, 1)) ?>
                        </div>
                        <span class="text-xs font-semibold text-dass-burgundy">
                            <?= htmlspecialchars($_SESSION['user']['nombre']) ?>
                        </span>
                        <?php if (($_SESSION['user']['rol'] ?? '') === 'Admin'): ?>
                            <span class="text-[9px] bg-dass-gold text-white px-1.5 py-0.5 rounded-full font-bold">ADMIN</span>
                        <?php endif; ?>
                    </a>
                    <a href="/dasshop/logout" class="text-xs font-semibold text-gray-500 hover:text-dass-burgundy transition">Salir</a>
                </div>
            <?php else: ?>
                <a href="/dasshop/login" class="text-xs font-semibold text-dass-burgundy hover:underline">Iniciar Sesión</a>
                <a href="/dasshop/registro" class="bg-dass-burgundy text-white text-xs font-semibold px-4 py-2 rounded-full shadow hover:bg-opacity-90 transition">Registrarse</a>
            <?php endif; ?>
            
            <?php $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
            <a href="/dasshop/carrito" class="text-dass-burgundy font-semibold text-xs bg-pink-50 px-4 py-2 rounded-full border border-pink-100 flex items-center gap-1.5">
                <span>Carrito</span>
                <span class="bg-dass-burgundy text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold"><?= $cartCount ?></span>
            </a>
        </div>
    </div>
</header>