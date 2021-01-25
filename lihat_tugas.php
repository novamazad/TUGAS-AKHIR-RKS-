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
                <?php echo $_SESSION['nama'] ?>
                &nbsp;
                <a href="logout.php" class="btn btn-danger navbar-btn right">
                    <i class="fa fa-sign-out-alt"> Log Out</i>
                </a>
            </div>
        </div>
    </nav>
    <?php
        $id = $_GET['id'];
        $iduser = $_SESSION['iduser'];
        $data = mysqli_query($con, "SELECT * FROM tugas WHERE id_tugas = '$id'");
        $row = $data->fetch_assoc();
        $data2 = mysqli_query($con, "SELECT * FROM tugas,matakuliah WHERE tugas.id_matkul = matakuliah.id_matkul AND id_tugas = '$id'");
        $row2 = $data2->fetch_assoc();
    ?>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" class="navigasi-breadcrumb">
                        <ol class="breadcrumb nav-breadcrumb">
                            <li class="breadcrumb-item"><a href="halaman_mahasiswa.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a
                                    href="lihat_matkul.php?id=<?php echo $row2['id_matkul'] ?>"><?php echo $row2['nama_matkul'] ?></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="cart">
                    <div class="card">
                        <div class="card-body">
                            <form action="cart.php" method="post" enctype="multipart-form-data">
                                <h3><?php echo $row['judul_tugas']?> </h3>
                                <p><?php echo $row['deskripsi_tugas']?></p>
                                <?php
                                    $datadetail = mysqli_query($con, "SELECT *,COUNT(*) AS h 
FROM detailtugas 
WHERE id_tugas = '$id' AND nrp='$iduser'");
$row2 = $datadetail->fetch_assoc();
?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Status Pengiriman</th>
                                                <td>dikumpulkan untuk dinilai</td>
                                            </tr>
                                            <tr>
                                                <th>Status penilaian</th>
                                                <td>
                                                    <h5>
                                                        <?php if($row2["nilai"] == 0) { ?>
                                                        <span class="badge badge-pill badge-warning">Belum
                                                            dinilai</span>
                                                        <?php } else {?>
                                                        <span
                                                            class="badge badge-success"><?php echo $row2['nilai']?></span>
                                                        <?php }?>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Batas waktu</th>
                                                <td>
                                                    <h5><span
                                                            class="badge badge-info"><?php echo $row['tanggal']?></span>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Waktu Pengumpulan</th>
                                                <td>
                                                    <?php if ($row2['h'] == 1) { ?>
                                                    <h5>
                                                        <?php
                $date1=date_create($row2['tanggal_upload']);
                $date2=date_create($row['tanggal']);
                $diff=date_diff($date1,$date2);
                if($diff->format("%R") == '-') { ?>
                                                        <span class="badge badge-pill badge-warning">Anda Telat
                                                            Mengumpulkan</span>
                                                        <?php } else {?>
                                                        <span class="badge badge-success">Anda Mengumpulkan Tepat
                                                            Waktu</span>
                                                        <?php }?>
                                                    </h5>
                                                    <?php } else { ?>
                                                    <h5><span class="badge badge-danger">Belum Mengumpulkan Tugas</span>
                                                    </h5>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>File</th>
                                                <td>
                                                    <?php if ($row2['h'] == 1) { ?>
                                                    <h5>
                                                        <a href="<?php echo $row2['path']?>"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-download"></i>
                                                            <?php echo $row2['nama_file']?>
                                                        </a>
                                                    </h5>
                                                    <?php } else { ?>
                                                    <h5><span class="badge badge-danger">Belum Mengumpulkan Tugas</span>
                                                    </h5>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Catatan</th>
                                                <td><?php echo $row2['catatan']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <?php if ($row2['h'] == 1) { ?>
                                        <a href="upload_tugas.php?id=<?php echo $row['id_tugas']?>"
                                            class="btn btn-warning">
                                            <i class="fa fa-save">&nbsp;</i> Edit Pengumpulan Tugas
                                        </a>
                                        <?php } else { ?>
                                        <a href="upload_tugas.php?id=<?php echo $row['id_tugas']?>"
                                            class="btn btn-primary">
                                            <i class="fa fa-save">&nbsp;</i> Kumpulkan Tugas
                                        </a>
                                        <?php } ?><p></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>