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
    
    if(isset($_POST['id_booking'])){
        $id_booking = $_POST['id_booking'];
        $query = "SELECT * FROM booking, kamar, pengguna WHERE id_booking = $id_booking AND booking.id_kamar = kamar.id_kamar AND booking.id_pengguna = pengguna.id_pengguna";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<div class="container-fluid">
    <a href="../../img/<?php
    if ($data['bukti_booking'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['bukti_booking']; 
    }
     ?>" data-lightbox="<?php echo $data['id_booking']; ?>" data-tittle="<?php
     if ($data['bukti_booking'] == NULL) {
         echo 'profile-img-none.png';
     } else {
         echo $data['bukti_booking']; 
     }
      ?>">
        <img src="../../img/<?php
    if ($data['bukti_booking'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['bukti_booking']; 
    }
     ?>" alt="<?php echo $data['tanggal_booking']; ?>" class="img-thumbnail mx-auto d-block mb-3 rounded"
            width="300px"> </a>
    <div class="table-respomsive">
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-weight-bold" width="30%">No. Kamar</td>
                    <td><?php echo 'Kamar no.'.$data['nomor_kamar']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Pemesan</td>
                    <td><?php echo $data['nama_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Tanggal Booking</td>
                    <td><?php echo $data['tanggal_booking']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Nominal</td>
                    <td><?php echo 'Rp. '.number_format($data['nilai_booking']); ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Status Booking</td>
                    <td><?php echo strtoupper($data['status_booking']); ?></td>
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