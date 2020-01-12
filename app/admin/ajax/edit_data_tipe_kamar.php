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
    if(isset($_POST['id_tipe'])){
        $id_tipe = $_POST['id_tipe'];
        $query = "SELECT * FROM tipe_kamar WHERE id_tipe = $id_tipe";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $data['id_tipe']; ?>">
  <div class="form-group">
    <label for="namaTipe">Nama Tipe Kamar</label>
    <input value="<?php echo $data['nama_tipe']; ?>" type="text" class="form-control" id="namaTipe" name="namaTipe"
      aria-describedby="Nomor induk kewarganegaraan" placeholder="Masukkan NIK baru" required>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_tipe_kamar" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

</html>