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
    if(isset($_POST['id_kost'])){
        $id_kost = $_POST['id_kost'];
        $query = "SELECT * FROM info_kost, pengguna WHERE info_kost.id_pengguna = pengguna.id_pengguna";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $data['id_kost']; ?>">
  <input type="hidden" name="fotoLama" value="<?php echo $data['foto_kost']; ?>">
  <div class="form-group">
    <label for="pemilik">Pemilik Kost</label>
    <input disabled value="<?php echo $data['nama_pengguna']; ?>" type="text" class="form-control" id="pemilik" name="pemilik"
      aria-describedby="Nomor induk kewarganegaraan" placeholder="Masukkan NIK baru" required>
  </div>
  <div class="form-group">
    <label for="nama">Nama Kost</label>
    <input value="<?php echo $data['nama_kost']; ?>" type="text" class="form-control" id="nama" name="nama_kost"
      aria-describedby="nama" placeholder="Masukkan nama baru" required>
  </div>
  <div class="form-group">
    <label for="jKost">Jenis Kost</label>
    <select name="jKost" class="form-control" id="jKost" required>
      <?php if ($data['jenis_kost'] == NULL) { ?>
      <option selected disabled value="">Pilih Jenis Kost</option>
      <option value="Kost Putra">Kost Putra</option>
      <option value="Kost Putri">Kost Putri</option>
      <?php } else if ($data['kelamin_pengguna'] == 'Kost Putra') { ?>
      <option disabled value="">Pilih Jenis Kost</option>
      <option selected value="Kost Putra">Kost Putra</option>
      <option value="Kost Putri">Kost Putri</option>
      <?php } else { ?>
      <option disabled value="">Pilih Jenis Kost</option>
      <option value="Kost Putra">Kost Putra</option>
      <option selected value="Kost Putri">Kost Putri</option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <input value="<?php echo $data['alamat_kost']; ?>" type="text" class="form-control" id="alamat" name="alamat"
      aria-describedby="alamat" placeholder="Masukkan alamat baru" required>
  </div>
  <div class="form-group">
    <label for="provinsi">Provinsi</label>
    <input value="<?php echo $data['provinsi_kost']; ?>" type="text" class="form-control" id="provinsi"
      name="provinsi" aria-describedby="provinsi" placeholder="Masukkan provinsi baru" required>
  </div>
  <div class="form-group">
    <label for="kota">Kota</label>
    <input value="<?php echo $data['kota_kost']; ?>" type="text" class="form-control" id="kota" name="kota"
      aria-describedby="kota" placeholder="Masukkan kota baru" required>
  </div>
  <div class="form-group">
    <label for="telepon">Telepon</label>
    <input value="<?php echo $data['no_kost']; ?>" type="telepon" class="form-control" id="telepon"
      name="telepon" aria-describedby="telepon" placeholder="Masukkan telepon baru" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input value="<?php echo $data['email_kost']; ?>" type="email" class="form-control" id="email" name="email"
      aria-describedby="email" placeholder="Masukkan email baru" required>
  </div>
  <div class="form-group">
    <label for="desc">Deskripsi Kost</label>
    <textarea type="textarea" class="form-control" id="desc" name="desc" placeholder="Masukkan keterangan tentang kost anda" rows="3" required><?php echo $data['deskripsi_kost']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="profil">Ubah Foto Kost</label>
    <input value="<?php echo $data['foto_kost']; ?>" type="file" class="form-control-file" id="profil" name="profil"
      aria-describedby="profil" accept="image/*">
  </div>


  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_info_kost" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
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
      aria-describedby="profil">
  </div>


  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_profil" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

</html>