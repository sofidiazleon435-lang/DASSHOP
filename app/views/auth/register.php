<main class="max-w-xl mx-auto my-12 px-4">
    <div class="bg-white p-8 rounded-3xl border border-pink-100 shadow-sm">
        <div class="text-center mb-6">
            <span class="text-[10px] font-bold uppercase tracking-widest text-dass-gold">Únete a DASSHOP</span>
            <h2 class="font-serif text-3xl font-bold text-dass-burgundy mt-1">Crear Cuenta</h2>
            <p class="text-xs text-gray-500 mt-1">Diligencia tus datos para personalizar tus artículos y gestionar compras.</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-50 text-red-600 text-xs p-3 rounded-xl mb-6 border border-red-100 text-center">
                Hubo un inconveniente al registrar. Revisa los datos suministrados.
            </div>
        <?php endif; ?>

        <form action="/dasshop/registro" method="POST" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nombre</label>
                    <input type="text" name="nombre" required placeholder="Danna" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs focus:outline-none focus:border-dass-burgundy bg-pink-50/20">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Apellido</label>
                    <input type="text" name="apellido" required placeholder="Díaz" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs focus:outline-none focus:border-dass-burgundy bg-pink-50/20">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Correo Electrónico</label>
                <input type="email" name="email" required placeholder="usuario@ejemplo.com" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs focus:outline-none focus:border-dass-burgundy bg-pink-50/20">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Teléfono / Celular</label>
                    <input type="tel" name="telefono" placeholder="+57 300 000 0000" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs focus:outline-none focus:border-dass-burgundy bg-pink-50/20">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Dirección de Envío</label>
                    <input type="text" name="direccion" placeholder="Calle 123 #45-67" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs focus:outline-none focus:border-dass-burgundy bg-pink-50/20">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Contraseña</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs focus:outline-none focus:border-dass-burgundy bg-pink-50/20">
            </div>

            <button type="submit" class="w-full bg-dass-burgundy text-white text-xs font-bold py-3 rounded-full shadow hover:bg-opacity-90 transition mt-2">
                Completar Registro
            </button>
        </form>

        <p class="text-xs text-center text-gray-500 mt-6">
            ¿Ya cuentas con usuario? <a href="/dasshop/login" class="text-dass-burgundy font-bold hover:underline">Inicia sesión</a>
        </p>
    </div>
</main>