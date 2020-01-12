<?php


  if (isset($_POST['submit_daftar'])) {
    include 'koneksi.php';

    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap_reg']);
    $email = mysqli_real_escape_string($conn, $_POST['email_reg']);
    $nomor = mysqli_real_escape_string($conn, $_POST['nomor_reg']);
    $password = mysqli_real_escape_string($conn, $_POST['password_repeat_reg']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO pengguna (nama_pengguna, email_pengguna, telepon_pengguna, password, id_akses) VALUES('$nama_lengkap','$email','$nomor','$password_hash','3 ')";

    mysqli_query($conn, $query);

    if(mysqli_affected_rows($conn) > 0){
      echo "
        <script>
          alert ('Berhasil membuat akun');
          document.location.href = '../pages/sign-in.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert ('Gagal membuat akun');
          document.location.href = '../pages/sign-up.php';
        </script>
      ";
    }
  }  









?>
