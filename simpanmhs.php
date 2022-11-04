<?php
    include 'koneksi.php';

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomorhp = $_POST['nomorhp'];
    $email = $_POST['email'];

    $query = mysqli_query($conn, "insert into mahasiswa (nim, nama, alamat, nomorhp, email) VALUES (".$nim.", '".$nama."', '".$alamat."', '".$nomorhp."', '".$email."')");
    mysqli_close($conn);

    header("Location:mahasiswa.php");
?>