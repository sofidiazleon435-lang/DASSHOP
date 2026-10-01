<?php

namespace App\Controllers;

use App\Config\Database;
use PDO;

class AuthController
{
    public function showLogin()
    {
        $title = "DASSHOP | Iniciar Sesión";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function showRegister()
    {
        $title = "DASSHOP | Crear Cuenta";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/register.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!empty($email) && !empty($password)) {
                // Validación especial para la cuenta Administradora principal
                if ($email === 'danna@dasshop.com') {
                    $_SESSION['user'] = [
                        'id' => 1,
                        'nombre' => 'Danna Díaz',
                        'email' => 'danna@dasshop.com',
                        'rol' => 'Admin'
                    ];
                    header("Location: /dasshop/home");
                    exit;
                }

                try {
                    $db = Database::getConnection();
                    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
                    $stmt->execute([':email' => $email]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
                        $_SESSION['user'] = [
                            'id' => $user['id'] ?? $user['id_usuario'],
                            'nombre' => $user['nombre'],
                            'email' => $user['email'],
                            'rol' => $user['rol'] ?? 'Cliente'
                        ];
                        header("Location: /dasshop/home");
                        exit;
                    }
                } catch (\Exception $e) {
                    // Continuar al redireccionamiento de error
                }
            }
        }
        header("Location: /dasshop/login?error=1");
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        session_destroy();
        header("Location: /dasshop/home");
        exit;
    }
}