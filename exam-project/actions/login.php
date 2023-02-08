<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['email'] && $_POST['password']) {
        //login
        require_once __DIR__.'/../classes/User.php';

        $user = new \classes\User();

        $email    = $_POST['email'];
        $password = $_POST['password'];

        $loginSuccess = $user->tryToLogin($email, $password);

        if ($loginSuccess) {
            //LOGIN SUCCESS
            header('Location:/profile');
            exit();

        }
    }

    $_SESSION['login_error'] = 'INVALID CREDENTIALS';
    header('Location:/login');
    exit();
}



