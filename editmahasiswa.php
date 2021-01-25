<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" />
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
</head>

<body>
    <?php
        require_once 'includes/connection.php';
        session_start();
        include_once "includes/header.php";
        $id = $_GET['id'];
        $data = mysqli_query($con, "select * from mahasiswa where id='$id'");
        $row = mysqli_fetch_assoc($data);
    ?>
    <div id="content" style="margin-bottom: 158px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-4 mb-4 ml-auto mr-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Tambah Nilai</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>NRP</label>
                                    <input type="text" class="form-control" name="nrp"
                                        value="<?php echo $row['nrp']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="<?php echo $row['nama']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>NILAI</label>
                                    <input type="text" class="form-control" name="nilai"
                                        value="<?php echo $row['nilai']; ?>">
                                </div>

                                <div class="text-center">
                                    <button name="tambah" type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>&nbsp; Tambah Nilai
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "includes/footer.php"; ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php 
if (isset($_POST['tambah'])) {
    $nilai = $_POST["nilai"];
    mysqli_query($con, "UPDATE mahasiswa SET nilai = '$nilai' WHERE id='$id'");
    echo "<meta http-equiv='refresh' content='1;url=halaman_dosen.php'>";
}
?>