<?php

$server     = "mphstar.com";
$username   = "mphstar";
$password   = "123";
$db         = "native";

$koneksi    = mysqli_connect($server, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Koneksi gagal : ";
} else {
    // echo "sukses";
}

?>
