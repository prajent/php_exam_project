<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['email'] && $_POST['last_name'] && $_POST['first_name']) {
        //login
        require_once __DIR__.'/../classes/User.php';

        $loggedInUser = getLoggedInUser();

        $user = new \classes\User();

        $email     = $_POST['email'];
        $firstName = $_POST['first_name'];
        $lastName  = $_POST['last_name'];

        $user->setLoggedInUser($loggedInUser);
        $user->update($email, $firstName, $lastName);

        if ($_FILES['profile_picture']['tmp_name']) {
            $user->uploadProfilePicture($_FILES['profile_picture']);
        }


        //REGISTER SUCCESS
        header('Location:/profile');
        exit();

    }

    $_SESSION['register_error'] = 'PLEASE FILL OUT ALL FIELDS';
    header('Location:/profile');
    exit();
}
