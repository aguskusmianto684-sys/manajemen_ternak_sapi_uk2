<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_manajemen_ternak";

$connect = mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
