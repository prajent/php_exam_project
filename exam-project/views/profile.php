<?php
$user = getLoggedInUser();

$name = $user['first_name'].' '.$user['last_name'];
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
                <a class="navbar-brand" href="#">User</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Home</a>
                        </li>
                    </ul>
                    <ul class="d-flex navbar-nav  mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <?php if ($user['profile_picture']) { ?>
                                    <img src="<?php out($user['profile_picture']) ?>" class="rounded-circle"
                                         width="50px"
                                         height="50px" alt="">
                                <?php } else { ?>
                                    <?php out($name);
                                } ?>


                            </a>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item">
                                        <?php out($name) ?>
                                    </span></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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
                    <div class="card-header bg-white">Account Details</div>
                    <div class="card-body">
                        <form method="post"
                              action="/user/update"
                              enctype="multipart/form-data">
                            <?php set_csrf() ?>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email address</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                           placeholder="Enter your email address"
                                           value="<?php out($user['email']) ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text"
                                           placeholder="Enter your First Name"
                                           value="<?php out($user['first_name']) ?>"
                                    >
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="last_name">Last Name</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text"
                                           placeholder="Enter your First Name"
                                           value="<?php out($user['last_name']) ?>"
                                    >
                                </div>
                            </div>

                            <!-- Form Group (profile picture)-->
                            <div class="mb-4">
                                <div>
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input class="form-control" id="profile_picture" name="profile_picture"
                                           type="file">
                                </div>

                                <?php if ($user['profile_picture']) { ?>
                                    <div class="mt-3 mb-3" style="width: 240px;">
                                        <img class="ratio ratio-1x1 rounded-circle overflow-hidden" width="240px"
                                             height="240px"
                                             src="<?php out($user['profile_picture']) ?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Save changes button-->
                            <input class="btn btn-primary" type="submit">
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header bg-white">Change Password</div>
                    <div class="card-body">
                        <form method="post"
                              action="/user/update-password"
                        >
                            <?php set_csrf() ?>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" type="password" name="password"
                                           placeholder="Enter your new password">
                                </div>

                                <?php if (isset($_SESSION['password_error'])) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['password_error'];
                                        unset($_SESSION['password_error']) ?>
                                    </div>
                                <?php } ?>

                                <?php if (isset($_SESSION['success'])) { ?>
                                    <div class="alert alert-success">
                                        <?php echo $_SESSION['success'];
                                        unset($_SESSION['success']) ?>
                                    </div>
                                <?php } ?>

                                <!-- Save changes button-->
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header bg-white">Delete User</div>
                    <div class="card-body">
                        <form method="post"
                              action="/user/delete"
                        >
                            <?php set_csrf() ?>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" type="password" name="password"
                                           placeholder="Enter your new password">
                                </div>

                                <?php if (isset($_SESSION['delete_error'])) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['delete_error'];
                                        unset($_SESSION['delete_error']) ?>
                                    </div>
                                <?php } ?>


                                <!-- Save changes button-->
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </div>
                        </form>
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




