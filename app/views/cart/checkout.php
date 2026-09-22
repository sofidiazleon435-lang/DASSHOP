<main class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="font-serif text-3xl font-bold text-dass-burgundy mb-8 text-center">Finalizar Compra</h1>

    <form action="/dasshop/carrito/procesar-pago" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- COLUMNA IZQUIERDA: DATOS DE ENVÍO Y PAGO -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- 1. Datos del Cliente -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-dass-rose/60 shadow-md space-y-4">
                <h2 class="font-serif text-lg font-bold text-dass-burgundy border-b border-pink-100 pb-2">1. Datos de Envío</h2>
                
                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Nombre Completo *</label>
                        <input type="text" name="nombre_completo" required placeholder="Ej. Danna Díaz"
                               class="w-full p-3 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">Correo Electrónico *</label>
                            <input type="email" name="email" required placeholder="ejemplo@correo.com"
                                   class="w-full p-3 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">Teléfono / WhatsApp *</label>
                            <input type="tel" name="telefono" required placeholder="300 000 0000"
                                   class="w-full p-3 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="md:col-span-2">
                            <label class="block font-semibold text-gray-700 mb-1">Dirección de Entrega *</label>
                            <input type="text" name="direccion" required placeholder="Calle 123 # 45 - 67"
                                   class="w-full p-3 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">Ciudad *</label>
                            <input type="text" id="ciudad-input" name="ciudad" required placeholder="Ej. Bogotá"
                                   class="w-full p-3 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Notas especiales sobre la prenda o diseño (Opcional):</label>
                        <textarea name="notas" rows="2" placeholder="Detalles de ubicación del estampado, instrucciones especiales..."
                                  class="w-full p-3 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy"></textarea>
                    </div>
                </div>
            </div>

            <!-- 2. Método de Pago -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-dass-rose/60 shadow-md space-y-4">
                <h2 class="font-serif text-lg font-bold text-dass-burgundy border-b border-pink-100 pb-2">2. Método de Pago</h2>
                
                <div class="space-y-3 text-xs">
                    <!-- Opción 1: Nequi / Bancolombia / QR -->
                    <label class="flex items-start gap-3 p-3.5 rounded-xl border border-gray-200 cursor-pointer hover:border-dass-burgundy transition bg-white">
                        <input type="radio" id="pay-transfer" name="metodo_pago" value="transferencia" checked onchange="togglePayment('qr')" class="mt-0.5 text-dass-burgundy focus:ring-dass-burgundy">
                        <div>
                            <span class="font-bold text-gray-800">Transferencia / QR (Nequi, Daviplata, Bancolombia)</span>
                            <p class="text-gray-500 text-[11px]">Pago rápido sin comisiones. Recibirás los datos para transferencia tras confirmar.</p>
                        </div>
                    </label>

                    <!-- Opción 2: Tarjeta de Crédito / Débito -->
                    <label class="flex items-start gap-3 p-3.5 rounded-xl border border-gray-200 cursor-pointer hover:border-dass-burgundy transition bg-white">
                        <input type="radio" name="metodo_pago" value="tarjeta" onchange="togglePayment('card')" class="mt-0.5 text-dass-burgundy focus:ring-dass-burgundy">
                        <div>
                            <span class="font-bold text-gray-800">Tarjeta de Crédito / Débito</span>
                            <p class="text-gray-500 text-[11px]">Procesamiento seguro con Visa, Mastercard, American Express.</p>
                        </div>
                    </label>

                    <!-- Opción 3: Pago Contra Entrega (Solo Bogotá) -->
                    <label id="container-cod" class="flex items-start gap-3 p-3.5 rounded-xl border border-gray-200 bg-gray-50 transition opacity-60">
                        <input type="radio" id="pay-cod" name="metodo_pago" value="contraentrega" disabled onchange="togglePayment('cod')" class="mt-0.5 text-dass-burgundy focus:ring-dass-burgundy">
                        <div>
                            <span class="font-bold text-gray-800">Pago Contra Entrega 🚚</span>
                            <p id="cod-text" class="text-gray-500 text-[11px]">Pagas en efectivo o transferencia al recibir tu pedido. <strong>(Solo disponible para Bogotá)</strong>.</p>
                        </div>
                    </label>

                    <!-- Detalle Tarjeta -->
                    <div id="card-details" class="hidden space-y-3 p-4 bg-gray-50 rounded-xl border border-gray-200 mt-2">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">Número de Tarjeta</label>
                            <input type="text" placeholder="4000 0000 0000 0000" maxlength="19" class="w-full p-2.5 rounded-lg border border-gray-200 bg-white">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-semibold text-gray-700 mb-1">Expiración (MM/AA)</label>
                                <input type="text" placeholder="12/28" maxlength="5" class="w-full p-2.5 rounded-lg border border-gray-200 bg-white">
                            </div>
                            <div>
                                <label class="block font-semibold text-gray-700 mb-1">CVC / CVV</label>
                                <input type="password" placeholder="123" maxlength="4" class="w-full p-2.5 rounded-lg border border-gray-200 bg-white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- COLUMNA DERECHA: RESUMEN DE COMPRA -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white/90 backdrop-blur-md p-6 rounded-2xl border border-dass-rose/60 shadow-md space-y-4 sticky top-6">
                <h2 class="font-serif text-lg font-bold text-dass-burgundy border-b border-pink-100 pb-2">Resumen del Pedido</h2>

                <div class="divide-y divide-gray-100 max-h-60 overflow-y-auto pr-1">
                    <?php foreach ($cart as $item): ?>
                        <div class="py-3 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center border text-white font-mono text-[10px] shadow-sm shrink-0" 
                                 style="background-color: <?= htmlspecialchars($item['color'] ?? '#4A1525') ?>">
                                Prenda
                            </div>
                            <div class="flex-1 text-xs">
                                <h4 class="font-bold text-gray-800"><?= htmlspecialchars($item['nombre']) ?></h4>
                                <p class="text-gray-500 text-[11px]">Corte: <?= htmlspecialchars($item['corte'] ?? 'Standard') ?></p>
                                <p class="text-gray-500 text-[11px]">Cantidad: <?= $item['cantidad'] ?></p>
                            </div>
                            <span class="text-xs font-bold text-dass-burgundy">
                                $<?= number_format($item['precio'] * $item['cantidad'], 0, ',', '.') ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="space-y-2 border-t border-gray-200 pt-4 text-xs">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal prendas:</span>
                        <span>$<?= number_format($subtotal, 0, ',', '.') ?> COP</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Envío a domicilio:</span>
                        <span>$<?= number_format($envio, 0, ',', '.') ?> COP</span>
                    </div>
                    <div class="flex justify-between text-base font-bold text-dass-burgundy border-t border-gray-200 pt-3">
                        <span>Total a pagar:</span>
                        <span>$<?= number_format($total, 0, ',', '.') ?> COP</span>
                    </div>
                </div>

                <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                <input type="hidden" name="envio" value="<?= $envio ?>">
                <input type="hidden" name="total" value="<?= $total ?>">

                <button type="submit" class="w-full bg-dass-burgundy text-white text-xs font-medium py-3.5 rounded-full shadow-lg hover:bg-opacity-95 transition mt-4">
                    Confirmar y Pagar $<?= number_format($total, 0, ',', '.') ?> COP
                </button>
            </div>
        </div>

    </form>
