<<main class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="font-serif text-3xl font-bold text-dass-burgundy mb-8 text-center">Tu Carrito de Compras</h1>

    <?php if (empty($cart)): ?>
        <div class="bg-white/80 backdrop-blur-md p-10 rounded-3xl border border-dass-rose/60 shadow-xl text-center space-y-4">
            <div class="w-16 h-16 bg-pink-100 text-dass-burgundy rounded-full flex items-center justify-center mx-auto text-2xl shadow-inner">
                🛍️
            </div>
            <h2 class="font-serif text-xl font-bold text-dass-burgundy">Tu carrito está vacío</h2>
            <p class="text-xs text-gray-500">Explora nuestra colección y personaliza tus prendas favoritas.</p>
            <div class="pt-2">
                <a href="/dasshop/coleccion" class="inline-block bg-dass-burgundy text-white text-xs font-medium px-8 py-3.5 rounded-full shadow-lg hover:bg-opacity-95 transition">
                    Ver Colección
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LISTA DE PRODUCTOS -->
            <div class="lg:col-span-8 space-y-4">
                <?php foreach ($cart as $key => $item): ?>
                    <div class="bg-white/80 backdrop-blur-md p-5 rounded-2xl border border-dass-rose/60 shadow-sm flex items-center gap-4">
                        
                        <!-- Muestra de Color / Prenda -->
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white text-[10px] font-mono shadow-inner shrink-0" 
                             style="background-color: <?= htmlspecialchars($item['color'] ?? '#4A1525') ?>;">
                            Prenda
                        </div>

                        <!-- Info del Producto -->
                        <div class="flex-1 text-xs space-y-1">
                            <h3 class="font-bold text-gray-800 text-sm"><?= htmlspecialchars($item['nombre']) ?></h3>
                            <p class="text-gray-500">Corte: <span class="font-semibold text-gray-700"><?= htmlspecialchars($item['corte'] ?? 'Estándar') ?></span></p>
                            <p class="text-gray-500">Cantidad: <span class="font-semibold text-gray-700"><?= intval($item['cantidad']) ?></span></p>
                            <p class="font-bold text-dass-burgundy text-xs mt-1">
                                $<?= number_format(floatval($item['precio']) * intval($item['cantidad']), 0, ',', '.') ?> COP
                            </p>
                        </div>

                        <!-- Botón Eliminar -->
                        <a href="/dasshop/carrito/eliminar?key=<?= urlencode($key) ?>" 
                           class="text-xs text-red-400 hover:text-red-600 font-semibold px-3 py-1.5 rounded-lg hover:bg-red-50 transition">
                            Eliminar
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- RESUMEN DE COMPRA -->
            <div class="lg:col-span-4">
                <div class="bg-white/90 backdrop-blur-md p-6 rounded-2xl border border-dass-rose/60 shadow-md space-y-4 sticky top-6">
                    <h2 class="font-serif text-lg font-bold text-dass-burgundy border-b border-pink-100 pb-2">Resumen</h2>
                    
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal:</span>
                            <span class="font-semibold text-gray-800">$<?= number_format($subtotal, 0, ',', '.') ?> COP</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Envío estimación:</span>
                            <span class="font-semibold text-gray-800">$10.000 COP</span>
                        </div>
                        <div class="flex justify-between text-sm font-bold text-dass-burgundy border-t border-gray-200 pt-3">
                            <span>Total estimado:</span>
                            <span>$<?= number_format($subtotal + 10000, 0, ',', '.') ?> COP</span>
                        </div>
                    </div>

                    <!-- Enlace corregido al checkout -->
                    <a href="/dasshop/carrito/checkout" 
                       class="block w-full text-center bg-dass-burgundy text-white text-xs font-medium py-3.5 rounded-full shadow-lg hover:bg-opacity-95 transition mt-4">
                        Proceder al Pago
                    </a>
                </div>
            </div>

        </div>
    <?php endif; ?>
</main>