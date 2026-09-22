<?php

namespace App\Controllers;

class UserController
{
    // READ - Listar usuarios
    public function index()
    {
        // TODO: Reemplazar por consulta a BD (ej. $users = User::all();)
        $users = $_SESSION['users_db'] ?? [
            ['id' => 1, 'nombre' => 'Danna Díaz', 'email' => 'danna@dasshop.com', 'rol' => 'Admin'],
            ['id' => 2, 'nombre' => 'Cliente Ejemplo', 'email' => 'cliente@correo.com', 'rol' => 'Cliente']
        ];

        $title = "DASSHOP | Gestión de Usuarios";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/users/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // CREATE - Guardar nuevo usuario
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuevo = [
                'id' => time(),
                'nombre' => trim($_POST['nombre'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'rol' => $_POST['rol'] ?? 'Cliente'
            ];

            if (!isset($_SESSION['users_db'])) {
                $_SESSION['users_db'] = [
                    ['id' => 1, 'nombre' => 'Danna Díaz', 'email' => 'danna@dasshop.com', 'rol' => 'Admin']
                ];
            }

            $_SESSION['users_db'][] = $nuevo;
            header('Location: /dasshop/usuarios');
            exit;
        }
    }

    // DELETE - Eliminar usuario
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id && isset($_SESSION['users_db'])) {
            $_SESSION['users_db'] = array_filter($_SESSION['users_db'], function ($u) use ($id) {
                return $u['id'] != $id;
            });
        }
        header('Location: /dasshop/usuarios');
        exit;
    }
}