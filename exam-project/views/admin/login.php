<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container min-vh-100 d-flex justify-content-center align-items-center ">
    <div class="card " style="width: 500px;">
        <div class="card-body p-4">
            <h1 class="mb-4 fw-light">Admin Login</h1>
            <form action="/admin/login" method="post">
                <?php set_csrf(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control"
                           placeholder="Email"
                           required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Password" required>
                </div>
                <?php if (isset($_SESSION['login_error'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['login_error'];
                        unset($_SESSION['login_error']); ?>
                    </div>
                <?php } ?>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>