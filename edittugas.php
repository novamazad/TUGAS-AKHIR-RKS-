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

<div id="content">
<div class="container mt-4">
<?php
$id = $_GET['id'];
$iduser = $_SESSION['iduser'];
if(isset($_POST['save'])){
$judulTugas = $_POST['judul'];
$deskripsiTugas = $_POST['deskripsi'];
$tanggalTugas = $_POST['tanggal'];
$idMatkul = $_POST['matkul'];
$query = "UPDATE tugas SET  judul_tugas='$judulTugas',deskripsi_tugas='$deskripsiTugas', " . 
"tanggal='$tanggalTugas',id_matkul='$idMatkul' WHERE id_tugas='$id';";
mysqli_query($con,$query) or die('Error, query failed : ' . mysqli_error($con));
echo "<div class='alert alert-success col-md-12 mt-3'>Tugas Berhasil Diganti</div>";
echo "<meta http-equiv='refresh' content='1;url=tugas.php'>";
}
date_default_timezone_set('Asia/Jakarta');
$query = "SELECT * FROM tugas WHERE id_tugas = '$id'";
$data = $con->query($query);
$row = $data->fetch_assoc();
?>
<div class="row">
<div class="col-md-9 m-auto " id="cart">
<div class="card">
<div class="card-body">
<h3 class="mb-4">Edit Tugas Mahasiswa</h3>
<form class="container" method="post" enctype="multipart/form-data">
<div class="form-group row">
<label class="col-md-3 control-label">Judul Tugas</label>
<div class="col-md-9">
    <input type="text" name="judul" class="form-control" value="<?php echo $row['judul_tugas'] ?>" required>
</div>
</div>
<div class="form-group row">
<label class="col-md-3 control-label">Deskripsi Tugas</label>
<div class="col-md-9">
<textarea class="form-control" name="deskripsi" rows="3"><?php echo $row['deskripsi_tugas'] ?></textarea>
</div>
</div>
<div class="form-group row">
<label class="col-md-3 control-label">Batas Waktu</label>
<div class="col-md-9">
<input class="form-control" type="datetime-local" value="<?php echo date('Y-m-d\Th:i:s',strtotime($row['tanggal'])); ?>" name="tanggal">
</div>
</div>
<div class="form-group row">
<label class="col-md-3 control-label">Pilih Mata Kuliah</label>
<div class="col-md-9">
    <?php
        $sql = "SELECT matakuliah.id_matkul AS id,matakuliah.nama_matkul AS nama,kelas.nama_kelas AS kelas
        FROM matakuliah,kelas 
        WHERE matakuliah.id_kelas = kelas.kd_kelas
        AND matakuliah.nip_dosen = '$iduser'";
        $rs = $con->query($sql);
        echo "<select class='form-control' name='matkul'>";
        while($row2 = $rs->fetch_assoc()){
            if($row2['id'] == $row['id_matkul']){
                echo "<option value='".$row2["id"]."' selected>".$row2["nama"]." ~ ".$row2["kelas"]."</option>";
            }else {
                echo "<option value='".$row2["id"]."'>".$row2["nama"]." ~ ".$row2["kelas"]."</option>";
            }
        }
        $rs->close();
        echo "</select>";
        ?>
</div>
</div>
<div class="form-group row">
<label class="col-md-3 control-label"></label>
<div class="col-md-9">
    <button class="btn btn-primary" name="save">
        <i class="fa fa-save"></i>
        Edit Tugas
    </button>
    <a class="btn btn-danger" href="tugas.php">
        <i class="fa fa-times"></i>
        Batal
    </a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>