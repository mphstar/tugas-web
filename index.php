<?php

session_start();

if (!isset($_SESSION['id'])) {
    //echo($_COOKIE['id']);
    header('Location: login.php');
} else {
    //echo($_COOKIE['id']);
    if ($_SESSION['roles'] == 'admin') {
        header('Location: admin/dashboard.php');
    } else {
        header('Location: user/dashboard.php');
    }
}
