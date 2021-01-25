<?php
    session_start();
    unset($_SESSION['iduser']);
    unset($_SESSION['level']);
    unset($_SESSION['nama']);
    session_destroy();
    header("location:index.php");
?>