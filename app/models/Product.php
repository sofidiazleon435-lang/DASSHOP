<?php
namespace App\Controllers;

class ProductController {
    
    // Método para mostrar el catálogo completo
    public function index() {
        $title = "DASSHOP | Catálogo de Productos";
        
        // Simulación de productos de la base de datos
        $products = [
            [
                'id' => 1,
                'nombre' => 'Camiseta Oversize Minimalista',
                'categoria' => 'Prendas',
                'precio' => 45000,
                'descripcion' => 'Algodón premium listo para tu estampado personalizado.',
                'imagen' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'id' => 2,
                'nombre' => 'Mug Cerámico Pastel',
                'categoria' => 'Accesorios',
                'precio' => 25000,
                'descripcion' => 'Resistente al microondas con acabado mate suave.',
                'imagen' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'id' => 3,
                'nombre' => 'Funda Ilustrada Antishock',
                'categoria' => 'Tecnología',
                'precio' => 35000,
                'descripcion' => 'Protección alta con grabado de alta resolución.',
                'imagen' => 'https://images.unsplash.com/photo-1601593378480-f03495d43c22?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'id' => 4,
                'nombre' => 'Retrato Canvas Personalizado',
                'categoria' => 'Hogar',
                'precio' => 60000,
                'descripcion' => 'Impresión artística en lienzo con marco de madera.',
                'imagen' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?q=80&w=800&auto=format&fit=crop'
            ]
        ];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/products/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Método para ver un producto individual
    public function detail($id = null) {
        $title = "DASSHOP | Detalle del Producto";
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/products/detail.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}