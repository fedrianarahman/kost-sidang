<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
    header("Location: ./auth/login.php");
    exit();
}
$nama_kost = $_GET['nama_kost'];
$harga_kost = $_GET['harga_kost'];
$idUSer = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- link css -->
    <link rel="stylesheet" href="./assets/css/style.css" />
    <style>
        .list-group-item {
            border: none;
            font-style: normal;
            font-weight: 400;
            font-size: 15px;
            color: #A5A5A5;
        }

        .btn-cs-order {

            background: #FEB500;

            color: #FFF;
            text-align: center;
            font-size: 18px;
            font-family: Poppins;
            font-style: normal;
            font-weight: 300;
            margin-bottom: 40px;
        }

        .btn-cs-order:hover {
            background: #da9c00;
            color: white;
        }

        .value-list-group {
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            color: #595959;
        }

        .name-product-detail {
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 150%;
            color: #595959;
        }

        .price-fish-detail {
            font-style: normal;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: 0.005em;
            color: #FFA500;
        }

        .price-fish-cs-rp {
            font-style: normal;
            font-weight: 400;
            font-size: 20px;
            letter-spacing: 0.005em;
            color: #FFA500;
        }

        .name-fish-detail {
            font-style: normal;
            font-weight: 700;
            font-size: 32px;
            letter-spacing: 0.05em;
            color: #595959;
        }

        .header-order-step {
            font-size: 30px;
            font-weight: bold;
            background-color: #FEB500;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .message-from-booking {
            margin-top: 30px;
            padding-left: 250px;
            padding-right: 250px;
            height: 50px;
            /* background: #000; */
            width: 100%;
        }

        .whats-app {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 3px 4px 3px #999;
            right: 15px;
            z-index: 100;
        }

        .my-float {
            margin-top: 10px;
        }
    </style>
