<?php

$user = getLoggedInUser();

if (!empty($user)) {
    header('Location:profile');
}