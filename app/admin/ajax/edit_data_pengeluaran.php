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
    if(isset($_POST['id_pengeluaran'])){
        $id_pengeluaran = $_POST['id_pengeluaran'];
        $query = "SELECT * FROM pengeluaran WHERE id_pengeluaran = $id_pengeluaran";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id_pengeluaran; ?>">
  <div class="form-group">
    <label for="jenis">Jenis Pengeluaran</label>
    <select name="jenis" class="form-control" id="jenis" required>
      <option selected disabled value="">Pilih Jenis Pengeluaran</option>

      <?php 
        $query = "SELECT * FROM jenis_pengeluaran";

        $result = mysqli_query($conn, $query);

        while ($dataJenis = mysqli_fetch_array($result)) {
          if($dataJenis['id_jenis_pengeluaran'] == $data['id_jenis_pengeluaran']){                  
      ?>

      <option selected value="<?php echo $dataJenis['id_jenis_pengeluaran']; ?>">
        <?php echo $dataJenis['nama_pengeluaran'].' ['.$dataJenis['kategori_pengeluaran'].']'; ?></option>

          <?php } else { ?>

      <option value="<?php echo $dataJenis['id_jenis_pengeluaran']; ?>">
        <?php echo $dataJenis['nama_pengeluaran'].' ['.$dataJenis['kategori_pengeluaran'].']'; ?></option>

      <?php   
          }                    
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="tanggal">Tanggal Pembayaran</label>
    <input value="<?php echo $data['tanggal_pengeluaran']; ?>" type="date" class="form-control" id="tanggal" name="tanggal" aria-describedby="tanggal"
      placeholder="Masukkan tanggal pengeluaran" required>
  </div>
  <div class="form-group">
    <label for="nominal">Nominal Pembayaran</label>
    <input value="<?php echo $data['nilai_pengeluaran']; ?>" type="number" class="form-control" id="nominal" name="nominal" aria-describedby="nominal"
      placeholder="Masukkan nominal pembayaran" required>
  </div>
  <div class="form-group">
    <label for="keterangan">Keterangan</label>
    <textarea type="text" class="form-control" id="keterangan" name="keterangan" aria-describedby="keterangan"
      rows="3" placeholder="Masukkan keterangan pengeluaran" required><?php echo $data['keterangan']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="profil">Bukti Pembayaran</label>
    <input value="" type="file" class="form-control-file" id="profil" name="profil" aria-describedby="profil"
      accept="image/*" required>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_pengeluaran" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

<?php 

    // select data untuk update
    if(isset($_POST['id_profil'])){
        $id_pengguna = $_POST['id_profil'];
        $query = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $data['id_pengguna']; ?>">
  <input type="hidden" name="fotoLama" value="<?php echo $data['foto_pengguna']; ?>">
  <div class="form-group">
    <label for="nik">NIK</label>
    <input value="<?php echo $data['no_ktp_pengguna']; ?>" type="text" class="form-control" id="nik" name="nik"
      aria-describedby="Nomor induk kewarganegaraan" placeholder="Masukkan NIK baru" required>
  </div>
  <div class="form-group">
    <label for="nama">Nama</label>
    <input value="<?php echo $data['nama_pengguna']; ?>" type="text" class="form-control" id="nama" name="nama"
      aria-describedby="nama" placeholder="Masukkan nama baru" required>
  </div>
  <div class="form-group">
    <label for="tgl">Tanggal Lahir</label>
    <input value="<?php echo $data['tanggal_lahir_pengguna']; ?>" type="date" class="form-control" id="tgl" name="tgl"
      aria-describedby="tgl" placeholder="Masukkan tanggal lahir baru" required>
  </div>
  <div class="form-group">
    <label for="jKelamin">Jenis Kelamin</label>
    <select name="jKelamin" class="form-control" id="jKelamin" required>
      <?php if ($data['kelamin_pengguna'] == NULL) { ?>
      <option selected disabled value="">Pilih Jenis Kelamin</option>
      <option value="Pria">Pria</option>
      <option value="Wanita">Wanita</option>
      <?php } else if ($data['kelamin_pengguna'] == 'Pria') { ?>
      <option disabled value="">Pilih Jenis Kelamin</option>
      <option selected value="Pria">Pria</option>
      <option value="Wanita">Wanita</option>
      <?php } else { ?>
      <option disabled value="">Pilih Jenis Kelamin</option>
      <option value="Pria">Pria</option>
      <option selected value="Wanita">Wanita</option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <input value="<?php echo $data['alamat_pengguna']; ?>" type="text" class="form-control" id="alamat" name="alamat"
      aria-describedby="alamat" placeholder="Masukkan alamat baru" required>
  </div>
  <div class="form-group">
    <label for="provinsi">Provinsi</label>
    <input value="<?php echo $data['provinsi_pengguna']; ?>" type="text" class="form-control" id="provinsi"
      name="provinsi" aria-describedby="provinsi" placeholder="Masukkan provinsi baru" required>
  </div>
  <div class="form-group">
    <label for="kota">Kota</label>
    <input value="<?php echo $data['kota_pengguna']; ?>" type="text" class="form-control" id="kota" name="kota"
      aria-describedby="kota" placeholder="Masukkan kota baru" required>
  </div>
  <div class="form-group">
    <label for="telepon">Telepon</label>
    <input value="<?php echo $data['telepon_pengguna']; ?>" type="telepon" class="form-control" id="telepon"
      name="telepon" aria-describedby="telepon" placeholder="Masukkan telepon baru" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input value="<?php echo $data['email_pengguna']; ?>" type="email" class="form-control" id="email" name="email"
      aria-describedby="email" placeholder="Masukkan email baru" required>
  </div>
  <div class="form-group">
    <label for="profil">Ubah Foto Profil</label>
    <input value="<?php echo $data['foto_pengguna']; ?>" type="file" class="form-control-file" id="profil" name="profil"
      aria-describedby="profil" accept="image/*">
  </div>


  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_profil" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

</html>