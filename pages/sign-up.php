<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>INDIEKOST | Daftar</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway&display=swap" rel="stylesheet">

  <!-- fontawesome icon -->
  <script src="https://kit.fontawesome.com/9afba118d6.js" crossorigin="anonymous"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <div class="container up">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- form -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div>
                    <h1 class="text-left font-weight-bold h2 text-gray-900">DAFTAR AKUN</h1>
                    <p class="text-muted">Anda harus membuat akun terlebih dahulu sebelum melakukan pemesanan kamar di
                      rumah kost ini. Lengkapi form dibawah ini dengan data yang valid agar menjadi anggota.</p>
                  </div>

                  <!-- form mulai -->
                  <form class="user needs-validation" action="" novalidate>
                    <!-- nama lengkap -->
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="inputNama"
                        placeholder="Nama Lengkap" required>
                      <div class="invalid-feedback">
                        Harap isi nama lengkap anda.
                      </div>
                    </div>

                    <!-- email -->
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="inputEmail"
                        placeholder="Alamat Email" required>
                      <div class="invalid-feedback">
                        Harap isi alamat email anda.
                      </div>
                    </div>


                    <!-- no telepon -->
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="inputNomor"
                        placeholder="Nomor telepon" required>
                      <div class="invalid-feedback">
                        Harap isi nomor telepon anda.
                      </div>
                    </div>


                    <!-- password -->
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" id="inputPassword"
                          placeholder="Password" required>
                        <div class="invalid-feedback">
                          Harap isi password untuk akun anda.
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="repeatPassword"
                          placeholder="Repeat Password" required>
                        <div class="invalid-feedback">
                          Harap isi konfirmasi password untuk akun anda.
                        </div>
                      </div>
                    </div>

                    <!-- button submit registrasi -->
                    <button type="submit" class="btn btn-primary btn-user btn-block">SIGN UP</button>
                    <a href="../" class="btn btn-google btn-user btn-block">
                  <i class="fas fa-home"></i> KEMBALI KE HOMEPAGE
                </a>
                  </form>


                  <!-- akhir form -->
                  

                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.php">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="sign-in.php">Sudah mempunyai akun? Masuk sekarang</a>
                  </div>
                </div>
              </div>
              <!-- akhir form -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>


  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict';
      window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>