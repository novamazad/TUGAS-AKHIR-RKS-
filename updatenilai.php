<?php
    require_once 'includes/connection.php';
    $idDetail = $_GET['id_detail'];
    $nilai = $_GET['nilai'];
    $idTugas = $_GET['id_tugas'];
    mysqli_query($con,"UPDATE detailtugas SET nilai = '$nilai' WHERE id_detail_tugas='$idDetail'");
    header("location:lihat_tugas_dosen.php?id=".$idTugas);
?>