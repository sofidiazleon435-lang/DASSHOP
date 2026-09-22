<main class="flex-grow flex items-center justify-center px-6 py-16">
    <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-3xl shadow-xl border border-dass-rose/50 p-8 space-y-6">
        <div class="text-center">
            <h2 class="font-serif text-3xl font-bold text-dass-burgundy">Bienvenido</h2>
            <p class="text-xs text-gray-500 mt-1">Ingresa tus datos para acceder a tu espacio exclusivo</p>
        </div>

        <?php if (isset($_GET['registered'])): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-2xl p-3 text-center">
                ¡Cuenta creada exitosamente! Ya puedes iniciar sesión.
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-2xl p-3 text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/dasshop/auth/login" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" required placeholder="tu@email.com"
                    class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Contraseña</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-2xl border border-dass-rose/60 focus:outline-none focus:ring-2 focus:ring-dass-accent/50 text-sm bg-white/50">
            </div>

            <button type="submit" 
                class="w-full bg-dass-burgundy text-white font-medium py-3.5 rounded-full shadow-lg hover:bg-opacity-95 hover:scale-[1.02] transition duration-200 text-sm tracking-wider">
                Iniciar Sesión
            </button>
        </form>

        <p class="text-center text-xs text-gray-600">
            ¿Aún no tienes cuenta? 
            <a href="/dasshop/auth/register" class="text-dass-gold font-bold hover:underline">Regístrate aquí</a>
        </p>
    </div>
</main>