<!doctype html>
<html lang="en">
<?php 
    include '../../../actions/koneksi.php';
    ob_start();
    session_start();

    if (!isset($_SESSION['akun_id'])){
      header("location: ../../../landing-page.php");
    } 
    elseif (isset($_SESSION['akun_id'])){
      if($_SESSION['hak_akses'] == 2){
        header("location: ../../penghuni/penghuni-dashboard.php");
      }
      elseif($_SESSION['hak_akses'] == 3){
        header("location: ../../calon-penghuni/calon-dashboard.php");
      } 
    }
    
    if(isset($_POST['id_pembayaran'])){
        $id_pembayaran = $_POST['id_pembayaran'];
        $query = "SELECT * FROM pembayaran, menghuni, kamar, pengguna, jenis_status_pembayaran WHERE id_pembayaran = $id_pembayaran AND pembayaran.id_menghuni = menghuni.id_menghuni AND menghuni.id_kamar = kamar.id_kamar AND menghuni.id_pengguna = pengguna.id_pengguna AND pembayaran.id_status = jenis_status_pembayaran.id_status";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<div class="container-fluid">
    <a href="../../img/<?php
    if ($data['bukti_pembayaran'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['bukti_pembayaran']; 
    }
     ?>" data-lightbox="<?php echo $data['id_pembayaran']; ?>" data-tittle="<?php
     if ($data['bukti_pembayaran'] == NULL) {
         echo 'profile-img-none.png';
     } else {
         echo $data['bukti_pembayaran']; 
     }
      ?>">
        <img src="../../img/<?php
    if ($data['bukti_pembayaran'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['bukti_pembayaran']; 
    }
     ?>" alt="<?php echo $data['tanggal_pembayaran']; ?>" class="img-thumbnail mx-auto d-block mb-3 rounded"
            width="300px"> </a>
    <div class="table-respomsive">
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-weight-bold" width="30%">No. Kamar</td>
                    <td><?php echo 'Kamar no.'.$data['nomor_kamar']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Penghuni</td>
                    <td><?php echo $data['nama_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Tanggal Pembayaran</td>
                    <td><?php echo $data['tanggal_pembayaran']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Nominal</td>
                    <td><?php echo 'Rp. '.number_format($data['nilai_pembayaran']); ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Keterangan</td>
                    <td><?php echo $data['keterangan']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Status Konfirmasi Pembayaran</td>
                    <td><?php echo $data['nama_status_pembayaran']; ?></td>
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