<?php
require_once("includes/connection.php");
session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $data = mysqli_query($con, "select * from users where username='$username' and password='$password'");
    $cek = mysqli_num_rows($data);
    if($cek > 0){
        $row = mysqli_fetch_assoc($data);
        if($row['level']=="mahasiswa"){
            $data = mysqli_query($con, "select * from mahasiswa where nrp='$username'");
            $row = mysqli_fetch_assoc($data);
            $_SESSION['iduser'] = $row['nrp'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['level'] = "mahasiswa";
            header("location:halaman_mahasiswa.php");
        } else if($row['level']=="dosen"){
            $data = mysqli_query($con, "select * from dosen where nip='$username'");
            $row = mysqli_fetch_assoc($data);
            $_SESSION['iduser'] = $row['nip'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['level'] = "dosen";
            header("location:halaman_dosen.php");
        }
    }else
        header("location:index.php?pesan=gagal");
?>