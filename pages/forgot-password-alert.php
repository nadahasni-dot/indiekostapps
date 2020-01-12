<?php 
  include '../actions/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>INDIEKOST | Lupa Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Link Telah Dikirim</h1>
                    <p class="mb-4">Link untuk mereset password anda telah kami kirim ke email anda. Silahkan cek kotak masuk email anda. Klik link untuk mereset password, dan lakukan pembuatan password baru untuk akun anda.</p>
                  </div>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="sign-up.php">Belum mempunyai akun? Buat Akun!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="sign-in.php">Sudah memiliki akun? Masuk Sekarang!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <script>
    <?php 

    $query = "SELECT * FROM info_kost";
    $result = mysqli_query($conn, $query);

    while ($data = mysqli_fetch_array($result)) {

    ?>

    $(function(){
      $(".bg-password-image").css({"background-image": "url(../img/<?php echo $data['foto_kost'] ?>)"})
    })

    <?php } ?>
  </script>
</body>

</html>
