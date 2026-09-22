<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT u.*, r.nombre as role_nombre FROM usuarios u JOIN roles r ON u.role_id = r.id WHERE u.email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO usuarios (role_id, nombre, apellido, email, password, telefono, direccion, ciudad) 
                VALUES (:role_id, :nombre, :apellido, :email, :password, :telefono, :direccion, :ciudad)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':role_id'   => $data['role_id'] ?? 2, // 2 = Cliente
            ':nombre'    => $data['nombre'],
            ':apellido'  => $data['apellido'],
            ':email'     => $data['email'],
            ':password'  => password_hash($data['password'], PASSWORD_DEFAULT),
            ':telefono'  => $data['telefono'] ?? null,
            ':direccion' => $data['direccion'] ?? null,
            ':ciudad'    => $data['ciudad'] ?? null
        ]);
    }
}