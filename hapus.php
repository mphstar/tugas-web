<?php require('koneksi.php');
require('query.php');

session_start();

$_crud = new crud();

if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM user_detail WHERE id = '$id'";
    $result = $_crud->execute($query);
    $_SESSION['flashData'] = 'Hapus Data Berhasil';

    header('Location: dashboard.php');
}
