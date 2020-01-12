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
    if(isset($_POST['id_pembayaran'])){
        $id_pembayaran = $_POST['id_pembayaran'];
        $query = "SELECT * FROM pembayaran WHERE id_pembayaran = $id_pembayaran";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id_pembayaran; ?>">
  <input type="hidden" name="fotoLama" value="<?php echo $data['bukti_pembayaran']; ?>">
  <div class="form-group">
    <label for="menghuni">Data Menghuni</label>
    <select name="menghuni" class="form-control" id="menghuni" required>
      <option selected disabled value="">Pilih Data Menghuni</option>

      <?php 
        $query = "SELECT * FROM menghuni, kamar, pengguna WHERE menghuni.id_kamar = kamar.id_kamar AND menghuni.id_pengguna = pengguna.id_pengguna";

        $result = mysqli_query($conn, $query);

        while ($dataMenghuni = mysqli_fetch_array($result)) {
          if($dataMenghuni['id_menghuni'] == $data['id_menghuni']) {                  
      ?>
      <option selected value="<?php echo $dataMenghuni['id_menghuni']; ?>">
        <?php echo 'Kamar no. '.$dataMenghuni['nomor_kamar'].' ['.$dataMenghuni['nama_pengguna'].']'; ?></option>
      <?php } else { ?>

      <option value="<?php echo $dataMenghuni['id_menghuni']; ?>">
        <?php echo 'Kamar no. '.$dataMenghuni['nomor_kamar'].' ['.$dataMenghuni['nama_pengguna'].']'; ?></option>

      <?php    
      }                   
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="tanggal">Tanggal Pembayaran</label>
    <input value="<?php echo $data['tanggal_pembayaran']; ?>" type="date" class="form-control" id="tanggal"
      name="tanggal" aria-describedby="tanggal" placeholder="Masukkan tanggal pengeluaran" required>
  </div>
  <div class="form-group">
    <label for="nominal">Nominal Pembayaran</label>
    <input value="<?php echo $data['nilai_pembayaran']; ?>" type="number" class="form-control" id="nominal"
      name="nominal" aria-describedby="nominal" placeholder="Masukkan nominal pembayaran" required>
  </div>
  <div class="form-group">
    <label for="keterangan">Keterangan</label>
    <textarea type="text" class="form-control" id="keterangan" name="keterangan" aria-describedby="keterangan" rows="3"
      placeholder="Masukkan keterangan pengeluaran" required><?php echo $data['keterangan']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="status">Status Konfirmasi Pembayaran</label>
    <select name="status" class="form-control" id="status" required>
      <option selected disabled value="">Pilih Status Konfirmasi</option>

      <?php 
        $query = "SELECT * FROM jenis_status_pembayaran";

        $result = mysqli_query($conn, $query);

        while ($dataStatus = mysqli_fetch_array($result)) { 
          if($dataStatus['id_status'] == $data['id_status']){                     
      ?>

      <option selected value="<?php echo $dataStatus['id_status']; ?>">
      <?php echo strtoupper($dataStatus['nama_status_pembayaran']); ?></option>

      <?php } else {?>

      <option value="<?php echo $dataStatus['id_status']; ?>">
      <?php echo strtoupper($dataStatus['nama_status_pembayaran']); ?></option>

      <?php                       
        }
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="profil">Bukti Pembayaran</label>
    <input value="" type="file" class="form-control-file" id="profil" name="profil" aria-describedby="profil"
      accept="image/*">
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_pembayaran" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>


</html>