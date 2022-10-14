<?php require('koneksi.php');
require('query.php');


session_start();

$_crud = new crud();

function checkRoles($roles)
{
    switch ($roles) {
        case '1':
            return 'admin';
            break;
        case '2':
            return 'user';
            break;
        default:
            break;
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];

    if (!empty(trim($email)) && !empty(trim($password))) {
        $query = "SELECT * FROM user_detail WHERE email = '$email'";
        $result = $_crud->execute($query);
        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $emailval = $row['email'];
            $passwordval = $row['password'];
            $fullname = $row['fullname'];
            $level = checkRoles($row['level']);
        }
        if ($num != 0) {
            if ($emailval == $email && $passwordval == md5($password)) {
                setcookie('id', $id, time() + (60 * 30 * 1 * 1), '/');
                setcookie('email', $emailval, time() + 60 * 30 * 1 * 1, '/');
                setcookie('password', $passwordval, time() + 60 * 30 * 1 * 1, '/');
                setcookie('fullname', $fullname, time() + 60 * 30 * 1 * 1, '/');
                setcookie('roles', $level, time() + 60 * 30 * 1 * 1, '/');

                $_SESSION['id'] = $id;
                $_SESSION['email'] = $emailval;
                $_SESSION['password'] = $passwordval;
                $_SESSION['roles'] = $level;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['flashLogin'] = 'yes';
                
                header('Location: index.php');

            } else {
                $error = 'Email atau password salah';

                header('Location: login.php?error&email=' . $email);
            }
        } else {
            $error = 'User tidak ditemukan';

            header('Location: login.php?error&email=' . $email);
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
    <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css">
</head>

<body class="home-bg">
    <div class="col">
        <div id="auth" class="">

            <div class="home-container">
                <div class="col-lg col-12">
                    <div id="auth-left">

                        <h1 class="auth-title">Log in.</h1>
                        <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                        <form action="login.php" method="POST" data-parsley-validate>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="txt_email" id="first-name-column" value="<?php if (isset($_GET['error'])) {
                                                                                                        echo $_GET['email'];
                                                                                                    } else {
                                                                                                        echo '';
                                                                                                    } ?>" data-parsley-required="true" class="form-control form-control-xl" placeholder="Username">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" name="txt_password" class="form-control form-control-xl" data-parsley-required="true" placeholder="Password">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="form-check form-check-lg d-flex align-items-start">
                                <p style="color:red"><?php if (isset($_GET['msg'])) {
                                                            echo 'Anda harus login terlebih dahulu';
                                                        } else {
                                                            echo '';
                                                        } ?></p>
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
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="assets/js/pages/parsley.js"></script>

    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>>
    <script src="assets/js/pages/sweetalert2.js"></script>>

    <?php if (isset($_GET['error'])) {
    ?> <script>
            Swal.fire(
                'Gagal',
                'Username atau password salah',
                'error'
            )
        </script><?php
                } ?>


</body>

</html>