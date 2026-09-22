<main class="max-w-4xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white/80 backdrop-blur-md p-8 rounded-3xl border border-dass-rose/60 shadow-xl">
        
        <!-- VISOR NATIVO CON SILUETAS SVG -->
        <div class="space-y-3">
            <div class="relative w-full h-96 rounded-2xl border border-pink-100 flex items-center justify-center bg-gray-50 overflow-hidden shadow-inner p-4">
                
                <!-- SVG Dinámico de la Prenda -->
                <div class="relative w-72 h-80 flex items-center justify-center">
                    <!-- Vector Silueta -->
                    <svg id="shirt-svg" viewBox="0 0 100 100" class="w-full h-full drop-shadow-md transition-colors duration-300" style="fill: #4A1525;">
                        <!-- Cuello Redondo (Predeterminado) -->
                        <path id="shirt-path" d="M30 20 L40 25 Q50 28 60 25 L70 20 L85 30 L75 40 L70 35 L70 85 L30 85 L30 35 L25 40 L15 30 Z" />
                    </svg>

                    <!-- Zona de Estampado del Pecho -->
                    <div id="stamp-zone" class="absolute top-28 w-24 h-28 border-2 border-dashed border-white/60 rounded flex items-center justify-center overflow-hidden pointer-events-none shadow-sm">
                        <img id="user-stamp-preview" src="" class="max-w-full max-h-full object-contain hidden">
                        <span id="stamp-placeholder" class="text-[9px] text-white/80 font-medium text-center px-1">Tu Diseño</span>
                    </div>
                </div>

            </div>
            <p class="text-[11px] text-center text-gray-400">Previsualización vectorial interactiva en tiempo real</p>
        </div>

        <!-- FORMULARIO DE PERSONALIZACIÓN -->
        <form action="/dasshop/carrito/agregar" method="POST" enctype="multipart/form-data" class="space-y-5">
            <input type="hidden" name="id" value="1">
            <input type="hidden" name="nombre" value="Camiseta Personalizada">
            <input type="hidden" name="precio" value="45000">
            <input type="hidden" name="imagen" value="https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=800&auto=format&fit=crop">

            <div>
                <h1 class="font-serif text-2xl font-bold text-dass-burgundy">Camiseta Personalizada</h1>
                <p class="text-sm font-bold text-gray-800 mt-1">$45.000 COP</p>
            </div>

            <!-- 1. Tipo de Corte / Cuello -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Tipo de Corte / Cuello:</label>
                <select id="corte-select" name="corte" required class="w-full text-xs p-3 rounded-xl border border-gray-200 focus:outline-none focus:border-dass-burgundy bg-white">
                    <option value="Cuello Redondo (Oversize)">Cuello Redondo (Oversize)</option>
                    <option value="Cuello en V">Cuello en V</option>
                    <option value="Esqueleto / Tank Top">Esqueleto / Tank Top</option>
                </select>
            </div>

            <!-- 2. Seleccionar Color -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Color de la prenda:</label>
                <div class="flex items-center gap-3">
                    <input type="color" id="color-picker" name="color" value="#4A1525" 
                           class="w-10 h-10 rounded-full border border-gray-300 cursor-pointer shadow-sm">
                    <span id="color-hex" class="text-xs font-mono font-semibold text-gray-600">#4A1525</span>
                </div>
            </div>

            <!-- 3. Adjuntar Diseño -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Adjunta tu diseño o imagen:</label>
                <input type="file" id="file-input" name="estampado" accept="image/*"
                       class="w-full text-xs p-2 rounded-xl border border-gray-200 bg-white">
            </div>

            <button type="submit" class="w-full bg-dass-burgundy text-white text-xs font-medium py-3.5 rounded-full shadow-lg hover:bg-opacity-95 transition">
                Agregar al Carrito
            </button>
        </form>
    </div>
</main>

<script>
    // Moldes de corte en formato vectorial SVG (Path)
    const siluetas = {
        "Cuello Redondo (Oversize)": "M30 20 L40 25 Q50 28 60 25 L70 20 L85 30 L75 40 L70 35 L70 85 L30 85 L30 35 L25 40 L15 30 Z",
        "Cuello en V": "M30 20 L40 25 L50 35 L60 25 L70 20 L85 30 L75 40 L70 35 L70 85 L30 85 L30 35 L25 40 L15 30 Z",
        "Esqueleto / Tank Top": "M33 20 L40 25 Q50 28 60 25 L67 20 L73 35 L68 38 L68 85 L32 85 L32 38 L27 35 Z"
    };

    // 1. Cambiar el Tinte Directo del SVG
    const colorPicker = document.getElementById('color-picker');
    const shirtSvg = document.getElementById('shirt-svg');
    const colorHex = document.getElementById('color-hex');

    colorPicker.addEventListener('input', (e) => {
        const hex = e.target.value;
        shirtSvg.style.fill = hex;
        colorHex.textContent = hex.toUpperCase();
    });

    // 2. Cambiar la Silueta / Corte
    const corteSelect = document.getElementById('corte-select');
    const shirtPath = document.getElementById('shirt-path');

    corteSelect.addEventListener('change', (e) => {
        const selectedCorte = e.target.value;
        if (siluetas[selectedCorte]) {
            shirtPath.setAttribute('d', siluetas[selectedCorte]);
        }
    });

    // 3. Previsualizar Imagen Cargada
    const fileInput = document.getElementById('file-input');
    const userStampPreview = document.getElementById('user-stamp-preview');
    const stampPlaceholder = document.getElementById('stamp-placeholder');

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                userStampPreview.src = event.target.result;
                userStampPreview.classList.remove('hidden');
                stampPlaceholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>