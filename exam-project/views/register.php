<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card" style="width: 500px;">
        <div class="card-body p-4">
            <h1 class="mb-4 fw-light">Register</h1>
            <form action="/register" method="post">
                <?php set_csrf(); ?>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <?php if (isset($_SESSION['register_error'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['register_error'];
                        unset($_SESSION['register_error']) ?>
                    </div>
                <?php } ?>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a class="ms-2" href="/login">
                        Or Login
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>