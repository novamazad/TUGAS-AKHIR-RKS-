<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Learning UNIVERSITAS</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" />
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
</head>

<body>
    <?php
        require_once 'includes/connection.php';
        session_start();
        $id = $_GET['id'];
    ?>
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navigation">
                <div class="padding-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fa fa-book"></i> E-Learning UNIVERSITAS
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix">
                <?php echo $_SESSION['nama'] ?>
                &nbsp;
                <a href="logout.php" class="btn btn-danger navbar-btn right">
                    <i class="fa fa-sign-out-alt"> Log Out</i>
                </a>
            </div>
        </div>
    </nav>
    <div id="content" class="mt-3">
        <div class="container card p-4">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" class="navigasi-breadcrumb">
                        <ol class="breadcrumb nav-breadcrumb">
                            <li class="breadcrumb-item"><a href="halaman_mahasiswa.php">Dashboard</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <h3>List Tugas Anda </h3>
            <div class="row">
                <?php
                    $iduser = $_SESSION['iduser'];
                    $data = mysqli_query($con, "SELECT *,(SELECT COUNT(*) 
                    FROM detailtugas WHERE nrp='$iduser') AS h FROM tugas 
                    WHERE id_matkul = '$id'");
                    while ($row = $data->fetch_assoc()) {
                ?>

                <div class="col-sm-3 mb-4">
                    <div class="card border-dark" style="max-width: 18rem;">
                        <div class="card-header">Tenggat : <?php echo $row['tanggal'] ?></div>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><?php echo $row['judul_tugas'] ?></h5>
                            <p class="card-text"><?php echo $row['deskripsi_tugas'] ?>
                                <?php
                                $idtugas = $row['id_tugas'];
                                $datadetail = mysqli_query($con, "SELECT COUNT(*) AS h 
                                FROM detailtugas 
                                WHERE id_tugas = '$idtugas' AND nrp='$iduser'");
                                $row2 = $datadetail->fetch_assoc();
                            ?>
                                <?php if ($row2['h'] == 1) { ?>
                                <h5><span class="badge badge-success">Sudah Mengumpulkan Tugas</span></h5>
                                <?php } else { ?>
                                <h5><span class="badge badge-danger">Belum Mengumpulkan Tugas</span></h5>
                                <?php } ?></p>
                            <a href="lihat_tugas.php?id=<?php echo $row['id_tugas']?>" class="btn btn-primary">Lihat
                                Tugas</a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>

            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>