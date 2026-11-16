<?php
$db_host = 'localhost';
$db_user = 'dbdev';
$db_pass = 'isi_password_kamu';
$db_name = 'db_ppdb_smk';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
