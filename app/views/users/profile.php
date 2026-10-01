<main class="max-w-4xl mx-auto my-12 px-4">
    <div class="bg-white p-8 rounded-3xl border border-pink-100 shadow-md">
        <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 border-b border-pink-100 pb-6">
            <div class="w-20 h-20 rounded-full bg-dass-burgundy text-white flex items-center justify-center font-bold text-2xl shadow-md border-2 border-pink-100">
                <?= strtoupper(substr($_SESSION['user']['nombre'] ?? 'D', 0, 1)) ?>
            </div>
            <div class="text-center sm:text-left">
                <h2 class="font-serif text-2xl font-bold text-dass-burgundy">
                    <?= htmlspecialchars($_SESSION['user']['nombre'] ?? 'Danna Sofía Díaz') ?>
                </h2>
                <p class="text-xs text-gray-500"><?= htmlspecialchars($_SESSION['user']['email'] ?? 'danna@dasshop.com') ?></p>
                <span class="inline-block mt-2 text-[10px] bg-dass-gold text-white px-3 py-0.5 rounded-full font-bold">
                    ROL: <?= strtoupper($_SESSION['user']['rol'] ?? 'ADMIN') ?>
                </span>
            </div>
        </div>

        <div class="mt-8 space-y-4">
            <h3 class="font-serif text-lg font-bold text-dass-burgundy">Tu Información de Entrega</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-gray-600 bg-pink-50/40 p-6 rounded-2xl border border-pink-100">
                <div>
                    <span class="font-bold text-dass-burgundy block">Ciudad Predeterminada:</span>
                    Bogotá D.C.
                </div>
                <div>
                    <span class="font-bold text-dass-burgundy block">Estado de Cuenta:</span>
                    Verificada / Activa
                </div>
            </div>
        </div>
    </div>
</main>