<?php
    $hostname   = "mysql-db"; // localhost
    $user       = "ihsan"; // root
    $password   = "ihsanpass"; // null
    $db_name    = "db_pus"; // sama
    
    $db_conn = mysqli_connect($hostname, $user, $password, $db_name);

    if(!$db_conn){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    } 
?>