</main>

<script>
    const ciudadInput = document.getElementById('ciudad-input');
    const payCod = document.getElementById('pay-cod');
    const containerCod = document.getElementById('container-cod');
    const codText = document.getElementById('cod-text');
    const payTransfer = document.getElementById('pay-transfer');

    // Validación interactiva de ciudad para activar/desactivar Pago Contra Entrega
    ciudadInput.addEventListener('input', (e) => {
        const val = e.target.value.trim().toLowerCase();
        
        // Normaliza para detectar "bogota" o "bogotá"
        if (val.includes('bogota') || val.includes('bogotá')) {
            payCod.disabled = false;
            containerCod.classList.remove('opacity-60', 'bg-gray-50');
            containerCod.classList.add('bg-white', 'cursor-pointer', 'border-pink-200');
            codText.innerHTML = 'Pagas en efectivo o transferencia al recibir tu pedido. <span class="text-green-600 font-bold">¡Disponible en Bogotá!</span>';
        } else {
            if (payCod.checked) {
                payTransfer.checked = true;
                togglePayment('qr');
            }
            payCod.disabled = true;
            containerCod.classList.add('opacity-60', 'bg-gray-50');
            containerCod.classList.remove('bg-white', 'cursor-pointer', 'border-pink-200');
            codText.innerHTML = 'Pagas en efectivo o transferencia al recibir tu pedido. <strong>(Solo disponible para Bogotá)</strong>.';
        }
    });

    function togglePayment(type) {
        const cardDetails = document.getElementById('card-details');
        if (type === 'card') {
            cardDetails.classList.remove('hidden');
        } else {
            cardDetails.classList.add('hidden');
        }
    }
</script>