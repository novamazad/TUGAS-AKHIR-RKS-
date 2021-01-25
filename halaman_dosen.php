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
        $id = $_SESSION['iduser'];
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
                    <a class="nav-link active" href="index.php">Home<span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="matakuliah.php">Mata Kuliah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tugas.php">Tugas</a>
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
    <h3>Daftar Mata Kuliah</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = $con->query("SELECT * FROM matakuliah,kelas WHERE matakuliah.id_kelas = kelas.kd_kelas AND nip_dosen = '$id'");
                while ($row = $data->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["kd_matkul"]; ?></td>
                    <td><?php echo $row["nama_matkul"]; ?></td>
                    <td><?php echo $row["nama_kelas"]; ?></td>
                </tr>
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

<div class="row mt-2">
<div class="col-md-12" id="cart">
<div class="card">
<div class="card-body">
    <h3>Daftar Tugas Mahasiswa</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Judul Tugas</th>
                    <th>Batas Waktu</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = $con->query("SELECT * FROM tugas,matakuliah,kelas
                WHERE tugas.id_matkul = matakuliah.id_matkul
                AND matakuliah.id_kelas = kelas.kd_kelas
                AND matakuliah.nip_dosen = '$id'");
                while ($row = $data->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row["kd_matkul"]; ?></td>
                    <td><?php echo $row["nama_matkul"]; ?></td>
                    <td><?php echo $row["judul_tugas"]; ?></td>
                    <td><?php echo $row["tanggal"]; ?></td>
                    <td><?php echo $row["nama_kelas"]; ?></td>
                </tr>
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
</div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>