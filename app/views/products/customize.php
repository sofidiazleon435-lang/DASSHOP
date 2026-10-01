<main class="max-w-6xl mx-auto my-12 px-4">
    <div class="text-center mb-10">
        <span class="text-xs font-bold uppercase tracking-widest text-dass-gold">Estudio Creativo Boutique</span>
        <h1 class="font-serif text-3xl font-bold text-dass-burgundy mt-1">Personalización Interactiva</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 bg-white p-8 rounded-3xl border border-pink-100 shadow-md">
        
        <!-- MOCKUP Y VISTA PREVIA CENTRADA -->
        <div class="flex flex-col items-center justify-center bg-[#FAF8F5] rounded-3xl p-8 border border-pink-100">
            <div class="w-80 h-80 rounded-2xl flex items-center justify-center relative shadow-inner border border-pink-100 bg-white overflow-hidden">
                
                <!-- SVG Camiseta -->
                <svg id="svg-product-camiseta" class="w-60 h-60 transition-colors duration-300" style="color: #4A1525;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 2l-4 2-4-2-6 3v5h3v12h14V10h3V5l-6-3z"/>
                </svg>

                <!-- SVG Taza Proporcionada Centrada -->
                <svg id="svg-product-taza" class="hidden w-52 h-52 transition-colors duration-300" style="color: #4A1525;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 5h12v9c0 2.2-1.8 4-4 4H8c-2.2 0-4-1.8-4-4V5zm12 3h2c1.1 0 2 .9 2 2v2c0 1.1-.9 2-2 2h-2V8z"/>
                </svg>

                <!-- ESTAMPADO DE TEXTO E IMAGEN PERFECTAMENTE POSICIONADOS DENTRO DE LA TAZA / CAMISETA -->
                <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center pointer-events-none space-y-2">
                    <p id="custom-text-preview" class="font-serif text-xs font-bold text-dass-gold drop-shadow-md break-words max-w-[120px] leading-tight"></p>
                    <img id="custom-img-preview" class="hidden max-w-[75px] max-h-[75px] object-contain drop-shadow-md" alt="Estampado">
                </div>
            </div>

            <!-- PALETA EXTENDIDA DE COLORES BOUTIQUE -->
            <div class="flex flex-col items-center mt-6 space-y-2">
                <span class="text-xs font-semibold text-gray-600">Paleta de Colores Disponibles:</span>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="setItemColor('#4A1525', 'Borgoña Boutique')" title="Borgoña" class="w-7 h-7 rounded-full bg-[#4A1525] shadow-sm border-2 border-white hover:scale-110 transition"></button>
                    <button type="button" onclick="setItemColor('#D4AF37', 'Dorado Quartz')" title="Dorado" class="w-7 h-7 rounded-full bg-[#D4AF37] shadow-sm border-2 border-white hover:scale-110 transition"></button>
                    <button type="button" onclick="setItemColor('#FAF8F5', 'Blanco Marfil')" title="Blanco" class="w-7 h-7 rounded-full bg-[#FAF8F5] border-2 border-pink-300 shadow-sm hover:scale-110 transition"></button>
                    <button type="button" onclick="setItemColor('#18181b', 'Negro Azabache')" title="Negro" class="w-7 h-7 rounded-full bg-[#18181b] shadow-sm border-2 border-white hover:scale-110 transition"></button>
                    <button type="button" onclick="setItemColor('#F472B6', 'Rosa Pastel')" title="Rosa Pastel" class="w-7 h-7 rounded-full bg-[#F472B6] shadow-sm border-2 border-white hover:scale-110 transition"></button>
                    <button type="button" onclick="setItemColor('#38BDF8', 'Azul Marismo')" title="Azul Marismo" class="w-7 h-7 rounded-full bg-[#38BDF8] shadow-sm border-2 border-white hover:scale-110 transition"></button>
                    <button type="button" onclick="setItemColor('#4ADE80', 'Verde Menta')" title="Verde Menta" class="w-7 h-7 rounded-full bg-[#4ADE80] shadow-sm border-2 border-white hover:scale-110 transition"></button>
                </div>
            </div>
        </div>

        <!-- FORMULARIO -->
        <form action="/dasshop/carrito/agregar" method="POST" class="space-y-5 flex flex-col justify-between">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Selecciona Artículo Base</label>
                <select name="nombre" id="item-type-select" onchange="switchItemSvg()" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs font-bold text-dass-burgundy bg-pink-50/20">
                    <option value="Camiseta Oversize Personalizada" data-svg="camiseta" data-price="65000">Camiseta Oversize Personalizada ($65.000 COP)</option>
                    <option value="Taza Cerámica Mágica" data-svg="taza" data-price="35000">Taza Cerámica Mágica ($35.000 COP)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Texto o Estampado Custom</label>
                <input type="text" name="texto_custom" id="text-custom-field" oninput="updateCustomText()" placeholder="Escribe tu frase o nombre..." class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs focus:outline-none focus:border-dass-burgundy">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Adjuntar Imagen o Logo</label>
                <input type="file" accept="image/*" onchange="updateCustomImage(event)" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-dass-burgundy file:text-white">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Color Seleccionado</label>
                    <input type="text" name="color" id="selected-color-name" value="Borgoña Boutique" readonly class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs bg-gray-50">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Talla / Capacidad</label>
                    <select name="talla" class="w-full px-4 py-2.5 rounded-xl border border-pink-100 text-xs">
                        <option value="S">S / 11 oz</option>
                        <option value="M" selected>M / 15 oz</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <span class="text-[10px] text-gray-400 uppercase block">Total</span>
                    <span id="price-display-val" class="font-bold text-dass-burgundy text-xl">$65.000 COP</span>
                    <input type="hidden" name="precio" id="price-hidden-input" value="65000">
                </div>

                <button type="submit" class="bg-dass-burgundy text-white text-xs font-bold px-6 py-3.5 rounded-full shadow hover:bg-opacity-90 transition">
                    🛒 Agregar al Carrito
                </button>
            </div>
        </form>
    </div>
</main>

<script>
function setItemColor(hexColor, nameColor) {
    document.getElementById('svg-product-camiseta').style.color = hexColor;
    document.getElementById('svg-product-taza').style.color = hexColor;
    document.getElementById('selected-color-name').value = nameColor;
}

function updateCustomText() {
    document.getElementById('custom-text-preview').innerText = document.getElementById('text-custom-field').value;
}

function updateCustomImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const img = document.getElementById('custom-img-preview');
        img.src = reader.result;
        img.classList.remove('hidden');
    }
    if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
}

function switchItemSvg() {
    const select = document.getElementById('item-type-select');
    const option = select.options[select.selectedIndex];
    const type = option.getAttribute('data-svg');
    const price = option.getAttribute('data-price');

    if (type === 'taza') {
        document.getElementById('svg-product-camiseta').classList.add('hidden');
        document.getElementById('svg-product-taza').classList.remove('hidden');
    } else {
        document.getElementById('svg-product-taza').classList.add('hidden');
        document.getElementById('svg-product-camiseta').classList.remove('hidden');
    }

    document.getElementById('price-display-val').innerText = '$' + parseInt(price).toLocaleString('es-CO') + ' COP';
    document.getElementById('price-hidden-input').value = price;
}
</script>