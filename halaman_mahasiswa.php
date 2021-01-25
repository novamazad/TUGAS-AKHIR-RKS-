<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Elearning UNIVERSITAS</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" />
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
</head>

<body>
    <?php
        require_once 'includes/connection.php';
        session_start();
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
                Welcome, <?php echo $_SESSION['nama'] ?>
                &nbsp;
                <a href="logout.php" class="btn btn-danger navbar-btn right">
                    <i class="fa fa-sign-out-alt"> Log Out</i>
                </a>
            </div>
        </div>
    </nav>

    <div id="content" style="margin-top: 10px; ">
        <div class="container card p-4">
            <h3>List Mata Kuliah</h3>
            <div class="row">
                <?php
                    $id = $_SESSION['iduser'];
                    $query = "SELECT matakuliah.id_matkul AS id,matakuliah.nama_matkul AS mt,dosen.nama AS nm
                    FROM mahasiswa,kelas,matakuliah,dosen
                    WHERE mahasiswa.kd_kelas = kelas.kd_kelas
                    AND matakuliah.id_kelas = kelas.kd_kelas
                    AND dosen.nip = matakuliah.nip_dosen
                    AND mahasiswa.nrp = '$id'";
                    $data = $con->query($query);
                    while ($row = $data->fetch_assoc()) {
                ?>
                <div class="col-sm-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['mt'] ?></h5>
                            <p class="card-text">Dosen : <?php echo $row['nm'] ?></p>
                            <a href="lihat_matkul.php?id=<?php echo $row['id']?>" class="btn btn-primary">Lihat Mata Kuliah</a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>