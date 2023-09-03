<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
    header("Location: ./auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
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
    </style>
</head>

<body>
    <!-- navigasi -->
   <?php
   include './include/navbar.php'
   ?>
    <!-- end navigasi -->
    <br />
    <br />
    <br />
    <br />
    <br />

    <!-- booking -->
    <section id="detail" class="detail margin-bottom-long margin-top-long booking-page">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <h1 class="header-order-step">Success </h1>
                </div>
            </div>
           <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="./assets/img/order-success.png" class="image-cs-success" width="400" alt="">
                        <h1 class="popup-title-h1 mb-2">Selamat Pemesanan Berhasil</h1>
                        <p class="paraf-description-p mb-2">Termakasih Telah melakukan Pemesanan, Tunggu Pihak Kami Akan Menghubungi Anda</p>
                        <a href="./myHistory.php">
                        <button class="btn btn-cs-order">oke</button>
                        </a>
                    </div>
                </div>
            </div>
           </div>
        </div>  
    </section>
    <!-- booking -->

    <!-- footer -->
   <?php include './include/footer.php'?>
    <!-- end footer -->

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <!-- script fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>