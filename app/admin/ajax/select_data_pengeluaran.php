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
    
    if(isset($_POST['id_pengeluaran'])){
        $id_pengeluaran = $_POST['id_pengeluaran'];
        $query = "SELECT * FROM pengeluaran, jenis_pengeluaran WHERE id_pengeluaran = $id_pengeluaran AND pengeluaran.id_jenis_pengeluaran = jenis_pengeluaran.id_jenis_pengeluaran";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<div class="container-fluid">
    <a href="../../img/<?php
    if ($data['bukti_pengeluaran'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['bukti_pengeluaran']; 
    }
     ?>" data-lightbox="<?php echo $data['id_pengeluaran']; ?>" data-tittle="<?php
     if ($data['bukti_pengeluaran'] == NULL) {
         echo 'profile-img-none.png';
     } else {
         echo $data['bukti_pengeluaran']; 
     }
      ?>">
        <img src="../../img/<?php
    if ($data['bukti_pengeluaran'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['bukti_pengeluaran']; 
    }
     ?>" alt="<?php echo $data['nama_pengeluaran']; ?>" class="img-thumbnail mx-auto d-block mb-3 rounded"
            width="300px"> </a>
    <div class="table-respomsive">
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-weight-bold" width="30%">Kategori</td>
                    <td><?php echo $data['kategori_pengeluaran']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Nama Pengeluaran</td>
                    <td><?php echo $data['nama_pengeluaran']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Tanggal Pembayaran</td>
                    <td><?php echo $data['tanggal_pengeluaran']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Nominal</td>
                    <td><?php echo 'Rp. '.number_format($data['nilai_pengeluaran']); ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Keterangan</td>
                    <td><?php echo $data['keterangan']; ?></td>
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