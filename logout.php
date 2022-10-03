<?php

session_start();
if (session_destroy()) {
    setcookie('id', null, time() - (60 * 30) + 1, '/');
    setcookie('email', null, time() - (60 * 30 + 2), '/');
    setcookie('password', null, time() - (60 * 30 + 1), '/');
    setcookie('fullname', null, time() - (60 * 30 + 1), '/');
    setcookie('roles', null, time() - (60 * 30 + 1), '/');
    header('Location: login.php');
}

?>