<?php require('koneksi.php');

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];

    if (!empty(trim($email)) && !empty(trim($password))) {
        $query = "SELECT * FROM user_detail WHERE email = '$email'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $emailval = $row['email'];
            $passwordval = $row['password'];
            $level = $row['level'];
        }
        if ($num != 0) {
            if ($emailval == $email && $passwordval == md5($password)) {
                header('Location: dashboard.php');
            } else {
                $error = 'Email atau password salah';
                header('Location: login.php');
            }
        } else {
            $error = 'User tidak ditemukan';
            header('Location: login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body class="home-bg">
    <div class="col">
        <div id="auth" class="">

            <div class="home-container">
                <div class="col-lg col-12">
                    <div id="auth-left">

                        <h1 class="auth-title">Log in.</h1>
                        <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                        <form action="login.php" method="POST">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="txt_email" class="form-control form-control-xl" placeholder="Username">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" name="txt_password" class="form-control form-control-xl" placeholder="Password">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="form-check form-check-lg d-flex align-items-end">
                                <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                    Keep me logged in
                                </label>
                            </div>
                            <button name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                        </form>
                        <div class="text-center mt-5 text-lg fs-4">
                            <p class="text-gray-600">Don't have an account? <a href="register.php" class="font-bold">Sign
                                    up</a>.</p>
                            <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




</body>

</html>