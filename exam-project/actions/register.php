<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['email'] && $_POST['password'] && $_POST['last_name'] && $_POST['first_name']) {
        //login
        require_once __DIR__.'/../classes/User.php';

        $user = new \classes\User();

        $email     = $_POST['email'];
        $password  = $_POST['password'];
        $firstName = $_POST['first_name'];
        $lastName  = $_POST['last_name'];

        $user->register($email, $password, $firstName, $lastName);

        //REGISTER SUCCESS
        header('Location:/login');
        exit();

    }

    $_SESSION['register_error'] = 'PLEASE FILL OUT ALL FIELDS';
    header('Location:/register');
    exit();
}



