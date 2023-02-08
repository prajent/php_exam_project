<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['email'] && $_POST['password']) {

        require_once __DIR__.'/../config.php';

        $adminEmail    = $adminConfig['email'];
        $adminPassword = $adminConfig['password'];

        $email    = $_POST['email'];
        $password = $_POST['password'];

        if ($email === $adminEmail && $password === $adminPassword) {
            $_SESSION['isAdminUser'] = true;
            header('Location:/admin/dashboard');
            exit();
        }

    }

    $_SESSION['login_error'] = 'INVALID CREDENTIALS';
    header('Location:/admin/login');
    exit();
}



