<?php 

    ob_start();
    session_start();

    function cekAkses(){
        if(!isset($_SESSION['akun_id'])){
            header("location: ../landing-page.php");
        }

        // cek hak akses
        if(isset($_SESSION['akun_id'])){
            if($_SESSION['hak_akses'] == 1){
                header("location: http://localhost/indiekostappstes/app/admin/index.php");
            } 
            elseif($_SESSION['hak_akses'] == 2){
                header("location: http://localhost/indiekostappstes/app/admin/index.php");
            }
            elseif($_SESSION['hak_akses'] == 2){
                header("location: /app/calon-penghuni/index.php");
            } 
        }
    }

?>