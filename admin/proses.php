<?php
require('../koneksi.php');
require('../query.php');

session_start();

$_crud = new crud();

if (isset($_POST['submit'])) {
    $limit = 10 * 1024 * 1024;
    $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
    $jumlahFile = count($_FILES['foto']['name']);
    for ($x = 0; $x < $jumlahFile; $x++) {
        $namafile = $_FILES['foto']['name'][$x];
        $tmp = $_FILES['foto']['tmp_name'][$x];
        $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        $ukuran = $_FILES['foto']['size'][$x];
        if ($ukuran > $limit) {
            $_SESSION['flashDataError'] = 'Ukuran Melebihi Batas';
            header("location:multiple_upload.php");
        } else {
            if (!in_array($tipe_file, $ekstensi)) {
                $_SESSION['flashDataError'] = 'Ekstensi File Tidak Sesuai';
                header("Location: multiple_upload.php");
            } else {
                move_uploaded_file($tmp, '../uploads/' . date('d-m-Y') . '-' . $namafile);
                
                $_crud->execute("INSERT INTO image VALUES(NULL, '".date('d-m-Y') . '-' . $namafile."')");

                $_SESSION['flashData'] = 'Upload Berhasil';
                header("Location: multiple_upload.php");
            }
        }
    }
}