</head>
<?php
// mengecek apakah ada pemesanan yang tertunda?
$getDataPemesanan = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUSer'");
$rDataPemesanan = mysqli_fetch_array($getDataPemesanan);
if ($rDataPemesanan['photo_ktp']) {
    
?>
<body>
    <!-- navigasi -->
    <?php include './include/navbar.php' ?>
    <!-- end navigasi -->
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class="message-from-booking mb-4">
        <?php
        if (isset($_SESSION['status-info'])) {
            echo '<div class="message-from-booking">
                        <div class="alert alert-success light alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>' . $_SESSION['status-info'] . '.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                        </div>';
            unset($_SESSION['status-info']);
        }
        if (isset($_SESSION['status-fail'])) {
            echo '<div class="message-from-booking">
                        <div class="alert alert-danger light alert-dismissible fade show" role="alert">
                        <strong>Gagal</strong>' . $_SESSION['status-fail'] . '.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                        </div>';
            unset($_SESSION['status-fail']);
        }
        ?>
    </div>
    <!-- whatsapp icon -->
    <a class="whats-app" href="#" target="_blank">
        <i class="fa-brands  fa-whatsapp my-float"></i>
    </a>
    <!-- whatsapp icon -->
    <!-- booking -->
    <section class="booking-page">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h1 class="header-order-step">Pesan Kamar</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <?php
                    $getDataGambar = mysqli_query($conn, "SELECT * FROM gambar_kost WHERE nama_kost = '$nama_kost' GROUP BY gambar_kost.nama_kost");
                    while ($dataGambar = mysqli_fetch_array($getDataGambar)) {
                    ?>
                        <img src="./admin/images/imageKost/<?php echo $dataGambar['photo_kost'] ?>" class="img-fluid image-detail-product" alt="">
                    <?php } ?>
                </div>
                <div class="col-md-8 mb-3">
                    <h1 class="name-fish-detail"> Kamar <?php echo $nama_kost ?></h1>
                    <h2 class="price-fish-detail"><span class="price-fish-cs-rp">Harga : <?php echo number_format($harga_kost, 0, ',', '.') ?></h2>
                    <div class="group-product-detail">
                        <h5 class="name-product-detail">Silahkan Pilih Tanggal : </h5>
                        <form action="./controller/booking/add.php" method="POST">
                            <div class="row">

                                <!-- id user -->
                                <input type="text" class="form-control" id="nama" required name="user_id" hidden autofocus placeholder="Nama" value="<?php echo $_SESSION['user_id'] ?>">
                                <!-- id user -->

                                <!-- harga dan nama kost -->
                                <input type="text" class="form-control" id="nama" required name="nama_kost" hidden autofocus placeholder="Nama" value="<?php echo $nama_kost ?>">
                                <input type="text" class="form-control" id="nama" required name="harga_kost" hidden autofocus placeholder="Nama" value="<?php echo $harga_kost ?>">
                                <!-- end harga, dan nama kost -->

                                <!-- nama, email, no hp -->
                                <input type="text" class="form-control" id="nama" required name="nama_penyewa" autofocus placeholder="Nama" value="<?php echo $_SESSION['nama'] ?>" hidden>
                                <input type="email" class="form-control" id="email" required name="email_penyewa" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" hidden>
                                <input type="text" class="form-control" id="nophone" required name="no_hp_penyewa" placeholder="Phone" value="<?php echo $_SESSION['no_hp'] ?>" hidden>
                                <!-- end nama,email,no_hp -->
                                <div class="mb-3 col-md-6">
                                    <label for="" class="mb-2">Tanggal Sewa Dari</label>
                                    <input type="Date" class="form-control" id="minbookingDate" required name="sewa_dari" placeholder="Phone">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="" class="mb-2">Tanggal Sewa Hingga</label>
                                    <input type="Date" class="form-control" id="maxbookingDate" required name="sewa_hingga" placeholder="Phone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-cs-order" href="./detailRoom.php?nama_kost=<?php echo $nama_kost ?>&harga_kost=<?php echo $harga_kost ?>">Cancel</a>
                                    <button class="btn btn-custom float-end" type="submit">Selanjutnya</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- booking -->

    <!-- footer -->
    <?php include './include/footer.php' ?>
    <!-- end footer -->

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- script fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        let date = new Date();
        let tdate = date.getDate();
        let moth = date.getMonth() + 1;

        if (tdate < 10) {
            tdate = '0' + tdate;
        }
        if (moth < 10) {
            moth = '0' + moth;
        }

        let year = date.getFullYear();
        let minDate = year + '-' + moth + '-' + tdate;
        //menentukan jumlah bulan yang ditentukan
        let maxDate = new Date();
        let maxDateTanggal = maxDate.getDate();
        let maxDateBulan = maxDate.getMonth() + 3;

        if (maxDateTanggal < 10) {
            maxDateTanggal = '0' + maxDateTanggal;
        }
        if (maxDateBulan < 10) {
            maxDateBulan = '0' + maxDateBulan;
        }

        let maxDateYear = maxDate.getFullYear();

        let maxDatePicked = year + '-' + maxDateBulan + '-' + maxDateTanggal;

        //   menentukan minimal tanggal yang dipilih
        let minBulanPicked = maxDate.getMonth() + 2;
        if (minBulanPicked < 10) {
            minBulanPicked = '0' + minBulanPicked;
        }
        let minTanggalDipilih = year + '-' + minBulanPicked + '-' + maxDateTanggal;

        // menghitung total jumlah hari yang dipilih
        let totalHari = minTanggalDipilih

        document.getElementById("minbookingDate").setAttribute("min", minDate);
        document.getElementById("minbookingDate").setAttribute("max", maxDatePicked);
        document.getElementById("maxbookingDate").setAttribute("min", minTanggalDipilih);
        document.getElementById("maxbookingDate").setAttribute("max", maxDatePicked);
        console.log("line 279", minDate, minTanggalDipilih);
    </script>

</body>
<?php } else{
        $_SESSION['status-fail'] = "Identitas Anda Belum Lengkap !, Silahkan Lengkapi Terlebih Dahulu";
        header("Location:profileUser.php");
}?>



</html>