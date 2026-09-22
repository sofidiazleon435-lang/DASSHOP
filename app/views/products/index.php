<main class="max-w-7xl mx-auto px-4 py-10">
    <div class="text-center mb-12">
        <h1 class="font-serif text-4xl font-bold text-dass-burgundy">Catálogo de Productos</h1>
        <p class="text-xs sm:text-sm text-gray-500 mt-2">Explora nuestros artículos exclusivos y personalízalos a tu estilo</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($products as $product): ?>
            <div class="bg-white/80 backdrop-blur-md border border-dass-rose/50 rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 flex flex-col justify-between">
                <div>
                    <img src="<?= htmlspecialchars($product['imagen']) ?>" 
                         alt="<?= htmlspecialchars($product['nombre']) ?>" 
                         class="w-full h-64 object-cover">
                    <div class="p-5 space-y-2">
                        <span class="text-xs font-semibold px-3 py-1 bg-pink-100 text-dass-burgundy rounded-full inline-block">
                            <?= htmlspecialchars($product['categoria']) ?>
                        </span>
                        <h3 class="font-bold text-gray-800 text-lg leading-snug">
                            <?= htmlspecialchars($product['nombre']) ?>
                        </h3>
                        <p class="text-xs text-gray-500">
                            <?= htmlspecialchars($product['descripcion']) ?>
                        </p>
                    </div>
                </div>
                <div class="p-5 pt-0 flex items-center justify-between">
                    <span class="text-base font-bold text-dass-burgundy">
                        $<?= number_format($product['precio'], 0, ',', '.') ?> COP
                    </span>
                    <a href="/dasshop/productos/<?= $product['id'] ?>" 
                       class="bg-dass-burgundy text-white text-xs px-4 py-2 rounded-full hover:bg-opacity-90 transition shadow-md">
                        Personalizar
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>