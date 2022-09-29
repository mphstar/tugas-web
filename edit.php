<?php require('koneksi.php');
require('query.php');

$_crud = new crud();

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];
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

    if (!empty(trim($email)) && !empty(trim($password))) {
        $query = "UPDATE user_detail SET email = '$email', fullname = '$fullname', password = '".md5($password)."', level = '$roles' WHERE id = '$id'";
        $result = $_crud->execute($query);

        header('Location: dashboard.php');
    }
}
