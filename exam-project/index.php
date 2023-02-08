<?php

require_once __DIR__.'/router.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !is_csrf_valid()) {
    header('Location:/419');
    exit();
}

require_once __DIR__.'/routes.php';

function getLoggedInUser()
{
    if (!$_SESSION['userId'] || $_SESSION['isAdminUser']) {
        header('Location:/login');
        session_destroy();
        exit();
    }
    require_once __DIR__.'/classes/User.php';

    $loggedInUserId = $_SESSION['userId'];

    $user         = new \classes\User();
    $loggedInUser = $user->getUserById($loggedInUserId);

    return $loggedInUser;


}


function isAlreadyLoggedIn()
{
    if ($_SESSION['userId']) {
        header('Location:/profile');
        exit();
    }
}

function isAdmin()
{
    if (!$_SESSION['isAdminUser']) {
        header('Location:/login');
        session_destroy();
        exit();
    }
    return true;

}


