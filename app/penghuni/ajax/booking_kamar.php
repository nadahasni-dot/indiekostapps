<!doctype html>
<html lang="en">
<?php 
    include '../../../actions/koneksi.php';
    ob_start();
  session_start();

  if (!isset($_SESSION['akun_id'])){
    header("location: ../../landing-page.php");
  } 
  elseif (isset($_SESSION['akun_id'])){
    if($_SESSION['hak_akses'] == 1){
      header("location: ../admin/admin-dashboard.php");
    }
    elseif($_SESSION['hak_akses'] == 2){
      header("location: ../penghuni/penghuni-dashboard.php");
    } 
  }

  $idPengguna = $_SESSION['akun_id'];

  $query = "SELECT * FROM pengguna WHERE id_pengguna ='$idPengguna'";
  $result = mysqli_query($conn, $query);
  $dataPengguna = mysqli_fetch_array($result);

  // cek apakah data diri sudah lengkap
  if(in_array('', $dataPengguna) || in_array('0000-00-00', $dataPengguna)){    
?>
  <div class="container">
    <div class="row font-weight-bold text-center">Anda Belum Melengkapi Data Diri Anda. Lengkapi Data Diri Anda Terlebih Dahulu Untuk Melakukan Pemesanan Kamar</div>
    <div class="row justify-content-center align-items-center">
    <a href="calon-settings-profil.php" class="btn btn-primary justify-content-center mb-3 mt-3">Lengkapi Data Diri</a>
    </div>    
  </div>
<?php
    
  } else {

    // select data untuk update
    if(isset($_POST['id_kamar'])){
        $id_kamar = $_POST['id_kamar'];

        $query = "SELECT kamar.id_kamar, kamar.foto_kamar ,kamar.nomor_kamar, tipe_kamar.nama_tipe, kamar.luas_kamar, kamar.lantai_kamar, kamar.kapasitas_kamar, kamar.deskripsi_kamar, layanan.nama_layanan, kamar.harga_bulanan, kamar.denda, layanan.harga_bulanan AS harga_layanan, (kamar.harga_bulanan + layanan.harga_bulanan) AS harga_bulanan_total FROM kamar, tipe_kamar, layanan
        WHERE
            kamar.id_tipe = tipe_kamar.id_tipe AND
            kamar.id_layanan = layanan.id_layanan AND
            kamar.id_kamar = '$id_kamar'";

        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-insert.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="idKamar" value="<?php echo $data['id_kamar']; ?>">
  <input type="hidden" name="nominal" value="<?php echo $data['harga_bulanan_total']; ?>">
  <div class="form-group">    
    <input value="<?php echo $data['nomor_kamar']; ?>" type="hidden" class="form-control" id="nomorKamar" name="nomorKamar"
      aria-describedby="Nomor Kamar" placeholder="Masukkan nomor kamar baru" readonly>
  </div>
  <div class="container-fluid">
    <img src="../../img/<?php
    if ($data['foto_kamar'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['foto_kamar']; 
    }
     ?>" alt="<?php echo $data['nomor_kamar'] ?>" class="img-thumbnail mx-auto d-block mb-3 rounded" width="300px">
    <div class="table-respomsive">
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-weight-bold" width="30%">Nomor Kamar</td>
                    <td><?php echo $data['nomor_kamar']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Tipe</td>
                    <td><?php echo $data['nama_tipe']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Luas Kamar</td>
                    <td><?php echo $data['luas_kamar']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Letak Lantai</td>
                    <td><?php echo $data['lantai_kamar']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Kapasitas</td>
                    <td><?php echo $data['kapasitas_kamar'].' orang';?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Deskripsi Kamar</td>
                    <td><?php echo $data['deskripsi_kamar']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Harga Bulanan</td>
                    <td><?php echo 'Rp '.number_format($data['harga_bulanan']); ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Layanan Tambahan</td>
                    <td><?php echo $data['nama_layanan'].' ('.'Rp '.number_format($data['harga_layanan']).')';?></td>
                </tr>                
                <tr>
                    <td class="font-weight-bold" width="30%">Total Harga Bulanan</td>
                    <td><?php echo 'Rp '.number_format($data['harga_bulanan_total']); ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Denda (Jika Melewati Tenggat Pembayaran)</td>
                    <td><?php echo 'Rp '.number_format($data['denda']); ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Total Yang Harus Dibayar</td>
                    <td class="font-weight-bold text-success"><?php echo 'Rp '.number_format($data['harga_bulanan_total']); ?></td>
                </tr>
                <tr>
                  <td width="0%"></td>
                  <td class="font-weight-bold" width="100%">Lakukan Pembayaran Booking Kamar ke no. Rekening 123456789 (BCA) A.N. Nada Hasni Muhammad. Upload Struk (Bukti Bayar) dibawah ini</td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>
<?php
        }
    }
?>
  <div class="form-group">
    <label class="ml-4 font-weight-bold text-danger" for="profil">Upload Bukti Pembayaran (Lakukan Pembayaran Terlebih Dahulu Untuk Memesan Kamar)</label>
    <input value="<?php echo $data['foto_kamar']; ?>" type="file" class="form-control-file ml-4" id="profil" name="profil" aria-describedby="profil" accept="image/*" required>
  </div>

  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="submitBooking" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Booking Kamar</button>
  </div>
</form>
<?php
  }
?>

</html>