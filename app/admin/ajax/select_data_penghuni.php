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
    
    if(isset($_POST['id_pengguna'])){
        $id_pengguna = $_POST['id_pengguna'];
        $query = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_array($result)) {
        
?>
<div class="container-fluid">
    <a href="../../img/<?php
    if ($data['foto_pengguna'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['foto_pengguna']; 
    }
     ?>" data-lightbox="../../img/<?php
     if ($data['foto_pengguna'] == NULL) {
         echo 'profile-img-none.png';
     } else {
         echo $data['foto_pengguna']; 
     }
      ?>" data-tittle="../../img/<?php
      if ($data['foto_pengguna'] == NULL) {
          echo 'profile-img-none.png';
      } else {
          echo $data['foto_pengguna']; 
      }
       ?>">
    <img src="../../img/<?php
    if ($data['foto_pengguna'] == NULL) {
        echo 'profile-img-none.png';
    } else {
        echo $data['foto_pengguna']; 
    }
     ?>" alt="<?php echo $data['nama_pengguna']; ?>" class="img-thumbnail mx-auto d-block mb-3 rounded" width="300px">
     </a>
    <div class="table-respomsive">
        <table class="table">
            <tbody>
                <tr>
                    <td class="font-weight-bold" width="30%">NIK</td>
                    <td><?php echo $data['no_ktp_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Nama</td>
                    <td><?php echo $data['nama_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Tanggal Lahir</td>
                    <td><?php echo $data['tanggal_lahir_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Jenis Kelamin</td>
                    <td><?php echo $data['kelamin_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Alamat</td>
                    <td><?php echo $data['alamat_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Provinsi</td>
                    <td><?php echo $data['provinsi_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Kota</td>
                    <td><?php echo $data['kota_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Telepon</td>
                    <td><?php echo $data['telepon_pengguna']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold" width="30%">Email</td>
                    <td><?php echo $data['email_pengguna']; ?></td>
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