<?php

session_start();

if (!isset($_SESSION['id'])) {
    //echo($_COOKIE['id']);
    header('Location: login.php');
} else {
    //echo($_COOKIE['id']);
    header('Location: dashboard.php');
}
