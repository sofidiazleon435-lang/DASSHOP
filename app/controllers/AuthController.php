<?php

namespace App\Controllers;

class AuthController
{
    // Mostrar u procesar el inicio de sesión
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // TODO: Aquí debes validar credenciales con tu base de datos MySQL
            // Ejemplo de asignación de sesión con el nombre real obtenido de la BD:
            $_SESSION['user'] = [
                'nombre' => $_POST['nombre'] ?? explode('@', $email)[0] ?? 'Usuario',
                'email' => $email
            ];

            header('Location: /dasshop/home');
            exit;
        }

        $title = "DASSHOP | Iniciar Sesión";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Procesar el registro de usuario
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Guardar nombre limpio en la sesión activa
            $_SESSION['user'] = [
                'nombre' => !empty($nombre) ? $nombre : 'Usuario',
                'email' => $email
            ];

            header('Location: /dasshop/home');
            exit;
        }

        $title = "DASSHOP | Registro";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/register.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Cerrar sesión
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /dasshop/home');
        exit;
    }
}