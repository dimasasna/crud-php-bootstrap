<?php
    include 'koneksi.php';
    session_start();
    // jika variabel $_SESSION["user"] tidak memiliki nilai, maka user belum login… paksa dia untuk login z
    if(!isset($_SESSION["username"])){
    header("Location: index.php");
    }
    // DEKLARASI VARIABLE UNTUK DI FORM DAN ALERT HTML
    $nim = "";
    $nama = "";
    $alamat = "";
    $nomorhp = "";
    $email = "";
    $error = "";
    $errorgakbalik = "";
    $sukses = "";


    // mengambil data op di update dan delete
    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    } else {
        $op = "";
    }

    // fungsi delete mengambil dari variable op yang dikirim lewat url
    if($op == 'delete'){
        $id = $_GET['id'];
        $sql1 = "delete from mahasiswa where nim = '$id'";
        $q1 = mysqli_query($conn, $sql1);
        if($q1){
            $sukses = "Berhasil hapus data";
        }else{
            $error = "Gagal hapus data";
        }
    }

    // FUNGSI UPDATE UNTUK MENGAMBIL DATA DARI TABLE MAHASISWA
    if ($op == 'update') {
        $id         = $_GET['id'];
        $sql1       = "select * from mahasiswa where nim = '$id'";
        $q1         = mysqli_query($conn, $sql1);
        $r1         = mysqli_fetch_array($q1);
        $nim        = isset($r1['nim']) ? $r1['nim']: '';
        $nama       = isset($r1['nama']) ? $r1['nama']: '';
        $alamat     = isset($r1['alamat']) ? $r1['alamat']: '';
        $nomorhp    = isset($r1['nomorhp']) ? $r1['nomorhp']: '';
        $email      = isset($r1['email']) ? $r1['email']: '';

        if($nim == ''){
            $error = "Data tidak ditemukan";
        }
    }

    if (isset($_POST['submit'])) { //UNTUK CREATE DAN UPDATE
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $nomorhp = $_POST['nomorhp'];
        $email = $_POST['email'];

        if ($nim && $nama && $alamat && $nomorhp && $email) {
            if ($op == 'update') { //FUNGSI UNTUK UPDATE
                $sql1 = "update mahasiswa set nim = $nim, nama ='$nama', alamat ='$alamat', nomorhp ='$nomorhp', email ='$email' where nim = '$id' ";
                $q1 = mysqli_query($conn, $sql1);
                if ($q1) {
                    $sukses = "Data berhasil diupdate";
                } else {
                    $error = "Data gagal diupdate";
                }
            } else { //FUNGSI UNTUK CREATE
                $sql1 = "insert into mahasiswa (nim, nama, alamat, nomorhp, email) VALUES (" . $nim . ", '" . $nama . "', '" . $alamat . "', '" . $nomorhp . "', '" . $email . "')";
                $q1 = mysqli_query($conn, $sql1);
                if ($q1) {
                    $sukses     = "Berhasil Memasukan Data Baru";
                } else {
                    $errorgakbalik      = "Gagal Memasukan Data. NIM sudah ada";
                }
            }
        } else {
            $errorgakbalik = "Silahkan Masukan Semua Data";
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PWD CRUD</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <!-- INPUT MAHASISWA -->
    <div class="container mb-5 mt-4">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>


        <nav class="navbar mb-3" style="background-color: #e3f2fd">
            Input dan Update Data Mahasiswa
        </nav>
        <?php
        if ($error) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
        <?php
        header("refresh:2;url=mahasiswa.php");
        }
        ?>
        <?php
        if ($errorgakbalik) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorgakbalik ?>
            </div>
        <?php
        }
        ?>
        <?php
        if ($sukses) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses ?>
            </div>
        <?php
        header("refresh:2;url=mahasiswa.php");
        }
        ?>
        <form class="row g-3" method="POST" action="">
            <div class="col-md-6">
                <label for="inputnim" class="form-label">NIM</label>
                <input type="text" class="form-control" name="nim" value="<?php echo $nim ?>">
            </div>
            <div class="col-md-6">
                <label for="inputnama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $nama ?>">
            </div>
            <div class="col-12">
                <label for="inputalamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" placeholder="1234 Main St" value="<?php echo $alamat ?>">
            </div>
            <div class="col-md-6">
                <label for="inputhp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" name="nomorhp" value="<?php echo $nomorhp ?>">
            </div>
            <div class="col-md-6">
                <label for="inputemail" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
            </div>
        </form>
    </div>

    <!-- OUTPUT MAHASISWA -->
    <div class="container mb-5">
        <nav class="navbar" style="background-color: #e3f2fd">
            Daftar Mahasiswa
        </nav>
        <div class="table-responsive">
        <?php
        include 'koneksi.php';
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col'>No</th>";
        echo "<th scope='col'>NIM</th>";
        echo "<th scope='col'>Nama</th>";
        echo "<th scope='col'>Alamat</th>";
        echo "<th scope='col'>Nomor HP</th>";
        echo "<th scope='col'>Email</th>";
        echo "<th scope='col'>Action</th>";
        echo "</tr>";
        echo "</thead>";
        $tampil = mysqli_query($conn, "SELECT * FROM mahasiswa");
        $i = 1;
        echo "<tbody>";
        foreach ($tampil as $row) {
            echo "<tr>";
            echo "<th scope='row'>" . $i . "</th>";
            echo "<td>" . $row["nim"] . "</td>";
            echo "<td>" . $row["nama"] . "</td>";
            echo "<td>" . $row["alamat"] . "</td>";
            echo "<td>" . $row["nomorhp"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td><a href='mahasiswa.php?op=update&id=$row[nim]'>Update</a></td>";
            echo "<td><a href='mahasiswa.php?op=delete&id=$row[nim]'>Delete</a></td>";
            echo "</tr>";
            $i++;
        }
        echo "</tbody>";
        echo "</table>";
        ?>
        </div>        
    </div>
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>