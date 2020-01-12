<?php header("Content-type: text/css; charset: UTF-8"); ?>

<?php 
  include '../actions/koneksi.php';

  $query = "SELECT * FROM info_kost";
  $result = mysqli_query($conn, $query);

  while ($data = mysqli_fetch_array($result)) {
?>

.jumbotron {
  background-image: url(../img/<?php echo $data['foto_kos.jpg']; ?>);
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

<?php } ?>
