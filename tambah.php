<?php require('koneksi.php');


if (isset($_POST['submit'])) {
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];
    $nfullname = $_POST['txt_name'];
    $roles = 2;

    if (isset($_POST['txt_roles'])) {
        $roles = $_POST['txt_roles'];
        switch ($roles) {
            case 'Admin':
                $roles = 1;
                break;
            case 'User':
                $roles = 2;
                break;
            default:
                break;
                $roles = 2;
        }
    }
    if (!empty(trim($email)) && !empty(trim($password))) {
        $query = "INSERT INTO user_detail VALUES (null, '$email', '" . md5($password) . "', '$nfullname', $roles)";
        $result = mysqli_query($koneksi, $query);

        if (isset($_GET['register'])) {
            header('Location: login.php');
        } else {
            header('Location: dashboard.php');
        }
    }
}
