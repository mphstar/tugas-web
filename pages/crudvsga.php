<?php require('../koneksi.php');
require('../query.php');

session_start();
$_crud = new crud();

if (isset($_POST['tambah'])) {
    tambah($_crud);
} else if (isset($_POST['edit'])) {
    edit($_crud);
} else if(isset($_POST['hapus'])){
    hapus($_crud);
}

function tambah($crud)
{
    $nama = $_POST['txt_nama'];
    $tgllahir = $_POST['txt_tgl'];
    $email = $_POST['txt_email'];
    $nohp = $_POST['txt_nohp'];
    $alamat = $_POST['txt_alamat'];
    $jeniskelamin = $_POST['txt_jeniskelamin'];

    $crud->execute("INSERT INTO vsga VALUES (null, '$nama', '$tgllahir', '$email', '$nohp', '$alamat', '$jeniskelamin')");
    $_SESSION['flashData'] = 'Tambah Data Berhasil';
    header('Location: vsga.php');
}

function edit($crud)
{
    $id = $_GET['id'];
    $nama = $_POST['txt_nama'];
    $tgllahir = $_POST['txt_tgl'];
    $email = $_POST['txt_email'];
    $nohp = $_POST['txt_nohp'];
    $alamat = $_POST['txt_alamat'];
    $jeniskelamin = $_POST['txt_jeniskelamin'];

    $crud->execute("UPDATE vsga SET nama = '$nama', tgl_lahir = '$tgllahir', email = '$email', no_telepon = '$nohp', alamat = '$alamat', jenis_kelamin = '$jeniskelamin' WHERE id = '$id'");
    $_SESSION['flashData'] = 'Ubah Data Berhasil';
    header('Location: vsga.php');
}

function hapus($crud)
{
    $id = $_GET['id'];
    $query = "DELETE FROM vsga WHERE id = '$id'";
    $crud->execute($query);

    $_SESSION['flashData'] = 'Hapus Data Berhasil';
    header('Location: vsga.php');
}
