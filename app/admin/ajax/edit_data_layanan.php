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
    if(isset($_POST['id_layanan'])){
        $id_layanan = $_POST['id_layanan'];
        $query = "SELECT * FROM layanan WHERE id_layanan = $id_layanan";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $data['id_layanan']; ?>">
  <div class="form-group">
    <label for="nik">Nama Layanan</label>
    <input value="<?php echo $data['nama_layanan']; ?>" type="text" class="form-control" id="namaLayanan" name="namaLayanan"
      aria-describedby="Nomor induk kewarganegaraan" placeholder="Masukkan NIK baru" required>
  </div>
  <div class="form-group">
    <label for="nama">Harga</label>
    <input value="<?php echo $data['harga_bulanan']; ?>" type="text" class="form-control" id="hargaLayanan" name="hargaLayanan"
      aria-describedby="nama" placeholder="Masukkan nama baru" required>
  </div>


  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_layanan" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

</html>