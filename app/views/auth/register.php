<<main class="flex-grow flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full bg-white/80 backdrop-blur-md p-8 rounded-3xl border border-dass-rose/50 shadow-xl space-y-6">
        <div class="text-center">
            <h2 class="font-serif text-3xl font-bold text-dass-burgundy">Crear Cuenta</h2>
            <p class="text-xs text-gray-500 mt-2">Únete a DASSHOP y diseña tus productos a medida</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-red-50 border border-red-200 text-red-600 text-xs p-3 rounded-xl text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/dasshop/auth/register" method="POST" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nombre *</label>
                    <input type="text" name="nombre" required placeholder="Nombre"
                        class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Apellido *</label>
                    <input type="text" name="apellido" required placeholder="Apellido"
                        class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Correo Electrónico *</label>
                <input type="email" name="email" required placeholder="tu@email.com"
                    class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Contraseña *</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Teléfono</label>
                    <input type="tel" name="telefono" placeholder="3001234567"
                        class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Ciudad</label>
                    <input type="text" name="ciudad" placeholder="Bogotá"
                        class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-dass-burgundy text-white font-medium py-3.5 rounded-full shadow-lg hover:bg-opacity-95 transition duration-200 text-sm tracking-wider mt-2">
                Registrarme
            </button>
        </form>

        <p class="text-center text-xs text-gray-500 pt-2">
            ¿Ya tienes cuenta? 
            <a href="/dasshop/auth/login" class="text-dass-burgundy font-semibold hover:underline">Inicia sesión</a>
        </p>
    </div>
</main>