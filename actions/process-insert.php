<?php 
    include 'koneksi.php';
    require_once 'process-update.php';

    use PHPMailer\PHPMailer\PHPMailer;

    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';

    require 'PHPMailer/src/PHPMailer.php';

    require 'PHPMailer/src/SMTP.php';

    session_start();

    if(isset($_POST['submitJenisLayanan'])){
        $nama_layanan = $_POST['inputLayanan'];
        $harga = $_POST['inputHarga'];

        $query = "INSERT INTO layanan (nama_layanan, harga_bulanan) VALUES ('$nama_layanan', $harga)";
        
        if(mysqli_query($conn, $query)){
          echo "
            <script>
              alert ('Berhasil menambah layanan');
              document.location.href = '../app/admin/admin-data-layanan.php';
            </script>
          ";
        } else {
          echo "
            <script>
              alert ('Gagal menambah layanan');
              document.location.href = '../app/admin/admin-data-layanan.php';
            </script>
          ";
        }
    }

    if (isset($_POST['submitJenisPengeluaran'])) {
      $kode = $_POST['inputKode'];
      $kategori = $_POST['inputKategori'];
      $nama_pengeluaran = $_POST['inputNama'];

      $query = "INSERT INTO jenis_pengeluaran (kode_pengeluaran, kategori_pengeluaran, nama_pengeluaran) VALUES ('$kode', '$kategori', '$nama_pengeluaran')";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menambah jenis pengeluaran');
            document.location.href = '../app/admin/admin-jenis-pengeluaran.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menambah jenis pengeluaran');
            document.location.href = '../app/admin/admin-jenis-pengeluaran.php';
          </script>
        ";
      }
    }

    if (isset($_POST['submitTipeKamar'])){
      $tipeKamar = $_POST['inputTipeKamar'];

      $query = "INSERT INTO tipe_kamar (nama_tipe) VALUES ('$tipeKamar')";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menambah tipe kamar');
            document.location.href = '../app/admin/admin-tipe-kamar.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menambah tipe kamar');
            document.location.href = '../app/admin/admin-tipe-kamar.php';
          </script>
        ";
      }
    }

    if (isset($_POST['submitKamar'])) {
      $nomorKamar = $_POST['nomorKamar'];
      $tipe = $_POST['tipe'];
      $luas = $_POST['luas'];
      $lantai = $_POST['lantai'];
      $kapasitas = $_POST['kapasitas'];
      $deskripsi = $_POST['deskripsi'];
      $hargaBulanan = $_POST['hargaBulanan'];
      $layanan = $_POST['layanan'];
      $denda = $_POST['denda'];

      $fotoKamar = upload();      

      if(!$fotoKamar){
        echo "
          <script>
            alert ('Gagal Menambah data kamar');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
        return false;
      }

      $query = "INSERT INTO kamar (id_kamar, nomor_kamar, id_tipe, luas_kamar, lantai_kamar, kapasitas_kamar, deskripsi_kamar, id_layanan, harga_bulanan, denda, foto_kamar) VALUES ('', '$nomorKamar', '$tipe', '$luas', '$lantai',  '$kapasitas', '$deskripsi', '$layanan', '$hargaBulanan', '$denda', '$fotoKamar')";      

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menambah kamar');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menambah kamar');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
      }
    }

    if (isset($_POST['submitMenghuni'])) {
      $kamar = $_POST['kamar'];
      $penghuni = $_POST['penghuni'];
      $tanggal = $_POST['tanggal'];

      $nominalBayar = $_POST['nominalBayar'];
      $keteranganBayar = $_POST['keterangan'];
      
      $buktiBayar = upload();

      if(!$buktiBayar){
        echo "
          <script>
            alert ('Gagal Mendaftarkan Penghuni ke Kamar');
            document.location.href = '../app/admin/admin-kamar-menghuni.php';
          </script>
        ";
        return false;
      }

      $query = "INSERT INTO menghuni (id_menghuni, id_kamar, id_pengguna, tanggal_masuk) VALUES ('', '$kamar', '$penghuni', '$tanggal')";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil mendaftarkan penghuni ke kamar');       
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mendaftarkan penghuni ke kamar');
            document.location.href = '../app/admin/admin-kamar-menghuni.php';  
          </script>
        ";
      }

      $query = "SELECT * FROM menghuni WHERE id_pengguna = '$penghuni'";

      $result = mysqli_query($conn, $query);
      $dataHuni = mysqli_fetch_array($result);
      $idMenghuni = $dataHuni['id_menghuni'];

      $query = "INSERT INTO pembayaran (id_pembayaran, id_menghuni, tanggal_pembayaran, nilai_pembayaran, bukti_pembayaran, keterangan, id_status) VALUES ('', '$idMenghuni', '$tanggal', '$nominalBayar', '$buktiBayar', '$keteranganBayar', '2')";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil Melakukan Pembayaran Kamar');
            document.location.href = '../app/admin/admin-kamar-menghuni.php';       
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal Melakukan Pembayaran Kamar');
            document.location.href = '../app/admin/admin-kamar-menghuni.php';  
          </script>
        ";
      }
    }

    if (isset($_POST['submitPengeluaran'])) {
      $idPembayar = $_SESSION['akun_id'];
      $jenis = $_POST['jenis'];
      $tanggal = $_POST['tanggal'];
      $nominalBayar = $_POST['nominal'];
      $keteranganBayar = $_POST['keterangan'];

      $buktiBayar = upload();

      if(!$buktiBayar){
        echo "
          <script>
            alert ('Gagal Menambah Pengeluaran');
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
        return false;
      }

      $query = "INSERT INTO pengeluaran (id_pengeluaran, id_jenis_pengeluaran, tanggal_pengeluaran, nilai_pengeluaran, keterangan, bukti_pengeluaran, id_pengguna) VALUES ('', '$jenis', '$tanggal', '$nominalBayar', '$keteranganBayar', '$buktiBayar', '$idPembayar')";      

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menambah pengeluaran');
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menambah pengeluaran');  
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
      }
    }

    if (isset($_POST['submitPembayaran'])) {      
      $idMenghuni = $_POST['menghuni'];
      $tanggal = $_POST['tanggal'];
      $nominalBayar = $_POST['nominal'];
      $keteranganBayar = $_POST['keterangan'];
      $idStatus = $_POST['status'];

      $buktiBayar = upload();      

      if(!$buktiBayar){
        echo "
          <script>
            alert ('Gagal Menambah Pembayaran');
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
        return false;
      }

      $query = "INSERT INTO pembayaran (id_pembayaran, id_menghuni, tanggal_pembayaran, nilai_pembayaran, keterangan, bukti_pembayaran, id_status) VALUES ('', '$idMenghuni', '$tanggal', '$nominalBayar', '$keteranganBayar', '$buktiBayar', '$idStatus')";      

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menambah pembayaran');
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menambah pembayaran');  
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
      }
    }

    if(isset($_POST['submitBooking'])){
      $idPenghuni = $_SESSION['akun_id'];
      $idKamar = $_POST['idKamar'];
      $nominal = $_POST['nominal'];      

      $buktiBooking = upload();
      if(!$buktiBooking){
        echo "
          <script>
            alert ('Gagal Memesan Kamar');
            document.location.href = '../app/calon-penghuni/calon-booking.php';
          </script>
        ";
        return false;
      }

      $query = "INSERT INTO booking (id_booking, id_kamar, id_pengguna, tanggal_booking ,nilai_booking, bukti_booking, status_booking) VALUES ('','$idKamar','$idPenghuni',CURRENT_DATE(),'$nominal','$buktiBooking','belum dikonfirmasi')";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil Memesan Kamar');
            document.location.href = '../app/calon-penghuni/calon-booking.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menambah pembayaran');  
            document.location.href = '../app/calon-penghuni/calon-booking.php';
          </script>
        ";
      }
    }
?>