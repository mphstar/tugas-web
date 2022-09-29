<?php require('koneksi.php');

if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM user_detail WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    header('Location: dashboard.php');
}
