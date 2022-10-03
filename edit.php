<?php require('koneksi.php');
require('query.php');

session_start();

$_crud = new crud();

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $email = $_POST['txt_email'];
    $fullname = $_POST['txt_name'];
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
    }

    $query = "UPDATE user_detail SET email = '$email', fullname = '$fullname', level = '$roles' WHERE id = '$id'";
    $result = $_crud->execute($query);

    $_SESSION['flashData'] = 'Ubah data Berhasil';

    header('Location: dashboard.php');
}
