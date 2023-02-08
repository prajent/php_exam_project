<?php


// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'views/index.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
get('/login', 'views/login.php');
post('/login', 'actions/login.php');

post('/logout', 'actions/logout.php');

get('/register', 'views/register.php');
post('/register', 'actions/register.php');

post('/user/update', 'actions/user-update.php');

post('/user/update-password', 'actions/user-update-password.php');
post('/user/delete', 'actions/user-delete.php');


get('/profile', 'views/profile.php');

get('/admin/login', 'views/admin/login.php');
post('/admin/login', 'actions/admin-login.php');

get('/admin/dashboard', 'views/admin/dashboard.php');
get('/admin/delete/$id', 'actions/admin-user-delete.php');


//get('/user/$name/$lastname', 'views/full_name.php');


// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/419', 'views/419.php');
any('/404', 'views/404.php');