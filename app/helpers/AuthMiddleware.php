<?php
namespace App\Helpers;

class AuthMiddleware {
    
    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public static function getUser() {
        if (self::check()) {
            return [
                'id' => $_SESSION['user_id'],
                'nombre' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'role' => $_SESSION['user_role']
            ];
        }
        return null;
    }
}