<?php 
    include 'koneksi.php';

    // proses update data pengguna
    if (isset($_POST['update_pengguna'])) {
        $id = $_POST['id'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $tgl = $_POST['tgl'];
        $kelamin = $_POST['jKelamin'];
        $alamat = $_POST['alamat'];
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];

        $fotoProfil = upload();

        if(!$fotoProfil){
          echo "
            <script>
              alert ('Gagal mengupdate profil');
              document.location.href = '../app/admin/admin-settings-profil.php';
            </script>
          ";
          return false;
        }
  
        $query = "UPDATE pengguna SET nama_pengguna = '$nama', alamat_pengguna = '$alamat', provinsi_pengguna = '$provinsi', kota_pengguna = '$kota', telepon_pengguna = '$telepon', email_pengguna = '$email', kelamin_pengguna = '$kelamin', tanggal_lahir_pengguna = '$tgl', no_ktp_pengguna = '$nik', foto_pengguna = '$fotoProfil' WHERE id_pengguna = $id";
  
        if(mysqli_query($conn, $query)){
          echo "
            <script>
              alert ('Berhasil update data penghuni');
              document.location.href = '../app/admin/admin-penghuni.php';
            </script>
          ";
        } else {
          echo "
            <script>
              alert ('Gagal mengupdate data penghuni');
              document.location.href = '../app/admin/admin-penghuni.php';
            </script>
          ";
        }
      }

      // proses update data profil
    if (isset($_POST['update_profil'])) {
      $id = $_POST['id'];
      $nik = $_POST['nik'];
      $nama = $_POST['nama'];
      $tgl = $_POST['tgl'];
      $kelamin = $_POST['jKelamin'];
      $alamat = $_POST['alamat'];
      $provinsi = $_POST['provinsi'];
      $kota = $_POST['kota'];
      $telepon = $_POST['telepon'];
      $email = $_POST['email'];

      $fotoProfil = upload();

      if(!$fotoProfil){
        echo "
          <script>
            alert ('Gagal mengupdate profil');
            document.location.href = '../app/admin/admin-settings-profil.php';
          </script>
        ";
        return false;
      }

      $query = "UPDATE pengguna SET nama_pengguna = '$nama', alamat_pengguna = '$alamat', provinsi_pengguna = '$provinsi', kota_pengguna = '$kota', telepon_pengguna = '$telepon', email_pengguna = '$email', kelamin_pengguna = '$kelamin', tanggal_lahir_pengguna = '$tgl', no_ktp_pengguna = '$nik', foto_pengguna = '$fotoProfil' WHERE id_pengguna = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update profil');
            document.location.href = '../app/admin/admin-settings-profil.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate profil');
            document.location.href = '../app/admin/admin-settings-profil.php';
          </script>
        ";
      }
    }

     // proses update data profil calon
     if (isset($_POST['update_profil_calon'])) {
      $id = $_POST['id'];
      $nik = $_POST['nik'];
      $nama = $_POST['nama'];
      $tgl = $_POST['tgl'];
      $kelamin = $_POST['jKelamin'];
      $alamat = $_POST['alamat'];
      $provinsi = $_POST['provinsi'];
      $kota = $_POST['kota'];
      $telepon = $_POST['telepon'];
      $email = $_POST['email'];      

      $fotoProfil = upload();

      if(!$fotoProfil){
        echo "
          <script>
            alert ('Gagal mengupdate profil');
            document.location.href = '../app/calon-penghuni/calon-settings-profil.php';
          </script>
        ";
        return false;
      }

      $query = "UPDATE pengguna SET nama_pengguna = '$nama', alamat_pengguna = '$alamat', provinsi_pengguna = '$provinsi', kota_pengguna = '$kota', telepon_pengguna = '$telepon', email_pengguna = '$email', kelamin_pengguna = '$kelamin', tanggal_lahir_pengguna = '$tgl', no_ktp_pengguna = '$nik', foto_pengguna = '$fotoProfil' WHERE id_pengguna = $id";      

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update profil');
            document.location.href = '../app/calon-penghuni/calon-settings-profil.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate profil');
            document.location.href = '../app/calon-penghuni/calon-settings-profil.php';
          </script>
        ";
      }
    }


    // proses update data profil penghuni
    if (isset($_POST['update_profil_penghuni'])) {
      $id = $_POST['id'];
      $nik = $_POST['nik'];
      $nama = $_POST['nama'];
      $tgl = $_POST['tgl'];
      $kelamin = $_POST['jKelamin'];
      $alamat = $_POST['alamat'];
      $provinsi = $_POST['provinsi'];
      $kota = $_POST['kota'];
      $telepon = $_POST['telepon'];
      $email = $_POST['email'];      

      $fotoProfil = upload();

      if(!$fotoProfil){
        echo "
          <script>
            alert ('Gagal mengupdate profil');
            document.location.href = '../app/penghuni/penghuni-settings-profil.php';
          </script>
        ";
        return false;
      }

      $query = "UPDATE pengguna SET nama_pengguna = '$nama', alamat_pengguna = '$alamat', provinsi_pengguna = '$provinsi', kota_pengguna = '$kota', telepon_pengguna = '$telepon', email_pengguna = '$email', kelamin_pengguna = '$kelamin', tanggal_lahir_pengguna = '$tgl', no_ktp_pengguna = '$nik', foto_pengguna = '$fotoProfil' WHERE id_pengguna = $id";      

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update profil');
            document.location.href = '../app/penghuni/penghuni-settings-profil.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate profil');
            document.location.href = '../app/penghuni/penghuni-settings-profil.php';
          </script>
        ";
      }
    }
    
    // proses update data layanan
    if (isset($_POST['update_layanan'])) {
      $id_layanan = $_POST['id'];
      $namaLayanan = $_POST['namaLayanan'];
      $hargaLayanan = $_POST['hargaLayanan'];

      $query = "UPDATE layanan SET nama_layanan = '$namaLayanan', harga_bulanan = '$hargaLayanan' WHERE id_layanan = $id_layanan";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update data layanan');
            document.location.href = '../app/admin/admin-data-layanan.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data layanan');
            document.location.href = '../app/admin/admin-data-layanan.php';
          </script>
        ";
      }
    }

    // proses update jenis pengeluaran
    if (isset($_POST['update_jenis_pengeluaran'])) {
      $id = $_POST['id'];
      $kodePengeluaran = $_POST['kodePengeluaran'];
      $kategori = $_POST['kategori'];
      $namaPengeluaran = $_POST['namaPengeluaran'];

      $query = "UPDATE jenis_pengeluaran SET kode_pengeluaran = '$kodePengeluaran', kategori_pengeluaran = '$kategori', nama_pengeluaran = '$namaPengeluaran' WHERE id_jenis_pengeluaran = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update data jenis pengeluaran');
            document.location.href = '../app/admin/admin-jenis-pengeluaran.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data jenis pengeluaran');
            document.location.href = '../app/admin/admin-jenis-pengeluaran.php';
          </script>
        ";
      }
    }

    // update tipe kamar
    if (isset($_POST['update_tipe_kamar'])) {
      $id = $_POST['id'];
      $namaTipe = $_POST['namaTipe'];

      $query = "UPDATE tipe_kamar SET nama_tipe = '$namaTipe' WHERE id_tipe = $id";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update data tipe kamar');
            document.location.href = '../app/admin/admin-tipe-kamar.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data tipe kamar');
            document.location.href = '../app/admin/admin-tipe-kamar.php';
          </script>
        ";
      }
    }

    // update info kost
    if (isset($_POST['update_info_kost'])) {
      $id = $_POST['id'];
      // $pemilik = $_POST['pemilik'];
      $namaKost = $_POST['nama_kost'];
      $jKost = $_POST['jKost'];
      $alamat = $_POST['alamat'];
      $provinsi = $_POST['provinsi'];
      $kota = $_POST['kota'];
      $telepon = $_POST['telepon'];
      $email = $_POST['email'];
      $desc = $_POST['desc'];

      $fotoKost = upload();

      if(!$fotoKost){
        echo "
          <script>
            alert ('Gagal mengupdate info kost');
            document.location.href = '../app/admin/admin-settings-infokost.php';
          </script>
        ";
        return false;
      }

      $query = "UPDATE info_kost SET nama_kost = '$namaKost', jenis_kost = '$jKost', alamat_kost = '$alamat', provinsi_kost = '$provinsi', kota_kost = '$kota', no_kost = '$telepon', email_kost = '$email', foto_kost = '$fotoKost', deskripsi_kost = '$desc' WHERE id_kost = '$id'";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update info kost');
            document.location.href = '../app/admin/admin-settings-infokost.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate info kost');
            document.location.href = '../app/admin/admin-settings-infokost.php';
          </script>
        ";
      }
    }

    // fungsi upload foto
    function upload(){
      
      $namaFile = $_FILES['profil']['name'];
      $ukuranFile = $_FILES['profil']['size'];
      $error = $_FILES['profil']['error'];
      $tmpName = $_FILES['profil']['tmp_name'];

      // cek file tipe yang diupload
      $ekstensiGambarValid = ['jpg','jpeg','png'];
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      
      //cek apakah gambar diupload
      if ($error === 4) {
        $namaFileBaru = $_POST['fotoLama'];
        return $namaFileBaru;
      }

      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
          <script>
            alert ('File yang diupload bukan gambar berekstensi jpg, jpeg, png');
          </script>          
        ";
        return false;
      }

      // cek ukuran gambar
      define('KB', 1024);
      define('MB', 1048576);
      define('GB', 1073741824);
      define('TB', 1099511627776);

      if ($ukuranFile > 2*MB){
        echo "
          <script>
            alert ('File yang diupload terlalu besar');
          </script>          
        ";
        return false;
      }

      // memindahkan gambar
      // generate nama baru
      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensiGambar;

      move_uploaded_file($tmpName, '../img/'.$namaFileBaru);

      return $namaFileBaru;
    }

    // rubah password
    if(isset($_POST['rubah_password'])){
      $id = $_POST['id'];
      $passLama = $_POST['passLama'];
      $passBaru = $_POST['passBaru'];
      $passBaruVerifikasi = $_POST['passBaruVerifikasi'];

      // cek apakah password lama sama
      $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna = '$id'");
      $data = mysqli_fetch_array($query);

      if(!password_verify($passLama, $data['password'])){
        echo "
          <script>
            alert ('Password lama anda salah. Harap Periksa kembali');
            document.location.href = '../app/admin/admin-settings-rubah-password.php';
          </script>
        ";
      }

      // cek apakah pass baru diverifikasi dengan benar
      if($passBaru != $passBaruVerifikasi){
        echo "
          <script>
            alert ('Verifikasi password baru salah. Harap Periksa kembali!');
            document.location.href = '../app/admin/admin-settings-rubah-password.php';
          </script>
        ";
      }

      // apabila sudah benar maka rubah password
      $passwordFix = password_hash($passBaruVerifikasi, PASSWORD_DEFAULT);
      $query = "UPDATE pengguna SET password = '$passwordFix' WHERE id_pengguna = '$id'";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil merubah password');
            document.location.href = '../app/admin/admin-settings-rubah-password.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate info kost');
            document.location.href = '../app/admin/admin-settings-rubah-password.php';
          </script>
        ";
      }

    }

    // rubah password
    if(isset($_POST['rubah_password_calon'])){
      $id = $_POST['id'];
      $passLama = $_POST['passLama'];
      $passBaru = $_POST['passBaru'];
      $passBaruVerifikasi = $_POST['passBaruVerifikasi'];

      // cek apakah password lama sama
      $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna = '$id'");
      $data = mysqli_fetch_array($query);

      if(!password_verify($passLama, $data['password'])){
        echo "
          <script>
            alert ('Password lama anda salah. Harap Periksa kembali');
            document.location.href = '../app/calon-penghuni/calon-settings-rubah-password.php';
          </script>
        ";
      }

      // cek apakah pass baru diverifikasi dengan benar
      if($passBaru != $passBaruVerifikasi){
        echo "
          <script>
            alert ('Verifikasi password baru salah. Harap Periksa kembali!');
            document.location.href = '../app/calon-penghuni/calon-settings-rubah-password.php';
          </script>
        ";
      }

      // apabila sudah benar maka rubah password
      $passwordFix = password_hash($passBaruVerifikasi, PASSWORD_DEFAULT);
      $query = "UPDATE pengguna SET password = '$passwordFix' WHERE id_pengguna = '$id'";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil merubah password');
            document.location.href = '../app/calon-penghuni/calon-settings-rubah-password.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate info kost');
            document.location.href = '../app/calon-penghuni/calon-settings-rubah-password.php';
          </script>
        ";
      }

    }


    // rubah password penghuni
    if(isset($_POST['rubah_password_penghuni'])){
      $id = $_POST['id'];
      $passLama = $_POST['passLama'];
      $passBaru = $_POST['passBaru'];
      $passBaruVerifikasi = $_POST['passBaruVerifikasi'];

      // cek apakah password lama sama
      $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna = '$id'");
      $data = mysqli_fetch_array($query);

      if(!password_verify($passLama, $data['password'])){
        echo "
          <script>
            alert ('Password lama anda salah. Harap Periksa kembali');
            document.location.href = '../app/penghuni/penghuni-settings-rubah-password.php';
          </script>
        ";
      }

      // cek apakah pass baru diverifikasi dengan benar
      if($passBaru != $passBaruVerifikasi){
        echo "
          <script>
            alert ('Verifikasi password baru salah. Harap Periksa kembali!');
            document.location.href = '../app/penghuni/penghuni-settings-rubah-password.php';
          </script>
        ";
      }

      // apabila sudah benar maka rubah password
      $passwordFix = password_hash($passBaruVerifikasi, PASSWORD_DEFAULT);
      $query = "UPDATE pengguna SET password = '$passwordFix' WHERE id_pengguna = '$id'";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil merubah password');
            document.location.href = '../app/penghuni/penghuni-settings-rubah-password.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate info kost');
            document.location.href = '../app/penghuni/penghuni-settings-rubah-password.php';
          </script>
        ";
      }

    }


    if(isset($_POST['update_kamar'])){
      $id = $_POST['id'];
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
            alert ('Gagal mengupdate data kamar');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
        return false;
      }

      $query = "UPDATE kamar SET nomor_kamar = '$nomorKamar', id_tipe = '$tipe', luas_kamar = '$luas', lantai_kamar = '$lantai', kapasitas_kamar = '$kapasitas', deskripsi_kamar = '$deskripsi', id_layanan = '$layanan', harga_bulanan = '$hargaBulanan', denda = '$denda', foto_kamar = '$fotoKamar' WHERE id_kamar = '$id'";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update data kamar');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data kamar');
            document.location.href = '../app/admin/admin-kamar.php';
          </script>
        ";
      }
    }

    if (isset($_POST['update_menghuni'])) {
      $id = $_POST['id'];      
      $kamar = $_POST['kamar'];      
      $penghuni = $_POST['penghuni'];
      $tanggal = $_POST['tanggal'];      

      $query = "UPDATE menghuni SET id_kamar = '$kamar', id_pengguna = '$penghuni', tanggal_masuk = '$tanggal' WHERE id_menghuni = '$id'";      

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update data menghuni');
            document.location.href = '../app/admin/admin-kamar-menghuni.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data menghuni');
            document.location.href = '../app/admin/admin-kamar-menghuni.php';
          </script>
        ";
      }
    }

    if(isset($_POST['update_pengeluaran'])){
      $id = $_POST['id'];
      $jenis = $_POST['jenis'];
      $tanggal = $_POST['tanggal'];
      $nominal = $_POST['nominal'];
      $keterangan = $_POST['keterangan'];

      $buktiBayar = upload();      

      if(!$buktiBayar){
        echo "
          <script>
            alert ('Gagal mengupdate data pengeluaran');
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
        return false;
      }

      $query = "UPDATE pengeluaran SET id_jenis_pengeluaran = '$jenis', tanggal_pengeluaran = '$tanggal', nilai_pengeluaran = '$nominal', keterangan = '$keterangan', bukti_pengeluaran = '$buktiBayar' WHERE id_pengeluaran = '$id'";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update data pengeluaran');
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data pengeluaran');
            document.location.href = '../app/admin/admin-pengeluaran.php';
          </script>
        ";
      }
    }

    // update pembayaran
    if(isset($_POST['update_pembayaran'])){
      $id = $_POST['id'];
      $menghuni = $_POST['menghuni'];
      $tanggal = $_POST['tanggal'];
      $nominal = $_POST['nominal'];
      $keterangan = $_POST['keterangan'];
      $status = $_POST['status'];

      $buktiBayar = upload();      

      if(!$buktiBayar){
        echo "
          <script>
            alert ('Gagal mengupdate data pembayarn');
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
        return false;
      }

      $query = "UPDATE pembayaran SET id_menghuni = '$menghuni', tanggal_pembayaran = '$tanggal', nilai_pembayaran = '$nominal', keterangan = '$keterangan', bukti_pembayaran = '$buktiBayar', id_status = '$status' WHERE id_pembayaran = '$id'";

      if(mysqli_query($conn, $query)){
        echo "
          <script>
            alert ('Berhasil update data pengeluaran');
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data pengeluaran');
            document.location.href = '../app/admin/admin-pemasukan.php';
          </script>
        ";
      }
    }

    // update booking
    if(isset($_POST['update_booking'])){
      $id = $_POST['id'];
      $status = $_POST['status'];

      $query = "UPDATE booking SET status_booking = '$status' WHERE id_booking = '$id'";

      if(mysqli_query($conn, $query)){

        // select data booking yang diupdate
        $query = "SELECT * FROM booking WHERE id_booking = '$id'";
        $result = mysqli_query($conn, $query);
        $dataBooking = mysqli_fetch_array($result);

        $kamar = $dataBooking['id_kamar'];
        $penghuni = $dataBooking['id_pengguna'];
        $tanggal = $dataBooking['tanggal_booking'];

        // memasukkan penghuni ke kamar
        $query = "INSERT INTO menghuni (id_menghuni, id_kamar, id_pengguna, tanggal_masuk) VALUES ('', '$kamar', '$penghuni', '$tanggal')";

        if(mysqli_query($conn, $query)){
          $query = "SELECT * FROM booking, kamar, menghuni WHERE id_booking = '$id' AND booking.id_kamar = kamar.id_kamar AND menghuni.id_kamar = kamar.id_kamar";
          $result = mysqli_query($conn, $query);
          $dataMenghuni = mysqli_fetch_array($result);

          $idMenghuni = $dataMenghuni['id_menghuni'];
          $tanggal = $dataMenghuni['tanggal_booking'];
          $nominalBayar = $dataMenghuni['nilai_booking'];
          $buktiBayar = $dataMenghuni['bukti_booking'];
          $keteranganBayar = 'Pembayaran Booking kamar no.'.$dataMenghuni['nomor_kamar'].' tanggal: '.$dataMenghuni['tanggal_booking'];
          
          // menginput pembayaran nooking kamar
          $query = "INSERT INTO pembayaran (id_pembayaran, id_menghuni, tanggal_pembayaran, nilai_pembayaran, bukti_pembayaran, keterangan, id_status) VALUES ('', '$idMenghuni', '$tanggal', '$nominalBayar', '$buktiBayar', '$keteranganBayar', '1')";

          if(mysqli_query($conn, $query)){
            $penghuni = $dataBooking['id_pengguna'];

            // merubah hak akses pengguna
            $query = "UPDATE pengguna SET id_akses ='2' WHERE id_pengguna = '$penghuni'";

            if(mysqli_query($conn, $query)){

              $id = $_POST['id'];
              $query = "UPDATE booking SET status_booking = 'belum_dikonfirmasi' WHERE id_booking = '$id'";

              if(mysqli_query($conn, $query)){

                echo "
                <script>
                  alert ('Berhasil update data booking, mendaftarkan penghuni ke kamar, dan menginput pembayaran');
                  document.location.href = '../app/admin/admin-booking.php';
                </script>
                ";
              }
            }
          }
        }        
      } else {
        echo "
          <script>
            alert ('Gagal mengupdate data pengeluaran');
            document.location.href = '../app/admin/admin-booking.php';
          </script>
        ";
      }
    }
?>