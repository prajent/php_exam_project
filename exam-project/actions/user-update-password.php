<?php

if ($_POST['password']) {
    //login
    require_once __DIR__.'/../classes/User.php';

    $loggedInUser = getLoggedInUser();
    $password     = $_POST['password'];

    $user = new \classes\User();

    $user->setLoggedInUser($loggedInUser);

    $user->updatePassword($password);
    $_SESSION['success'] = 'Password updated successfully';

    header('Location:/profile');
    exit();

}

$_SESSION['password_error'] = 'PLEASE FILL OUT ALL FIELDS';
header('Location:/profile');
exit();
