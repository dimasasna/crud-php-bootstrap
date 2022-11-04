<?php      
    include('koneksi.php');  
    $username = $_POST['user'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "select * from login where username = '$username' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count > 0){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            header("location:mahasiswa.php");
        }else{
            header("location:index.php");	
        } 
?>