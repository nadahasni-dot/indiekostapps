<!-- QUERY UNTUK MENAMPILKAN DATA KAMAR -->
<?php 
include '../../../actions/koneksi.php';

$query = "SELECT kamar.id_kamar, kamar.nomor_kamar, kamar.foto_kamar, tipe_kamar.nama_tipe, layanan.nama_layanan, layanan.harga_bulanan AS harga_layanan, kamar.harga_bulanan, (kamar.harga_bulanan + layanan.harga_bulanan) AS total_harga, kamar.deskripsi_kamar, kamar.kapasitas_kamar, kamar.luas_kamar, kamar.lantai_kamar FROM kamar
LEFT JOIN menghuni ON menghuni.id_kamar = kamar.id_kamar
LEFT JOIN booking ON kamar.id_kamar = booking.id_kamar
  INNER JOIN tipe_kamar ON kamar.id_tipe = tipe_kamar.id_tipe
  INNER JOIN layanan ON kamar.id_layanan = layanan.id_layanan

  WHERE menghuni.id_kamar IS NULL AND booking.id_kamar IS NULL
  ORDER BY kamar.nomor_kamar ASC";

$result = mysqli_query($conn, $query);

while ($data_kamar = mysqli_fetch_array($result)) {
  
?>
<div class="col col-12 col-sm-6 col-lg-3 mb-4 d-flex align-items-stretch">
  <div class="card">

    <div class="no-kamar"><span class="font-weight-bold"><?php echo $data_kamar['nomor_kamar']; ?></span>
    </div>

    <?php if($data_kamar['foto_kamar'] == NULL){ ?>

    <img src="../../img/profile-img-none.png" height="200px" class="card-img-top" alt="...">

    <?php } else { ?>
    <img src="../../img/<?php echo $data_kamar['foto_kamar']; ?>" height="200px" class="card-img-top"
      alt="...">
    <?php } ?>

    <div class="d-flex flex-column card-body">
      <h6 class="card-title small"><span class="font-weight-bold">Tipe:</span>
        <?php echo strtoupper($data_kamar['nama_tipe']); ?></h6>

      <p class="card-text"><span class="font-weight-bold small">Luas:</span>
        <?php echo $data_kamar['luas_kamar'];  ?></p>

      <p class="card-text"><span class="font-weight-bold small">Lantai:</span>
        <?php echo $data_kamar['lantai_kamar'];  ?></p>

      <p class="card-text"><span class="font-weight-bold small">Deskripsi:</span>
        <?php                     
        if(strlen($data_kamar['deskripsi_kamar']) > 50){
          $data_kamar['deskripsi_kamar'] = substr($data_kamar['deskripsi_kamar'], 0, 47).' ...';
        }
          
        echo $data_kamar['deskripsi_kamar'];  
        ?></p>

      <p class="card-text"><span class="font-weight-bold small">Harga Bulanan:</span>
        <?php echo 'Rp. '.number_format($data_kamar['total_harga']);  ?></p>

      <div class="btn-group mt-auto" role="group" aria-label="Basic example">
        <button name="view" value="view" id="<?php echo $data_kamar['id_kamar']; ?>"
          class="btn btn-outline-primary view_data">Lihat Detail</button>
        <button name="view" value="view" id="<?php echo $data_kamar['id_kamar']; ?>"
          class="btn btn-outline-success booking_kamar">Booking</button>
      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>
