<main class="max-w-md mx-auto my-16 px-4">
    <div class="bg-white p-8 rounded-3xl border border-pink-100 shadow-sm text-center">
        <h2 class="font-serif text-2xl font-bold text-dass-burgundy mb-2">Iniciar Sesión</h2>
        <p class="text-xs text-gray-500 mb-6">Ingresa a tu cuenta de DASSHOP</p>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-50 text-red-600 text-xs p-3 rounded-xl mb-4 border border-red-100">
                Correo o contraseña incorrectos.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['registrado'])): ?>
            <div class="bg-green-50 text-green-700 text-xs p-3 rounded-xl mb-4 border border-green-100">
                ¡Registro exitoso! Ya puedes iniciar sesión.
            </div>
        <?php endif; ?>

        <form action="/dasshop/login" method="POST" class="space-y-4 text-left">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Correo Electrónico</label>
                <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs focus:outline-none focus:border-dass-burgundy">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Contraseña</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs focus:outline-none focus:border-dass-burgundy">
            </div>

            <button type="submit" class="w-full bg-dass-burgundy text-white text-xs font-bold py-3 rounded-xl shadow hover:bg-opacity-90 transition mt-2">
                Ingresar
            </button>
        </form>

        <p class="text-xs text-gray-500 mt-6">
            ¿No tienes una cuenta? <a href="/dasshop/registro" class="text-dass-burgundy font-bold hover:underline">Regístrate aquí</a>
        </p>
    </div>
</main>