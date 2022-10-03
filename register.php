

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body class="home-bg">

    <div id="auth">
        <div class="home-container">
            <div class="col-lg col-12">
                <div id="auth-left">

                    <h1 class="auth-title">Sign Up.</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

                    <form action="tambah.php?register=processtambah" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input required type="text" class="form-control form-control-xl" name="txt_name" placeholder="Fullname">
                            <div class="form-control-icon">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input required type="text" class="form-control form-control-xl" name="txt_email" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input required type="password" class="form-control form-control-xl" name="txt_password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Already have an account? <a href="login.php" class="font-bold">Login</a>.</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>


        </div>
    </div>

</body>

</html>