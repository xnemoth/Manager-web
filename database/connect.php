<?php 
    $hostName = "localhost";
    $DBName = "id18216360_nemoth";
    $userName = "id18216360_nemo";
    $password = "Nemoth@12345";
    $port = 3306;
    //$socket = "C:/xampp/mysql/mysql.sock";

$conn =  mysqli_connect($hostName, $userName, $password, $DBName, $port);
?>