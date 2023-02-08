<?php
isAdmin();

require_once __DIR__.'/../classes/User.php';


$user = new \classes\User();


$user->delete($id);

header('Location:/admin/dashboard');


