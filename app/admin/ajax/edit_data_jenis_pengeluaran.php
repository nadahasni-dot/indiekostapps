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
    if(isset($_POST['id_jenis_pengeluaran'])){
        $id_jenis_pengeluaran = $_POST['id_jenis_pengeluaran'];
        $query = "SELECT * FROM jenis_pengeluaran WHERE id_jenis_pengeluaran = $id_jenis_pengeluaran";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $data['id_jenis_pengeluaran']; ?>">
  <div class="form-group">
    <label for="kodePengeluaran">Kode Pengeluaran</label>
    <input value="<?php echo $data['kode_pengeluaran']; ?>" type="text" class="form-control" id="kodePengeluaran"
      name="kodePengeluaran" aria-describedby="Nomor induk kewarganegaraan" placeholder="Masukkan NIK baru" required>
  </div>

  <div class="form-group">
    <label for="kategori">Kategori</label>
    <select name="kategori" type="text" class="form-control" id="kategori"
      placeholder="Masukkan kategori pengeluaran anda" required>
      <?php 
        if ($data['kategori_pengeluaran'] == 'Biaya Operasional') {
        
      ?>
      <option value="">Pilih Kategori</option>
      <option selected value="Biaya Operasional">Biaya Operasional</option>
      <option value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
      <option value="Biaya Makanan">Biaya Makanan</option>
      <option value="Biaya Marketing">Biaya Marketing</option>
      <option value="Biaya Lainnya">Biaya Lainnya</option>
      <option value="Pajak">Pajak</option>
      <?php } elseif ($data['kategori_pengeluaran'] == 'Biaya Pemeliharaan') {?>
      <option value="">Pilih Kategori</option>
      <option value="Biaya Operasional">Biaya Operasional</option>
      <option selected value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
      <option value="Biaya Makanan">Biaya Makanan</option>
      <option value="Biaya Marketing">Biaya Marketing</option>
      <option value="Biaya Lainnya">Biaya Lainnya</option>
      <option value="Pajak">Pajak</option>
      <?php } elseif ($data['kategori_pengeluaran'] == 'Biaya Makanan') {?>
      <option value="">Pilih Kategori</option>
      <option value="Biaya Operasional">Biaya Operasional</option>
      <option value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
      <option selected value="Biaya Makanan">Biaya Makanan</option>
      <option value="Biaya Marketing">Biaya Marketing</option>
      <option value="Biaya Lainnya">Biaya Lainnya</option>
      <option value="Pajak">Pajak</option>
      <?php } elseif ($data['kategori_pengeluaran'] == 'Biaya Marketing') {?>
      <option value="">Pilih Kategori</option>
      <option value="Biaya Operasional">Biaya Operasional</option>
      <option value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
      <option value="Biaya Makanan">Biaya Makanan</option>
      <option selected value="Biaya Marketing">Biaya Marketing</option>
      <option value="Biaya Lainnya">Biaya Lainnya</option>
      <option value="Pajak">Pajak</option>
      <?php } elseif ($data['kategori_pengeluaran'] == 'Biaya Lainnya') {?>
      <option value="">Pilih Kategori</option>
      <option value="Biaya Operasional">Biaya Operasional</option>
      <option value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
      <option value="Biaya Makanan">Biaya Makanan</option>
      <option value="Biaya Marketing">Biaya Marketing</option>
      <option selected value="Biaya Lainnya">Biaya Lainnya</option>
      <option value="Pajak">Pajak</option>
      <?php } elseif ($data['kategori_pengeluaran'] == 'Pajak') {?>
      <option value="">Pilih Kategori</option>
      <option value="Biaya Operasional">Biaya Operasional</option>
      <option value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
      <option value="Biaya Makanan">Biaya Makanan</option>
      <option value="Biaya Marketing">Biaya Marketing</option>
      <option value="Biaya Lainnya">Biaya Lainnya</option>
      <option selected value="Pajak">Pajak</option>
      <?php } else {?>
      <option selected value="">Pilih Kategori</option>
      <option value="Biaya Operasional">Biaya Operasional</option>
      <option value="Biaya Pemeliharaan">Biaya Pemeliharaan</option>
      <option value="Biaya Makanan">Biaya Makanan</option>
      <option value="Biaya Marketing">Biaya Marketing</option>
      <option value="Biaya Lainnya">Biaya Lainnya</option>
      <option value="Pajak">Pajak</option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label for="namaPengeluaran">Nama Pengeluaran</label>
    <input value="<?php echo $data['nama_pengeluaran']; ?>" type="text" class="form-control" id="namaPengeluaran"
      name="namaPengeluaran" aria-describedby="nama" placeholder="Masukkan nama baru" required>
  </div>


  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_jenis_pengeluaran" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

</html>