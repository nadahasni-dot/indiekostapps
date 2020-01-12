<?php

     session_start();

     unset($_SESSION['akun_id']);
     unset($_SESSION['akun_nama']);
     unset($_SESSION['hak_akses']);
     unset($_SESSION['akun_pics']);


     session_unset();
     session_destroy();

     header("location: ../pages/sign-in.php");

?>
