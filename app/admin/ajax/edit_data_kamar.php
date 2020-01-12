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
<form action="../../actions/process-update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $data['id_kamar']; ?>">
  <input type="hidden" name="fotoLama" value="<?php echo $data['foto_kamar']; ?>">
  <div class="form-group">
    <label for="nomorKamar">Nomor Kamar</label>
    <input value="<?php echo $data['nomor_kamar']; ?>" type="number" class="form-control" id="nomorKamar" name="nomorKamar"
      aria-describedby="Nomor Kamar" placeholder="Masukkan nomor kamar baru" required>
  </div>
  <div class="form-group">
    <label for="tipe">Tipe Kamar</label>
    <select name="tipe" class="form-control" id="tipe" required>
      <option selected disabled value="">Pilih Layanan</option>

      <?php 
        $query = "SELECT * FROM tipe_kamar";

        $result = mysqli_query($conn, $query);

        while ($dataTipe = mysqli_fetch_array($result)) {
          if($dataTipe['nama_tipe'] == $data['nama_tipe']){
      ?>
      <option selected value="<?php echo $dataTipe['id_tipe'] ?>"><?php echo $dataTipe['nama_tipe']; ?></option>
      <?php   
          } else {        
      ?>
      <option  value="<?php echo $dataTipe['id_tipe'] ?>"><?php echo $dataTipe['nama_tipe']; ?></option>
      <?php 
          }
        } 
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="luas">Luas Kamar</label>
    <input value="<?php echo $data['luas_kamar']; ?>" type="text" class="form-control" id="luas" name="luas"
      aria-describedby="luas" placeholder="Masukkan luas kamar baru" required>
  </div>
  <div class="form-group">
    <label for="lantai">Letak Lantai</label>
    <input value="<?php echo $data['lantai_kamar']; ?>" type="number" class="form-control" id="lantai" name="lantai"
      aria-describedby="lantai" placeholder="Masukkan letak lantai baru" required>
  </div>
  <div class="form-group">
    <label for="kapasitas">Kapasitas Hunian</label>
    <input value="<?php echo $data['kapasitas_kamar']; ?>" type="number" class="form-control" id="kapasitas" name="kapasitas"
      aria-describedby="kapasitas" placeholder="Masukkan kapasitas baru" required>
  </div>
  <div class="form-group">
    <label for="deskripsi">Deskripsi Kamar</label>
    <textarea type="text" class="form-control" id="deskripsi"
      name="deskripsi" aria-describedby="deskripsi" placeholder="Masukkan deskripsi baru" rows="3" required><?php echo $data['deskripsi_kamar']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="hargaBulanan">Harga Bulanan</label>
    <input value="<?php echo $data['harga_bulanan']; ?>" type="text" class="form-control" id="hargaBulanan" name="hargaBulanan"
      aria-describedby="hargaBulanan" placeholder="Masukkan harga bulanan baru" required>
  </div>
  <div class="form-group">
    <label for="layanan">Layanan</label>
    <select name="layanan" class="form-control" id="layanan" required>
      <option selected disabled value="">Pilih Layanan</option>

      <?php 
        $query = "SELECT * FROM layanan";

        $result = mysqli_query($conn, $query);

        while ($dataLayanan = mysqli_fetch_array($result)) {
          if($dataLayanan['nama_layanan'] == $data['nama_layanan']){
      ?>
      <option selected value="<?php echo $dataLayanan['id_layanan']; ?>"><?php echo $dataLayanan['nama_layanan'].' (Rp '.number_format($dataLayanan['harga_bulanan']).')'; ?></option>
      <?php   
          } else {        
      ?>
      <option  value="<?php echo $dataLayanan['id_layanan']; ?>"><?php echo $dataLayanan['nama_layanan'].' (Rp '.number_format($dataLayanan['harga_bulanan']).')'; ?></option>
      <?php 
          }
        } 
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="denda">Denda</label>
    <input value="<?php echo $data['denda']; ?>" type="text" class="form-control" id="denda"
      name="denda" aria-describedby="denda" placeholder="Masukkan denda baru" required>
  </div>
  <div class="form-group">
    <label for="profil">Foto Kamar</label>
    <input value="<?php echo $data['foto_kamar']; ?>" type="file" class="form-control-file" id="profil" name="profil" aria-describedby="profil" accept="image/*">
  </div>

  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_kamar" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

</html>