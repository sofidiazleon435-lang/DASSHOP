<main class="max-w-4xl mx-auto my-12 px-4">
    <div class="text-center mb-8">
        <span class="text-xs font-bold uppercase tracking-widest text-dass-gold">Resumen</span>
        <h1 class="font-serif text-3xl font-bold text-dass-burgundy mt-1">Tu Carrito de Compras</h1>
    </div>

    <?php if (empty($cart)): ?>
        <div class="bg-white p-12 rounded-3xl border border-pink-100 text-center shadow-sm">
            <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4 text-dass-burgundy">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-gray-800">Tu carrito está vacío</h3>
            <p class="text-xs text-gray-500 mt-1 mb-6">Agrega un producto o personaliza uno a tu gusto.</p>
            <a href="/dasshop/personalizar" class="bg-dass-burgundy text-white text-xs font-semibold px-6 py-3 rounded-full shadow hover:bg-opacity-90">Personalizar Producto</a>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-3xl border border-pink-100 shadow-sm overflow-hidden p-6 space-y-4">
            <?php $subtotal = 0; ?>
            <?php foreach ($cart as $item): ?>
                <?php $subtotal += $item['precio'] * $item['cantidad']; ?>
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <h4 class="font-serif text-sm font-bold text-dass-burgundy"><?= htmlspecialchars($item['nombre']) ?></h4>
                        <p class="text-[11px] text-gray-500">Color: <?= htmlspecialchars($item['color']) ?> | Talla: <?= htmlspecialchars($item['talla']) ?></p>
                        <?php if (!empty($item['texto'])): ?>
                            <p class="text-[10px] text-dass-gold font-bold">Estampado: "<?= htmlspecialchars($item['texto']) ?>"</p>
                        <?php endif; ?>
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-dass-burgundy text-sm">$<?= number_format($item['precio'], 0, ',', '.') ?> COP</span>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="pt-4 flex items-center justify-between border-t border-pink-100">
                <span class="font-serif text-lg font-bold text-dass-burgundy">Total:</span>
                <span class="font-bold text-dass-burgundy text-xl">$<?= number_format($subtotal, 0, ',', '.') ?> COP</span>
            </div>

            <div class="pt-4 flex justify-end">
                <a href="/dasshop/checkout" class="bg-dass-burgundy text-white text-xs font-bold px-8 py-3.5 rounded-full shadow hover:bg-opacity-90 transition">
                    Proceder al Pago &rarr;
                </a>
            </div>
        </div>
    <?php endif; ?>
</main>