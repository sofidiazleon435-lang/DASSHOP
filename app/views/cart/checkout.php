<main class="max-w-5xl mx-auto my-12 px-4">
    <div class="text-center mb-10">
        <span class="text-xs font-bold uppercase tracking-widest text-dass-gold">Facturación & Entrega</span>
        <h1 class="font-serif text-3xl font-bold text-dass-burgundy mt-1">Finalizar Compra</h1>
    </div>

    <form id="checkout-form" onsubmit="event.preventDefault(); generateReceipt();" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <!-- INFORMACIÓN COMPLETA DEL TITULAR -->
            <div class="bg-white p-6 rounded-3xl border border-pink-100 shadow-sm space-y-4">
                <h3 class="font-serif text-base font-bold text-dass-burgundy">1. Datos del Titular y Envío</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Nombre Completo del Titular</label>
                        <input type="text" id="billing-name" required value="<?= htmlspecialchars($_SESSION['user']['nombre'] ?? '') ?>" placeholder="Ej: Danna Sofía Díaz" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Cédula / Documento de Identidad</label>
                        <input type="text" id="billing-id" required placeholder="Ej: 1012345678" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Número de Teléfono / Celular</label>
                        <input type="tel" id="billing-phone" required placeholder="Ej: +57 300 123 4567" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Ciudad de Envío</label>
                        <select id="city-select" onchange="toggleCodOption()" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs font-bold text-dass-burgundy bg-white">
                            <option value="Bogotá">Bogotá D.C.</option>
                            <option value="Medellín">Medellín</option>
                            <option value="Cali">Cali</option>
                            <option value="Barranquilla">Barranquilla</option>
                            <option value="Bucaramanga">Bucaramanga</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Dirección Completa de Entrega</label>
                    <input type="text" id="billing-address" required placeholder="Ej: Calle 123 # 45 - 67 Apt 302" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs">
                </div>
            </div>

            <!-- MÉTODOS DE PAGO -->
            <div class="bg-white p-6 rounded-3xl border border-pink-100 shadow-sm space-y-4">
                <h3 class="font-serif text-base font-bold text-dass-burgundy">2. Forma de Pago</h3>

                <div class="space-y-3">
                    <label class="flex items-center justify-between p-4 border border-pink-100 rounded-2xl cursor-pointer hover:bg-pink-50/40 transition">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="pay_type" value="nequi" checked onclick="showPayDetails('nequi')" class="text-dass-burgundy">
                            <span class="text-xs font-bold text-gray-800">Nequi / Daviplata</span>
                        </div>
                        <span class="text-[10px] text-dass-gold font-bold uppercase">Transferencia</span>
                    </label>

                    <label class="flex items-center justify-between p-4 border border-pink-100 rounded-2xl cursor-pointer hover:bg-pink-50/40 transition">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="pay_type" value="pse" onclick="showPayDetails('pse')" class="text-dass-burgundy">
                            <span class="text-xs font-bold text-gray-800">PSE / Tarjeta Débito-Crédito</span>
                        </div>
                        <span class="text-[10px] text-gray-400 font-bold uppercase">En Línea</span>
                    </label>

                    <label id="cod-container" class="flex items-center justify-between p-4 border border-pink-100 rounded-2xl cursor-pointer hover:bg-pink-50/40 transition">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="pay_type" id="cod-radio" value="cod" onclick="showPayDetails('cod')" class="text-dass-burgundy">
                            <span class="text-xs font-bold text-gray-800">Pago Contra Entrega</span>
                        </div>
                        <span id="cod-badge" class="text-[10px] text-green-600 font-bold uppercase">Disponible (Solo Bogotá)</span>
                    </label>
                </div>

                <div id="pay-info-box" class="p-4 bg-pink-50/50 rounded-2xl border border-pink-100 text-xs text-gray-600">
                    <p class="font-bold text-dass-burgundy mb-1">Transferir a Nequi / Daviplata:</p>
                    <p class="text-dass-gold font-bold">300 000 0000 - DASSHOP S.A.S</p>
                </div>

                <button type="submit" class="w-full bg-dass-burgundy text-white text-xs font-bold py-3.5 rounded-full shadow hover:bg-opacity-90 transition mt-4">
                    Confirmar Orden & Generar Comprobante
                </button>
            </div>
        </div>

        <!-- RESUMEN -->
        <div class="bg-white p-6 rounded-3xl border border-pink-100 shadow-sm h-fit">
            <h3 class="font-serif text-lg font-bold text-dass-burgundy mb-4">Resumen</h3>
            <?php 
                $total = 0;
                foreach($cart as $item) { $total += $item['precio'] * $item['cantidad']; }
                if ($total == 0) $total = 65000;
            ?>
            <div class="space-y-2 text-xs text-gray-600 border-b border-gray-100 pb-4">
                <div class="flex justify-between"><span>Subtotal</span><span>$<?= number_format($total, 0, ',', '.') ?> COP</span></div>
                <div class="flex justify-between"><span>Envío</span><span class="text-green-600 font-semibold">Gratis</span></div>
            </div>
            <div class="flex justify-between items-center pt-4 font-bold text-sm text-dass-burgundy">
                <span>Total a Pagar</span>
                <span>$<?= number_format($total, 0, ',', '.') ?> COP</span>
            </div>
        </div>
    </form>
</main>

<script>
function toggleCodOption() {
    const city = document.getElementById('city-select').value;
    const codRadio = document.getElementById('cod-radio');
    const codBadge = document.getElementById('cod-badge');

    if (city !== 'Bogotá') {
        codRadio.disabled = true;
        codRadio.checked = false;
        codBadge.innerText = 'No Disponible fuera de Bogotá';
        codBadge.className = 'text-[10px] text-red-500 font-bold uppercase';
    } else {
        codRadio.disabled = false;
        codBadge.innerText = 'Disponible (Solo Bogotá)';
        codBadge.className = 'text-[10px] text-green-600 font-bold uppercase';
    }
}

function showPayDetails(type) {
    const box = document.getElementById('pay-info-box');
    if (type === 'nequi') {
        box.innerHTML = '<p class="font-bold text-dass-burgundy mb-1">Transferir a Nequi / Daviplata:</p><p class="text-dass-gold font-bold">300 000 0000 - DASSHOP S.A.S</p>';
    } else if (type === 'pse') {
        box.innerHTML = '<p class="font-bold text-dass-burgundy mb-1">Pago en Línea PSE:</p><p class="text-gray-500">Acceso a pasarela bancaria nacional.</p>';
    } else if (type === 'cod') {
        box.innerHTML = '<p class="font-bold text-dass-burgundy mb-1">Pago Contra Entrega (Efectivo):</p><p class="text-gray-500">Entregas únicamente en Bogotá D.C.</p>';
    }
}

function generateReceipt() {
    const name = document.getElementById('billing-name').value;
    const idNum = document.getElementById('billing-id').value;
    const phone = document.getElementById('billing-phone').value;
    const city = document.getElementById('city-select').value;
    const address = document.getElementById('billing-address').value;

    alert('¡ORDEN REGISTRADA CON ÉXITO!\n\n-----------------------------\nCOMPROBANTE DASSHOP\n-----------------------------\nTitular: ' + name + '\nCédula: ' + idNum + '\nTeléfono: ' + phone + '\nCiudad: ' + city + '\nDirección: ' + address + '\n\nEstado: Procesando Pedido\n¡Gracias por tu compra en DASSHOP!');
    window.location.href = '/dasshop/home';
}
</script>