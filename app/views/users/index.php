<main class="max-w-5xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="font-serif text-3xl font-bold text-dass-burgundy">Gestión de Usuarios</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Formulario Crear (CREATE) -->
        <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
            <h2 class="font-serif text-lg font-bold text-dass-burgundy mb-4">Nuevo Usuario</h2>
            <form action="/dasshop/usuarios/guardar" method="POST" class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Nombre Completo</label>
                    <input type="text" name="nombre" required placeholder="Ej. Sofía León" class="w-full p-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" required placeholder="correo@ejemplo.com" class="w-full p-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Rol</label>
                    <select name="rol" class="w-full p-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                        <option value="Cliente">Cliente</option>
                        <option value="Admin">Administrador</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-dass-burgundy text-white text-xs font-medium py-3 rounded-full shadow-md hover:bg-opacity-95 transition mt-2">
                    Guardar Usuario
                </button>
            </form>
        </div>

        <!-- Tabla de Registros (READ / DELETE) -->
        <div class="lg:col-span-8 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h2 class="font-serif text-lg font-bold text-dass-burgundy mb-4">Lista de Usuarios</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 font-semibold uppercase">
                            <th class="pb-3">Nombre</th>
                            <th class="pb-3">Email</th>
                            <th class="pb-3">Rol</th>
                            <th class="pb-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="py-3 font-medium text-gray-800"><?= htmlspecialchars($u['nombre']) ?></td>
                                <td class="py-3 text-gray-500"><?= htmlspecialchars($u['email']) ?></td>
                                <td class="py-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold <?= $u['rol'] === 'Admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-600' ?>">
                                        <?= htmlspecialchars($u['rol']) ?>
                                    </span>
                                </td>
                                <td class="py-3 text-right">
                                    <a href="/dasshop/usuarios/eliminar?id=<?= $u['id'] ?>" class="text-red-400 hover:text-red-600 font-semibold" onclick="return confirm('¿Eliminar usuario?')">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>