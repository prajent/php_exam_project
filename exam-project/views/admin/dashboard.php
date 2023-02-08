<?php
isAdmin();

require_once __DIR__.'/../../classes/User.php';

$user  = new \classes\User();
$users = $user->getAllUsers();

?>

<html lang="en">
<head>
    <title>Profile</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<body class="bg-light">
<div>
    <div class="container-xl px-4 mt-4" style="margin-bottom: 100px;">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex justify-content-end collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="d-flex navbar-nav  mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="/logout" method="post" class="m-0 dropdown-item"
                                          style="margin-block-end: 0">
                                        <?php set_csrf(); ?>
                                        <button type="submit" class="btn text m-0 p-0"> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- Account page navigation-->
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header bg-white">Users</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Profile Picture</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?php out($user['id']); ?></td>
                                    <td><?php out($user['first_name']); ?></td>
                                    <td><?php out($user['last_name']); ?></td>
                                    <td><?php out($user['email']); ?></td>
                                    <td><?php if ($user['profile_picture']) { ?>
                                            <img src="/<?php out($user['profile_picture']) ?>" class="rounded-circle"
                                                 width="50px"
                                                 height="50px" alt="">
                                        <?php } ?></td>
                                    <td>
                                        <a href="/admin/delete/<?php out($user['id']) ?>" class="btn btn-danger">DELETE</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>