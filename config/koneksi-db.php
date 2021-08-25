<?php

    $hostname   = "localhost";
    $user       = "root";
    $password   = "";
    $db_name    = "dbpus";

    $db_conn = mysqli_connect($hostname, $user, $password, $db_name);

    if(!$db_conn){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }

?>



<!-- 
    $hostname   = "mysql-db";
    $user       = "ihsan";
    $password   = "ihsanpass";
    $db_name    = "db_pus";

    $db_conn = mysqli_connect($hostname, $user, $password, $db_name);

    if(!$db_conn){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    } 

    $hostname   = "localhost";
    $user       = "root";
    $password   = "";
    $db_name    = "dbpus";

    $db_conn = mysqli_connect($hostname, $user, $password, $db_name);

    if(!$db_conn){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }

-->


