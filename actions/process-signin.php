<?php


  if (isset($_POST['submit_login'])) {

    ob_start();
    session_start();
    // if(isset($_SESSION['akun_user'])) header("location: index.php");
    include "koneksi.php";

    /* PROSES LOGIN */
    if(isset($_POST['submit_login'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email_login']);
      $password = mysqli_real_escape_string($conn, $_POST['password_login']);
      
      // cek apakah tombol remember di klik
      if(isset($_POST['ingat_login'])){
        $rememberMe = $_POST['ingat_login'];
      }
      




      $sql_login = mysqli_query($conn, "SELECT * FROM pengguna WHERE email_pengguna = '$email'");
      $row_akun = mysqli_fetch_array($sql_login);

      if(password_verify($password, $row_akun['password'])) {
        $_SESSION['akun_id'] = $row_akun['id_pengguna'];
        $_SESSION['akun_nama'] = $row_akun['nama_pengguna'];
        $_SESSION['hak_akses'] = $row_akun['id_akses'];
        $_SESSION['foto_pengguna'] = $row_akun['foto_pengguna'];

        if ($_SESSION['hak_akses'] == 1) {
          $_SESSION['nama_akses'] = 'Admin';
          header("location: ../app/admin/admin-dashboard.php");

        } elseif ($_SESSION['hak_akses'] == 2) {
          $_SESSION['nama_akses'] = 'Penghuni';
          header("location: ../app/penghuni/penghuni-dashboard.php");

        } elseif ($_SESSION['hak_akses'] == 3) {
          $_SESSION['nama_akses'] = 'Belum Menghuni';
          header("location: ../app/calon-penghuni/calon-dashboard.php");

        } else {
          echo 'tidak ada data valid';
        }
        // header("location: index.php");
      }else {
        echo "
          <script>
            alert ('Sign in Gagal. Harap Periksa Kembali email dan password anda!');
            document.location.href = '../pages/sign-in.php';
          </script>
        ";
        // header("location: ../pages/sign-in.php");
      }
    }
  }
  




?>