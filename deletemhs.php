<?php
    include 'koneksi.php';
    // menyimpan data id kedalam variabel
    $id = $_GET['id'];
    // query SQL untuk insert data
    mysqli_query($conn, "DELETE from mahasiswa where nim='$id'");
    // mengalihkan ke halaman mahasiswa.php
    header("location:mahasiswa.php");
?>