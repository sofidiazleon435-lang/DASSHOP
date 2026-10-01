<?php

namespace App\Controllers;

use App\Config\Database;
use PDO;

class UserController
{
    // Verificación flexible de seguridad para el Administrador
    private function checkAdmin()
    {
        $userName = '';
        $userRol = '';

        if (isset($_SESSION['user'])) {
            if (is_array($_SESSION['user'])) {
                $userName = $_SESSION['user']['nombre'] ?? $_SESSION['user']['name'] ?? '';
                $userRol = $_SESSION['user']['rol'] ?? '';
            } else {
                $userName = $_SESSION['user'];
            }
        }

        $isAdmin = (
            strtolower(trim($userRol)) === 'admin' || 
            strtoupper(trim($userName)) === 'ADMIN' || 
            strtoupper(trim($userName)) === 'DASSHOP'
        );

        if (!$isAdmin) {
            header('Location: /dasshop/home');
            exit;
        }
    }

    // READ - Listar usuarios
    public function index()
    {
        $this->checkAdmin();

        try {
            $db = Database::getConnection();
            $stmt = $db->query("SELECT id, nombre, email, rol FROM usuarios ORDER BY id DESC");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $users = [];
        }

        $title = "DASSHOP | Gestión de Usuarios";
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/users/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // CREATE - Guardar usuario desde el panel admin con Hash BCRYPT
    public function store()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $rol = $_POST['rol'] ?? 'Cliente';
            $password = $_POST['password'] ?? '123456';

            if (!empty($nombre) && !empty($email)) {
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);

                try {
                    $db = Database::getConnection();
                    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)");
                    $stmt->execute([
                        ':nombre' => $nombre,
                        ':email' => $email,
                        ':password' => $passwordHash,
                        ':rol' => $rol
                    ]);
                } catch (\PDOException $e) {
                    // Manejo de error si el email se encuentra duplicado
                }
            }
            header('Location: /dasshop/usuarios');
            exit;
        }
    }

    // DELETE - Eliminar usuario
    public function delete()
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("DELETE FROM usuarios WHERE id = :id");
                $stmt->execute([':id' => $id]);
            } catch (\PDOException $e) {
                // Manejo de error si no se puede eliminar
            }
        }
        header('Location: /dasshop/usuarios');
        exit;
    }
}