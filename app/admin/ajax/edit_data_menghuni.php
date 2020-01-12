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
    if(isset($_POST['id_menghuni'])){
        $id_menghuni = $_POST['id_menghuni'];
        $query = "SELECT * FROM menghuni, pengguna, kamar WHERE id_menghuni = $id_menghuni AND menghuni.id_pengguna = pengguna.id_pengguna AND kamar.id_kamar = menghuni.id_kamar";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<form action="../../actions/process-update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $data['id_menghuni']; ?>">  
  <div class="form-group">
    <label for="kamar">Pilih Kamar</label>
    <select name="kamar" class="form-control" id="kamar" required>
      <option disabled value="">Pilih Kamar</option>    
      <option selected value="<?php echo $data['id_kamar']; ?>"><?php echo 'Kamar. '.$data['nomor_kamar'].' (Asal Kamar)'; ?></option>

      <?php 
        $query = "SELECT kamar.nomor_kamar, kamar.id_kamar, 
        CASE
            WHEN kamar.id_kamar = (SELECT menghuni.id_kamar FROM menghuni WHERE menghuni.id_kamar = kamar.id_kamar)
          THEN
            (SELECT pengguna.nama_pengguna FROM pengguna, menghuni WHERE pengguna.id_pengguna = menghuni.id_pengguna AND  menghuni.id_kamar = kamar.id_kamar)
          ELSE
            'Belum dihuni'
          END AS penghuni
          
        FROM kamar";

        $result = mysqli_query($conn, $query);

        while ($dataHunian = mysqli_fetch_array($result)) {
          if($dataHunian['penghuni'] == 'Belum dihuni'){
      ?>
      <option value="<?php echo $dataHunian['id_kamar']; ?>">
        <?php echo 'Kamar. '.$dataHunian['nomor_kamar'].' ('.$dataHunian['penghuni'].')'; ?>
      </option>
      <?php   
          }                         
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="penghuni">Pilih Penghuni yang akan didaftarkan</label>
    <select name="penghuni" class="form-control" id="penghuni" required>
      <option disabled value="">Pilih Penghuni</option>
      <option selected value="<?php echo $data['id_pengguna'] ?>"><?php echo $data['nama_pengguna'] ?></option>

      <?php 
        $query = "SELECT pengguna.id_pengguna, pengguna.nama_pengguna
        FROM pengguna
        LEFT JOIN menghuni ON pengguna.id_pengguna = menghuni.id_pengguna
        WHERE menghuni.id_pengguna IS NULL AND pengguna.id_akses = 2";

        $result = mysqli_query($conn, $query);

        while ($dataPenggunaBelumMenghuni = mysqli_fetch_array($result)) {

      ?>
      <option value="<?php echo $dataPenggunaBelumMenghuni['id_pengguna'] ?>">
        <?php echo $dataPenggunaBelumMenghuni['nama_pengguna'].' (Belum Menghuni)'; ?>
      </option>
      <?php                                                 
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="tanggal">Tanggal Masuk</label>
    <input type="date" value="<?php echo $data['tanggal_masuk'] ?>" class="form-control" id="tanggal" name="tanggal" aria-describedby="tanggal"
      placeholder="Masukkan Tanggal Masuk" required>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    <button type="submit" name="update_menghuni" class="btn btn-primary"
      onclick="return confirm('Anda yakin ingin mengupdate data?');">Update</button>
  </div>
</form>
<?php
        }
    }
?>

</html>