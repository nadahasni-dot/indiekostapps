<?php 

include '../../actions/koneksi.php';

ob_start();
session_start();

if (!isset($_SESSION['akun_id'])){
  header("location: ../../landing-page.php");
} 
elseif (isset($_SESSION['akun_id'])){
  if($_SESSION['hak_akses'] == 1){
    header("location: ../admin/admin-dashboard.php");
  }
  elseif($_SESSION['hak_akses'] == 3){
    header("location: ../calon-penghuni/calon-dashboard.php");
  } 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pembayaran</title>

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Indiekost</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="penghuni-dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Fitur
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="penghuni-kamar.php">
          <i class="fas fa-fw fa-bed"></i>
          <span>Kamar</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="penghuni-pembayaran.php">
          <i class="fas fa-fw fa-money-bill"></i>
          <span>Pembayaran</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span
                  class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo '('.($_SESSION['nama_akses']).') '.($_SESSION['akun_nama']);  ?></span>

                <!-- foto profil -->

                <?php 
                $id = $_SESSION['akun_id'];
                $query = "SELECT * FROM pengguna WHERE id_pengguna = $id";
                $result = mysqli_query($conn, $query);
        
                while ($data = mysqli_fetch_array($result)) {
                  if ($data['foto_pengguna'] == NULL){                  
                ?>

                <img class="img-profile rounded-circle" src="../../img/none.png">
                <?php } else { ?>

                <img class="img-profile rounded-circle" src="../../img/<?php print_r($data['foto_pengguna']);  ?>">

                <?php
                    } 
                  } 
                ?>

                <!-- foto profil -->


              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="penghuni-settings-profil.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="penghuni-settings-rubah-password.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <?php 
            $id_pengguna = $_SESSION['akun_id'];
            $query = "SELECT *, DATE_FORMAT(CURRENT_DATE(), '%M %Y') AS bulan FROM pembayaran, kamar, pengguna, menghuni, jenis_status_pembayaran
            WHERE menghuni.id_kamar = kamar.id_kamar AND pembayaran.id_status = jenis_status_pembayaran.id_status AND
              menghuni.id_pengguna = pengguna.id_pengguna AND
              pembayaran.id_menghuni = menghuni.id_menghuni AND pengguna.id_pengguna = $id_pengguna AND
              MONTH(pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE())";

            $query2 = "SELECT *, DATE_FORMAT(CURRENT_DATE(), '%M %Y') AS bulan, (kamar.harga_bulanan + layanan.harga_bulanan) AS harga_total, CURRENT_DATE() AS tanggal_sekarang FROM kamar, pengguna, menghuni, layanan
            WHERE menghuni.id_kamar = kamar.id_kamar  AND kamar.id_layanan = layanan.id_layanan AND
              menghuni.id_pengguna = pengguna.id_pengguna AND pengguna.id_pengguna = $id_pengguna";

            $query3 = "SELECT DATE_FORMAT(CURRENT_DATE(), '%Y') as tahun, DATE_FORMAT(CURRENT_DATE(), '%m') as bulan";
            $result3 = mysqli_query($conn, $query3);
            $tahunBulanSekarang = mysqli_fetch_array($result3);

            $tahun = $tahunBulanSekarang['tahun'];
            $bulan = $tahunBulanSekarang['bulan'];

            $query4 = "SELECT DATEDIFF(CURRENT_DATE(),'$tahun-$bulan-10') AS selisih";
            $result4 = mysqli_query($conn, $query4);
            $selisihData = mysqli_fetch_array($result4);

            $selisih = $selisihData['selisih'];

            if($selisih <= 0){
              $selisih = 0;
            }          

            $result = mysqli_query($conn,$query);
            $result2 = mysqli_query($conn,$query2);
            $dataPembayaran = mysqli_fetch_array($result);
            $dataPembayaran2 = mysqli_fetch_array($result2);
            $row = mysqli_num_rows($result);

            $totalDenda = $selisih * $dataPembayaran2['denda'];            

            // cek apakah sudah membayar bulan ini
            if($row > 0){
          ?>         

          <!-- card awal -->
          <div class="card col-12 mb-3">
            <div class="card-body">
              <h4 class="card-title">Pembayaran</h4>
              <p class="card-text">Detail data pembayaran anda bulan <?php echo $dataPembayaran['bulan']; ?></p>
              <div class="container-fluid pr-3">
                <img src="../../img/<?php
                  if ($dataPembayaran['bukti_pembayaran'] == NULL) {
                      echo 'none.png';
                  } else {
                      echo $dataPembayaran['bukti_pembayaran']; 
                  }
                  ?>" alt="<?php echo $dataPembayaran['tanggal_pembayaran']; ?>" class="img-thumbnail mx-auto d-block mb-3 rounded"
                  width="300px">
                <div class="table-respomsive pr-3">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="font-weight-bold" width="30%">Tanggal Pembayaran</td>
                        <td><?php echo $dataPembayaran['tanggal_pembayaran']; ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold" width="30%">Kamar Yang Dibayar</td>
                        <td><?php echo 'Kamar no. '.$dataPembayaran['nomor_kamar']; ?></td>
                      </tr>                      
                      <tr>
                        <td class="font-weight-bold" width="30%">Pembayar</td>
                        <td><?php echo strtoupper($dataPembayaran['nama_pengguna']); ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold" width="30%">Keterangan</td>
                        <td><?php echo $dataPembayaran['keterangan']; ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold" width="30%">Harga Bulanan</td>
                        <td><?php echo 'Rp. '.number_format($dataPembayaran['nilai_pembayaran']); ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold" width="30%">Status Pembayaran</td>
                        <td><?php echo strtoupper($dataPembayaran['nama_status_pembayaran']); ?></td>
                      </tr>                      
                    </tbody>
                  </table>
                  <?php if (strtoupper($dataPembayaran['nama_status_pembayaran']) == 'SUDAH DIKONFIRMASI') {?>
                  <a href="bukti-pembayaran.php?id_pembayaran=<?php echo $dataPembayaran['id_pembayaran']; ?>" target="_blank" class="btn btn-primary mb-3" rel="noopener noreferrer"><i class="fas fa-print"></i> Cetak Bukti Pembayaran</a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <!-- card akhir -->

          <?php } else { 
            if($dataPembayaran2['nomor_kamar'] == NULL){  
          ?>

          <div class="card col-12 mb-3">
            <div class="card-body">
              <h4 class="card-title text-center">Peringatan</h4>
              <p class="card-text text-danger text-center font-weight-bold">Anda bukan penghuni lagi, silahkan logout dan login kembali untuk melanjutkan</p>
              <div class="row justify-content-center align-items-center">
                <button data-toggle="modal" data-target="#logoutModal" class="btn btn-primary ">Log Out</button>
              </div>
            </div>
          </div>
          <?php } else { ?>

           <!-- card awal -->
           <div class="card col-12 mb-3">
            <div class="card-body">
              <h4 class="card-title">Pembayaran</h4>
              <p class="card-text">Anda belum melakukan pembayaran kamar no. <?php echo $dataPembayaran2['nomor_kamar']; ?> bulan <?php echo $dataPembayaran2['bulan']; ?></p>
              <p class="font-weight-bold text-danger">Lakukan pembayaran sebelum Tanggal (10 <?php echo $dataPembayaran2['bulan']; ?>)</p>
              <div class="container-fluid pr-3">
                <!-- <img src="../../img/<?php
                  if ($dataPembayaran['bukti_pembayaran'] == NULL) {
                      echo 'none.png';
                  } else {
                      echo $dataPembayaran['bukti_pembayaran']; 
                  }
                  ?>" alt="<?php echo $dataPembayaran['tanggal_pembayaran']; ?>" class="img-thumbnail mx-auto d-block mb-3 rounded"
                  width="300px"> -->
                <div class="table-respomsive pr-3">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="font-weight-bold" width="30%">Kamar Yang Harus Dibayar</td>
                        <td><?php echo 'Kamar no. '.$dataPembayaran2['nomor_kamar']; ?></td>
                      </tr>                      
                      <tr>
                        <td class="font-weight-bold" width="30%">Pembayar</td>
                        <td><?php echo strtoupper($dataPembayaran2['nama_pengguna']); ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold" width="30%">Denda</td>
                        <td><?php echo 'Rp. '.number_format($totalDenda); ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold" width="30%">Total Harus Dibayar</td>
                        <td><?php echo 'Rp. '.number_format($dataPembayaran2['harga_total']+$totalDenda); ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold" width="30%">Cara Pembayaran</td>
                        <td class="font-weight-bold text-success">Lakukan pembayaran kamar offline (Melalui Teknisi Kost, dengan meminta struk pembayaran) atau transfer ke <br><br>(Rekening no. 143-001-389-2367 [MANDIRI] A.N. Suliha) <br><br> Foto/Scan Bukti pembayaran dan upload saat melakukan pembayaran</td>
                      </tr>                                            
                    </tbody>
                  </table>
                  <form action="../../actions/process-insert.php" method="POST" enctype="multipart/form-data">

                        <div class="form-group">                          
                          <input value="<?php echo ($dataPembayaran2['harga_total']+$totalDenda); ?>" type="hidden" class="form-control" id="nominal" name="nominal"
                            aria-describedby="nominal" placeholder="Masukkan nominal pembayaran" required>
                        </div>
                        <div class="form-group">                          
                          <input value="2" type="hidden" class="form-control" id="status" name="status"
                            aria-describedby="status" placeholder="Masukkan nominal pembayaran" required>
                        </div>
                        <div class="form-group">                          
                          <input value="<?php echo $dataPembayaran2['id_menghuni'] ?>" type="hidden" class="form-control" id="menghuni" name="menghuni"
                            aria-describedby="nominal" placeholder="Masukkan nominal pembayaran" required>
                        </div>
                        <div class="form-group">
                          <label for="tanggal">Tanggal Pembayaran</label>
                          <input value="<?php echo $dataPembayaran2['tanggal_sekarang'] ?>" type="date" class="form-control" id="tanggal" name="tanggal"
                            aria-describedby="nominal" placeholder="Masukkan nominal pembayaran" readonly>
                        </div>
                        <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <textarea value="" type="text" class="form-control" id="keterangan" name="keterangan"
                            aria-describedby="keterangan" rows="3" placeholder="Masukkan keterangan pengeluaran"
                            required></textarea>
                        </div>
                        <div class="form-group">
                          <label for="profil">Bukti Pembayaran</label>
                          <input value="" type="file" class="form-control-file" id="profil" name="profil"
                            aria-describedby="profil" accept="image/*" required>
                        </div>
                        <button type="submit" name="submitPembayaran" class="btn btn-primary"
                          onclick="return confirm('Anda yakin ingin melakukan pembayaran? Pastikan data yang diinputkan benar');">Bayar
                          Kamar</button>
                      </form>
                </div>
              </div>
            </div>
          </div>
          <!-- card akhir -->
          <?php } 
            }
          ?>
        </div>


        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; INDIEKOST 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar Aplikasi?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Logout" dibawah jika anda ingin mengakhiri sesi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../../actions/process-logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- view modal -->
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Rincian Data Kamar
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detail_kamar">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Booking modal -->
  <div class="modal fade" id="bookingKamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary font-weight-bold" id="exampleModalCenterTitle">Booking Kamar
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="booking_data">

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>



  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../js/demo/datatables-demo.js"></script>

  <script>
    $(document).ready(function () {

      // untuk view data
      $('.view_data').on('click', function () {
        var id_kamar = $(this).attr('id');
        console.log(id_kamar);

        $.ajax({
          url: "ajax/select_data_kamar.php",
          method: "post",
          data: {
            id_kamar: id_kamar
          },
          success: function (data) {
            $('#detail_kamar').html(data);
            $('#viewModal').modal();
          }
        });
      });

      // edit data
      $('.booking_kamar').on('click', function () {
        var id_kamar = $(this).attr('id');
        console.log(id_kamar);

        $.ajax({
          url: "ajax/booking_kamar.php",
          method: "post",
          data: {
            id_kamar: id_kamar
          },
          success: function (data) {
            $('#booking_data').html(data);
            $('#bookingKamar').modal();
          }
        });
      });
    });
  </script>
</body>

</html>