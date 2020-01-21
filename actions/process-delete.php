<?php 
    include 'koneksi.php';

    // menonaktifkan pengguna
    if(isset($_GET['id_hapus_penghuni'])){
        $id = $_GET['id_hapus_penghuni'];

        $query = "DELETE FROM pengguna WHERE id_pengguna = $id";

        if(mysqli_query($conn, $query)){
            echo "
              <script>
                alert ('Berhasil menghapus data');
                document.location.href = '../app/admin/admin-penghuni.php';
              </script>
            ";
          } else {
            echo "
              <script>
                alert ('Gagal menghapus data');
                document.location.href = '../app/admin/admin-penghuni.php';
              </script>
            ";
          }
    }


    // hapus data layanan
    if (isset($_GET['id_hapus_layanan'])) {
      $id = $_GET["id_hapus_layanan"];

      $query = "DELETE FROM layanan WHERE id_layanan = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menghapus data');
            document.location.href = '../app/admin/admin-data-layanan.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-data-layanan.php';
          </script>
        ";
      }

    }

    // hapus data jenis pengeluaran
    if (isset($_GET['id_hapus_jenis_pengeluaran'])) {
      $id = $_GET["id_hapus_jenis_pengeluaran"];

      $query = "DELETE FROM jenis_pengeluaran WHERE id_jenis_pengeluaran = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menghapus data');
            document.location.href = '../app/admin/admin-jenis-pengeluaran.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-jenis-pengeluaran.php';
          </script>
        ";
      }

    }

    // hapus data tipe kamar
    if (isset($_GET['id_hapus_tipe_kamar'])) {
      $id = $_GET['id_hapus_tipe_kamar'];

      $query = "DELETE FROM tipe_kamar WHERE id_tipe = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menghapus data');
            document.location.href = '../app/admin/admin-tipe-kamar.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-tipe-kamar.php';
          </script>
        ";
      }
    }

    // hapus kamar
    if (isset($_GET['id_hapus_kamar'])) {
      $id = $_GET['id_hapus_kamar'];

      $query = "DELETE FROM kamar WHERE id_kamar = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menghapus data');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
      }     
    }

    // hapus menghuni
    if (isset($_GET['id_hapus_menghuni'])) {
      $id = $_GET['id_hapus_menghuni'];
      $idPengguna = $_GET['id_pengguna'];      

      $query = "DELETE FROM menghuni WHERE id_menghuni = $id";

      if(mysqli_query($conn, $query)){
        // merubah hak akses pengguna ke belum menghuni
        $query = "UPDATE pengguna SET id_akses = '3' WHERE id_pengguna = $idPengguna";

        if(mysqli_query($conn, $query)){
          // menghapus data booking penghuni
          $query = "DELETE FROM booking WHERE id_pengguna = $idPengguna";

          if(mysqli_query($conn, $query)){
            echo "
              <script>
                alert ('Berhasil menghapus data');
                document.location.href = '../app/admin/admin-kamar-menghuni.php';
              </script>
            ";
          }
        }
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-kamar-menghuni.php';
          </script>
        ";
      }

      
    }

    // hapus pengeluaran
    if (isset($_GET['id_hapus_pengeluaran'])) {
      $id = $_GET['id_hapus_pengeluaran'];

      $query = "DELETE FROM pengeluaran WHERE id_pengeluaran = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menghapus data');
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
      }

      
    }

    // hapus pengeluaran
    if (isset($_GET['id_hapus_pembayaran'])) {
      $id = $_GET['id_hapus_pembayaran'];

      $query = "DELETE FROM pembayaran WHERE id_pembayaran = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menghapus data');
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
      }

      
    }

    // hapus booking
    if (isset($_GET['id_hapus_booking'])) {
      $id = $_GET['id_hapus_booking'];

      $query = "DELETE FROM booking WHERE id_booking = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil menghapus data');
            document.location.href = '../app/admin/admin-booking.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal menghapus data');
            document.location.href = '../app/admin/admin-booking.php';
          </script>
        ";
      }

      
    }
?>