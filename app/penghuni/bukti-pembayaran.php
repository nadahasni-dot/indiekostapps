<?php 

include '../../actions/koneksi.php';

ob_start();
session_start();

if (!isset($_SESSION['akun_id'])){
  header("location: ../../landing-page.php");
} 
elseif (isset($_SESSION['akun_id'])){
  if($_SESSION['hak_akses'] == 1){
    header("location: ../admin/admin-dashboard.php");
  }
  elseif($_SESSION['hak_akses'] == 3){
    header("location: ../calon-penghuni/calon-dashboard.php");
  } 
}

?>

<?php
    if (!$_GET['id_pembayaran']) {
      echo "
      <script>        
        document.location.href = 'penghuni-pembayaran.php';
      </script>
      ";
    }

    if ($_GET['id_pembayaran']) {
      
    $id = $_GET['id_pembayaran'];

    // select data pembayaran
    $query = "SELECT *, DATE_FORMAT(pembayaran.tanggal_pembayaran, '%d %M %Y') AS tanggal_bayar FROM pembayaran, menghuni, kamar, pengguna, jenis_status_pembayaran
    WHERE pembayaran.id_menghuni = menghuni.id_menghuni AND
      menghuni.id_kamar = kamar.id_kamar AND
      menghuni.id_pengguna = pengguna.id_pengguna AND
      pembayaran.id_status = jenis_status_pembayaran.id_status AND pembayaran.id_pembayaran = '$id'";

    $result = mysqli_query($conn, $query);
    $dataPembayaran = mysqli_fetch_array($result);

    // select data kost
    $query = "SELECT * FROM info_kost WHERE id_kost = 1";

    $result = mysqli_query($conn, $query);
    $dataKost = mysqli_fetch_array($result);

    // select pemilik
    $query = "SELECT * FROM pengguna WHERE id_akses = 1";

    $result = mysqli_query($conn, $query);
    $dataPemilik = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title id="tittle"><?php echo 'PembayaranKamarNo. '.$dataPembayaran['nomor_kamar'].' '.$dataPembayaran['tanggal_pembayaran']; ?></title>
  <style type="text/css">    
    .style1 {
      font-size: large
    }

    body{
      max-height: 500px;
    }
  </style>
</head>

<body>



<table width="910" border="0" align="center" cellpadding="0" cellspacing="0">    
    <tr height="20px"></tr>
    <tr>
      <td width="100%" colspan="4">
        <div align="center" class="style1"><strong><?php echo strtoupper($dataKost['nama_kost']); ?></strong><br>
          <?php echo $dataKost['alamat_kost']; ?>, Telp <?php echo $dataKost['no_kost']; ?> <?php echo $dataKost['kota_kost']; ?> <?php echo $dataKost['provinsi_kost']; ?><br>
          Website : indiekost.mif-project.com E-Mail : <?php echo $dataKost['email_kost']; ?> </div>
      </td>    
    <tr>
      <td colspan="4"></td>
    </tr>
    <tr>
      <td colspan="4">
        <hr noshade>
      </td>
    </tr>
    <tr>      
      <td width="25%">
        <strong>ID PEMBAYARAN: <?php echo $dataPembayaran['id_pembayaran']; ?></strong>
      </td>
      <td width="25%">
        
      </td>
      <td width="25%"></td>
      <td width="25%"><strong>NO. KAMAR: <?php echo $dataPembayaran['nomor_kamar']; ?></strong></td>
    </tr>
    <tr height="30px">      
      <td width="25%"></td>
      <td width="25%"></td>
      <td width="25%"></td>
      <td width="25%"></td>
    </tr>
    <tr height="30px">      
      <td width="25%"><strong>PEMBAYAR </strong></td>
      <td width="25%">: <?php echo strtoupper($dataPembayaran['nama_pengguna']); ?></td>
      <td width="25%"></td>
      <td width="25%"></td>
    </tr>
    <tr height="30px">      
      <td width="25%"><strong>TANGGAL BAYAR</strong></td>
      <td width="25%">: <?php echo strtoupper($dataPembayaran['tanggal_bayar']); ?></td>
      <td width="25%"></td>
      <td width="25%"></td>
    </tr>
    <tr height="30px">      
      <td width="25%"><strong>NILAI PEMBAYARAN</strong></td>
      <td width="25%">: <?php echo 'Rp. '.number_format($dataPembayaran['nilai_pembayaran']); ?></td>
      <td width="25%"></td>
      <td width="25%"></td>
    </tr>
    <tr height="30px">      
      <td width="26%"><strong>KETERANGAN PEMBAYARAN</strong></td>
      <td width="74%" colspan="3">: <?php echo strtoupper($dataPembayaran['keterangan']); ?></td>            
    </tr>
    <tr height="30px">      
      <td width="26%"><strong>STATUS </strong></td>
      <td width="74%" colspan="3">: <?php echo strtoupper($dataPembayaran['nama_status_pembayaran']); ?></td>    
    </tr>
    <tr height="30px">      
      <td width="26%"></td>
      <td width="74%" colspan="3"></td>    
    </tr>
    <tr height="30px">      
      <td ></td>
      <td ></td>      
      <td colspan="2"><div align="center"><strong>PEMILIK KOST</strong></td>
    </tr>
    <tr height="30px">      
      <td align="center"><button name="cetak" type="button" id="cetak" value="Cetak" onClick="Cetakan()">CETAK BUKTI PEMBAYARAN</button></td>
      <td ></td>      
      <td colspan="2"><div align="center"><img width="200px" src="../../images/ttdscan.png" alt="TTD PEMILIK"></div></td>
    </tr>
    <tr height="30px">      
      <td ></td>
      <td ></td>      
      <td colspan="2"><div align="center"><strong><?php echo strtoupper($dataPemilik['nama_pengguna']); ?></strong></td>
    </tr>
  </table>
  
  

<script>
function Cetakan()
{ 
  var x = document.getElementsByName("cetak");
  for(i = 0; i < x.length ; i++)
  {
  		x[i].style.visibility = "hidden";
  }

  window.print();
  alert("Jangan di tekan tombol OK sebelum dokumen selesai tercetak!");
  for(i = 0; i < x.length ; i++)
  {
  		x[i].style.visibility = "visible";
  }
}
</script>

<?php } ?>
</body>

</html>