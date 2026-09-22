<?php
namespace App\Controllers;

class ProductController {
    
    private function getProductsList() {
        return [
            1 => [
                'id' => 1,
                'nombre' => 'Camiseta Oversize Minimalista',
                'categoria' => 'Prendas',
                'precio' => 45000,
                'descripcion' => 'Algodón premium listo para tu estampado personalizado.',
                'imagen' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=800&auto=format&fit=crop'
            ],
            2 => [
                'id' => 2,
                'nombre' => 'Llavero Grabado en Madera',
                'categoria' => 'Accesorios',
                'precio' => 18000,
                'descripcion' => 'Llavero de madera personalizado con frases y grabados especiales.',
                'imagen' => 'https://images.unsplash.com/photo-1622434641406-a158123450f9?q=80&w=800&auto=format&fit=crop'
            ],
            3 => [
                'id' => 3,
                'nombre' => 'Set de Libretas & Escritorio',
                'categoria' => 'Papelería y Decoración',
                'precio' => 32000,
                'descripcion' => 'Libretas argolladas y de pasta dura en tonos vibrantes para tu espacio.',
                'imagen' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=800&auto=format&fit=crop'
            ],
            4 => [
                'id' => 4,
                'nombre' => 'Mug Cerámico Personalizado',
                'categoria' => 'Hogar',
                'precio' => 25000,
                'descripcion' => 'Taza con ilustración floral delicada y nombre personalizado.',
                'imagen' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=800&auto=format&fit=crop'
            ]
        ];
    }

    public function index() {
        $title = "DASSHOP | Catálogo de Productos";
        $products = $this->getProductsList();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/products/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function detail($id = 1) {
        $title = "DASSHOP | Detalle del Producto";
        $products = $this->getProductsList();
        
        $product = $products[$id] ?? $products[1];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/products/detail.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}