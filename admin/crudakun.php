<?php require('../koneksi.php');
require('../query.php');

session_start();
$_crud = new crud();

if (isset($_POST['tambah'])) {
    tambah($_crud);
} else if (isset($_POST['edit'])) {
    edit($_crud);
} else if (isset($_POST['hapus'])) {
    hapus($_crud);
}

function tambah($crud)
{
    $email = $_POST['txt_email'];
    $password = md5($_POST['txt_password']);
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

        $crud->execute("INSERT INTO user_detail VALUES (null, '$email', '$password', '$nfullname', $roles)");

        if (isset($_GET['register'])) {
            header('Location: login.php');
        } else {
            $_SESSION['flashData'] = 'Tambah Data Berhasil';    
            header('Location: dashboard.php');
        }
    }
}

function edit($crud)
{
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
    $crud->execute($query);

    $_SESSION['flashData'] = 'Ubah data Berhasil';

    header('Location: dashboard.php');
}

function hapus($crud)
{
    $id = $_GET['id'];

    $query = "DELETE FROM user_detail WHERE id = '$id'";
    $crud->execute($query);
    $_SESSION['flashData'] = 'Hapus Data Berhasil';

    header('Location: dashboard.php');
}
