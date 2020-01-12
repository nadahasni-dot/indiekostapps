<?php 
$conn = mysqli_connect("localhost","root","","db_indiekost");
 
	// Check connection
	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}

	// fungsi untuk pengamanan injeksi sql
	// function secure($data){
	// 	$data_secure = mysqli_real_escape_string($data);
		
	// 	return $data_secure;
	// }
?>