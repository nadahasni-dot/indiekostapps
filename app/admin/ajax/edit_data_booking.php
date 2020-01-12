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
    // select data untuk update
    if(isset($_POST['id_booking'])){
        $id_booking = $_POST['id_booking'];
        $query = "SELECT * FROM booking, kamar, pengguna WHERE id_booking = $id_booking AND booking.id_kamar = kamar.id_kamar AND booking.id_pengguna = pengguna.id_pengguna";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id_booking; ?>">
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
      </tbody>
    </table>
  </div>
  <div class="form-group">
    <label for="status">Status Konfirmasi Booking</label>
    <select name="status" class="form-control" id="status" required>
      <option selected disabled value="">Pilih Status Konfirmasi</option>

      <?php                 
          if($data['status_booking'] == 'belum dikonfirmasi'){                     
      ?>

      <option selected value="belum dikonfirmasi">
        <?php echo strtoupper('belum dikonfirmasi'); ?></option>
      <option value="sudah dikonfirmasi">
        <?php echo strtoupper('sudah dikonfirmasi'); ?></option>

      <?php } else {?>
      <option value="belum dikonfirmasi">
        <?php echo strtoupper('belum dikonfirmasi'); ?></option>
      <option selected value="sudah dikonfirmasi">
        <?php echo strtoupper('sudah dikonfirmasi'); ?></option>

      <?php                       
        }
      
      ?>
    </select>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_booking" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>


</html>