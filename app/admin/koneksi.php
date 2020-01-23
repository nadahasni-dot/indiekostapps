<?php 
$conn = mysqli_connect("mif-project.com","u8823774_indiekost","mif2017","u8823774_indiekost");
 
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