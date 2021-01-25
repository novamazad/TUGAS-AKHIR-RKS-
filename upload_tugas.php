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
        $iduser = $_SESSION['iduser'];
        $data = mysqli_query($con, "SELECT * FROM tugas WHERE id_tugas = '$id'");
        $row = $data->fetch_assoc();
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
    if (isset($_POST['submit'])) {
        $uploadDir = 'assets/file/';
        $iduser = $_SESSION['iduser'];
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $nama = $_SESSION['nama'];
        $filename = $_FILES["filetugas"]["name"];
        $file_basename = substr($filename, 0, strripos($filename, '.'));
        $file_ext = substr($filename, strripos($filename, '.'));
        $filesize = $_FILES["filetugas"]["size"];
        $allowed_file_types = array('.doc','.docx','.pdf');
    if (in_array($file_ext,$allowed_file_types) && ($filesize < 1000000))
    {
        $newfilename = $iduser . "_" . $id . "_" . $nama . $file_ext;
        $newfilenamen = $iduser . "_" . $id . "_" . $nama;
        $filepath = $uploadDir . $newfilename;
        $query = "INSERT INTO detailtugas (nama_file, catatan, path,tanggal_upload, nrp,id_tugas ) " . 
        "VALUES ('$newfilenamen', '". $_POST['deskripsi'] ."', '$filepath', '$tanggal', '$iduser','$id');";
        mysqli_query($con,$query) or die('Error, query failed : ' . mysqli_error($con));
        move_uploaded_file($_FILES["filetugas"]["tmp_name"], $filepath);
        echo "<div class='alert alert-success col-md-12 mt-3'>File uploaded successfully.</div>";
        echo "<meta http-equiv='refresh' content='1;url=lihat_tugas.php?id=$id'>";
    }
    elseif (empty($file_basename))
    {
        echo "<div class='alert alert-warning col-md-12 mt-3'>Silakan pilih file untuk diunggah</div>";
    } 
    elseif ($filesize > 1000000)
    {	
        echo "<div class='alert alert-warning col-md-12 mt-3'>File yang Anda coba unggah terlalu besar.Maximal 1 MB</div>";
    }
    else
    {
        echo "<div class='alert alert-warning col-md-12 mt-3'>Hanya jenis file ini yang diizinkan untuk diunggah: .doc,.docx,.pdf</div>";
        unlink($_FILES["filetugas"]["tmp_name"]);
    }
}
if (isset($_POST['edit'])) {
    $uploadDir = 'assets/file/';
    $iduser = $_SESSION['iduser'];
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d H:i:s');
    $nama = $_SESSION['nama'];
    $filename = $_FILES["filetugas"]["name"];
    $file_basename = substr($filename, 0, strripos($filename, '.'));
    $file_ext = substr($filename, strripos($filename, '.'));
    $filesize = $_FILES["filetugas"]["size"];
    $allowed_file_types = array('.doc','.docx','.pdf');
    if (in_array($file_ext,$allowed_file_types) && ($filesize < 1000000))
    {
        $newfilename = $iduser . "_" . $id . "_" . $nama . $file_ext;
        $newfilenamen = $iduser . "_" . $id . "_" . $nama;
        $filepath = $uploadDir . $newfilename;
        $query = "UPDATE detailtugas SET nama_file = '$newfilenamen', catatan = '". $_POST['deskripsi'] ."',". 
        "path = '$filepath',tanggal_upload = '$tanggal' WHERE nrp = '$iduser' AND id_tugas = '$id';";
        unlink($filepath);
        mysqli_query($con,$query) or die('Error, query failed : ' . mysqli_error($con));
        move_uploaded_file($_FILES["filetugas"]["tmp_name"], $filepath);
        echo "<div class='alert alert-success col-md-12 mt-3'>File uploaded successfully.</div>";
        echo "<meta http-equiv='refresh' content='1;url=lihat_tugas.php?id=$id'>";
    }
    elseif (empty($file_basename))
    {
        echo "<div class='alert alert-warning col-md-12 mt-3'>Silakan pilih file untuk diunggah</div>";
    } 
    elseif ($filesize > 1000000)
    {	
        echo "<div class='alert alert-warning col-md-12 mt-3'>File yang Anda coba unggah terlalu besar.Maximal 1 MB</div>";
    }
    else
    {
        echo "<div class='alert alert-warning col-md-12 mt-3'>Hanya jenis file ini yang diizinkan untuk diunggah: .doc,.docx,.pdf</div>";
        unlink($_FILES["filetugas"]["tmp_name"]);
    }
}
?>
<div class="row">
<div class="col-md-9 m-auto " id="cart">
<div class="card">
<div class="card-body">
<h3><?php echo $row['judul_tugas']?> </h3>
<p><?php echo $row['deskripsi_tugas']?></p>
<?php
$datadetail = mysqli_query($con, "SELECT *,COUNT(*) AS h 
FROM detailtugas 
WHERE id_tugas = '$id' AND nrp='$iduser'");
$row2 = $datadetail->fetch_assoc();
if ($row2['h'] == 1) { 
?>
<form class="container" method="post" enctype="multipart/form-data">
<div class="form-group row">
    <label class="col-md-3 control-label">File</label>
    <div class="col-md-6">
        <input type="file" class="form-control-file" name="filetugas">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 control-label">Deskripsi</label>
    <div class="col-md-9">
        <textarea name="deskripsi" class="form-control"><?php echo $row2['catatan'] ?></textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-9">
        <button class="btn btn-primary form-control" name="edit">
            <i class="fa fa-save"></i>
            Edit Pengumpulan Tugas
        </button>
    </div>
</div>
</form>
<?php } else { ?>
<form class="container" method="post" enctype="multipart/form-data">
<div class="form-group row">
    <label class="col-md-3 control-label">File</label>
    <div class="col-md-6">
        <input type="file" class="form-control-file" name="filetugas">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 control-label">Deskripsi</label>
    <div class="col-md-9">
        <textarea name="deskripsi" class="form-control" required></textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-9">
        <button class="btn btn-primary form-control" name="submit">
            <i class="fa fa-save"></i>
            Upload Tugas
        </button>
    </div>
</div>
</form>
<?php } ?>
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