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
    
    if(isset($_POST['id_kamar'])){
        $id_kamar = $_POST['id_kamar'];

        $query = "SELECT kamar.foto_kamar ,kamar.nomor_kamar, tipe_kamar.nama_tipe, kamar.luas_kamar, kamar.lantai_kamar, kamar.kapasitas_kamar, kamar.deskripsi_kamar, layanan.nama_layanan, kamar.harga_bulanan, kamar.denda, layanan.harga_bulanan AS harga_layanan, (kamar.harga_bulanan + layanan.harga_bulanan) AS harga_bulanan_total FROM kamar, tipe_kamar, layanan
        WHERE
            kamar.id_tipe = tipe_kamar.id_tipe AND
            kamar.id_layanan = layanan.id_layanan AND
            kamar.id_kamar = '$id_kamar'";

        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
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
            </tbody>
        </table>
    </div>
</div>
<?php
        }
    }
?>

</html>