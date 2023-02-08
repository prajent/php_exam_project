<?php
if ($_POST['password']) {
    //login
    require_once __DIR__.'/../classes/User.php';

    $loggedInUser = getLoggedInUser();
    $password     = $_POST['password'];

    $user = new \classes\User();

    $user->setLoggedInUser($loggedInUser);

    $isDeleted = $user->deleteUser($password);

    if ($isDeleted) {
        $user->logout();
        exit();
    }
}

$_SESSION['delete_error'] = "INVALID PASSWORD";
header('Location:/profile');
exit();


