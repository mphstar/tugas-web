<?php require('koneksi.php');
require('query.php');

session_start();

$_crud = new crud();
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
        
        $result = $_crud->execute("INSERT INTO user_detail VALUES (null, '$email', '" . md5($password) . "', '$nfullname', $roles)");

        if (isset($_GET['register'])) {
            header('Location: login.php');
        } else {
            $_SESSION['flashData'] = 'Tambah Data Berhasil';
            header('Location: dashboard.php');
        }
    }
}
