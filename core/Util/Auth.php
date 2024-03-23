<?php

namespace Core\Util;

use JetBrains\PhpStorm\NoReturn;

class Auth
{
    private const USERNAME = 'admin';
    private const PASSWORD = 'tda';

    #[NoReturn]
    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: /admin');
        exit;
    }

    public static function authenticateBasic(): bool
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            return false;
        }
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];
        if ($username === self::USERNAME && $password === self::PASSWORD){
            $_SESSION['logged_in'] = true;
            return true;
        }
        return false;
    }


    public static function requireLogin(): void
    {
        if (!self::isLoggedIn()) {
            header('Location: /admin');
            exit;
        }
    }

    public static function isLoggedIn(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['logged_in'] = true;
    }
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}