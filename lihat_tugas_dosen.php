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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
        require_once 'includes/connection.php';
        session_start();
        $id = $_SESSION['iduser'];
        $idTugas = $_GET['id'];
        $data1 = $con->query("SELECT * FROM tugas WHERE id_tugas='$idTugas'");
        $row1 = $data1->fetch_assoc();
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
                                <i class="fa fa-book"></i> E-Learning PENS
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

    <div id="content">
        <div class="container">
            <div class="card mt-3">
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
                                        <a class="nav-link" href="halaman_dosen.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="matakuliah.php">Mata Kuliah</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="">Tugas</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="row mt-2">
                <div class="col-md-12" id="cart">
                    <div class="card">
                        <div class="card-body">
                            <h3><?php echo $row1['judul_tugas'] ?></h3>
                            <p><?php echo $row1['deskripsi_tugas'] ?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NRP</th>
                                            <th>Nama</th>
                                            <th>Catatan</th>
                                            <th>Tanggal Upload</th>
                                            <th>Status Pengumpulan</th>
                                            <th>Nilai</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
    $data = $con->query("SELECT * FROM detailtugas,mahasiswa WHERE detailtugas.nrp = mahasiswa.nrp AND id_tugas='$idTugas'");
    while ($row = $data->fetch_assoc()) {
    $idDetail = $row['id_detail_tugas'];
    ?>
                                        <tr>
                                            <td><?php echo $row["nrp"]; ?></td>
                                            <td><?php echo $row["nama"]; ?></td>
                                            <td><?php echo $row["catatan"]; ?></td>
                                            <td><?php echo $row["tanggal_upload"]; ?></td>
                                            <td>
                                                <h6>
                                                    <?php 
            $date1=date_create($row['tanggal_upload']);
            $date2=date_create($row1['tanggal']);
            $diff=date_diff($date1,$date2);
            if($diff->format("%R") == '-') { ?>
                                                    <span class="badge badge-warning">Telah Mengumpulkan</span>
                                                    <?php } else {?>
                                                    <span class="badge badge-success">Mengumpulkan Tepat Waktu</span>
                                                    <?php }?>
                                                </h6>
                                            </td>
                                            <td>
                                                <h6>
                                                    <?php if($row["nilai"] == 0) { ?>
                                                    <span class="badge badge-danger">Belum dinilai</span>
                                                    <?php } else {?>
                                                    <span class="badge badge-success"><?php echo $row['nilai']?></span>
                                                    <?php }?>
                                                </h6>
                                            </td>
                                            <td>
<a href="edittugas.php?id=<?php echo $row['id_detail_tugas']?>"
    class="btn btn-info btn-sm" data-toggle="modal"
    data-target="#modalNilai<?php echo $row['id_detail_tugas']; ?>"><i
        class="fas fa-star">&nbsp;Beri
        Nilai</i>
</a>
                                                <a href="<?php echo $row['path']?>" class="btn btn-warning btn-sm"><i
                                                        class="fas fa-download"></i>&nbsp;Download
                                                </a>
                                            </td>
                                        </tr>
<div class="modal fade" id="modalNilai<?php echo $row['id_detail_tugas']; ?>"
tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">
    <?php echo $row1['judul_tugas'] ?>
</h5>
<button type="button" class="close" data-dismiss="modal"
    aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<form action="updatenilai.php" method="get">
<div class="modal-body">
    <input type="hidden" name="id_detail"
        value="<?php echo $row['id_detail_tugas']; ?>">
    <input type="hidden" name="id_tugas"
        value="<?php echo $row['id_tugas']; ?>">
    <div class="form-group">
        <label>NRP</label>
        <input type="text" class="form-control"
            value="<?php echo $row['nrp']; ?>" readonly>
    </div>
    <div class="form-group">
        <label>NAMA</label>
        <input type="text" class="form-control"
            value="<?php echo $row['nama']; ?>" readonly>
    </div>
    <div class="form-group">
        <label>NILAI</label>
        <input type="text" class="form-control" name="nilai"
            value="<?php echo $row['nilai']; ?>">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary"
        data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-save" name="tambah"></i>&nbsp; Simpan
        Nilai</button>
</div>
</form>
</div>
</div>
</div>
                                        <?php
    }
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>

</html>