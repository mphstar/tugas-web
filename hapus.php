<?php require('koneksi.php');
require('query.php');

$_crud = new crud();

if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM user_detail WHERE id = '$id'";
    $result = $_crud->execute($query);

    header('Location: dashboard.php');
}
