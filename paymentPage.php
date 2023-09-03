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

        .note {
            color: red;
            font-weight: bold;
            font-style: normal;
            font-size: 14px;
            line-height: 150%;
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
        .note-text{
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 150%;
            color: #595959;
            color: #FEB500;
            margin-top: -5px;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- navigasi -->
    <?php include './include/navbar.php' ?>
    <!-- end navigasi -->
    <br />
    <br />
    <br />
    <br />
    <br />

    <!-- booking -->
    <section class="booking-page">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h1 class="header-order-step">Halaman Pemabyaran</h1>
                </div>

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
                        <strong>Success!</strong>' . $_SESSION['status-fail'] . '.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                        </div>';
                    unset($_SESSION['status-fail']);
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-6 bank-image">
                    <div class="bank">
                        <?php
                        $getDataBank = mysqli_query($conn, "SELECT * FROM bank");
                        while ($dataBank = mysqli_fetch_array($getDataBank)) {
                        ?>
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="bank-content">
                                                <img src="./admin/images/image-content/<?php echo $dataBank['photo'] ?>" class="img-fluid m" alt="">
                                                &nbsp; :
                                                <?php echo $dataBank['no_rek'] ?>
                                            </div>
                                            Atas Nama : <?php echo $dataBank['nama_pemilik'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="name-fish-detail"> </h1>
                    <?php
                    $idbulan = $_GET['id_pemesanan'];
                    $getBulan = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE id='$idbulan'");
                    $rBulan = mysqli_fetch_array($getBulan);
                    $dataWaktu = strtotime($rBulan['expire_end']);
                    $getDateTime = date("F d, Y H:i:s", $dataWaktu); 
                    ?>
                    <h2 class="price-fish-detail"><span class="price-fish-cs-rp">Harga Kamar :Rp.</span> <?php echo number_format($rBulan['harga_kost'], 0, ',', '.')  ?>/<?php echo $rBulan['total_bulan_sewa']?> Bulan</h2>
                    <h2 class="price-fish-detail"><span class="price-fish-cs-rp">Total Bayar: Rp.</span>
                        <?php
                         $currentHarga =  $rBulan['harga_kost'] * $rBulan['total_bulan_sewa'];
                         echo number_format($currentHarga, 0, ',', '.');
                        // Menghitung harga setelah diskon
                        // $diskon = 10; // Persentase diskon (10%)
                        // $hargaSetelahDiskon = $harga - ($harga * $diskon / 100);
                        
                        // echo number_format($hargaSetelahDiskon, 0, ',', '.');
                        $diskon = 50 / 100; // Persentase diskon (50%)
                        $minBayar = $currentHarga * (1 - $diskon);
                        ?></h2>
                    <div class="group-product-detail">
                        <h5 class="name-product-detail">silahkan lakukan pembayaran dan upload bukti pembayaran :</h5>
                        <h5 class="note">*Note:</h5>
                       <h5 class="note" id="counter"></h5>
                        <h5 class="name-product-detail note-text note">Minimal Proses Pembayaran 50% dari Total Bayar: Rp. <?php echo number_format($minBayar, 0, ',', '.');?></h5>
                        <!-- <h5 class="note">Batas Waktu Pembayaran : </h5> -->
                        <form action="./controller/booking/update.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group bank mb-2">
                                    <label for="" class="mb-2">Akun Tujuan</label>
                                    <select name="akun_tujuan" id="" class="form-select">
                                        <option value="">Pilih</option>
                                        <?php
                                        $getAkunBank = mysqli_query($conn, "SELECT * FROM bank");
                                        while ($dataAkunBank = mysqli_fetch_array($getAkunBank)) {

                                        ?>
                                            <option value="<?php echo $dataAkunBank['id'] ?>"><?php echo $dataAkunBank['nama_bank'] ?>|<?php echo $dataAkunBank['no_rek'] ?>|<?php echo $dataAkunBank['nama_pemilik'] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="form-group bank mb-2">
                                    <label for="" class="mb-2">Bukti Transfer</label>
                                    <input type="file" name="photo" class="form-control" id="">
                                </div>
                                <div class="form-group bank mb-2">
                                    <label for="" class="mb-2">Asal Bank</label>
                                    <input type="text" name="asal_bank" class="form-control" id="">
                                    <input hidden type="text" name="id_pemesanan" class="form-control" id="" value="<?php echo $rBulan['id'] ?>">
                                </div>
                                <div class="form-group bank mb-2">
                                    <label for="currency-field" class="mb-2">Jumlah</label>
                                    <input type="number" name="jumlah_tf" class="form-control CurrencyInput">
                                    <input type="text" hidden  name="jumlah_bayar" class="form-control CurrencyInput" value="<?php echo $rBulan['harga_kost']?>">

                                </div>
                                <div class="form-group bank mb-2">
                                    <label for="" class="mb-2">Nama Pengirim</label>
                                    <input type="text" name="nama_pengirim" class="form-control" id="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 bank mt-4">
                                    <button class="btn btn-cs-order" type="submit">Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <!-- booking -->

    <!-- footer -->
    <?php
    include './include/footer.php';
    ?>
    <!-- end footer -->

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- script fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- <script>
        $('input.CurrencyInput').on('blur', function() {
  const value = this.value.replace(/,/g, '');
  this.value = parseFloat(value).toLocaleString('en-US', {
    style: 'decimal',
    maximumFractionDigits: 2,
    minimumFractionDigits: 2
  });
});
    </script> -->
    <!-- <script>
        $('input.CurrencyInput').on('blur', function() {
            const value = this.value.replace(/,/g, '');
            const formattedValue = parseFloat(value).toLocaleString('en-US', {
                style: 'currency',
                currency: 'IDR'
            });
            this.value = formattedValue;
        });
    </script> -->
    <script>
          var countDownTimer = new Date("<?php echo "$getDateTime"; ?>").getTime();
        // console.log("line 49", countDownTimer);
        // Update the count down every 1 second
        var interval = setInterval(function() {
            var current = new Date().getTime();
            // console.log("line 52", current);
            // Find the difference between current and the count down date
            var diff = countDownTimer - current;
            // console.log("line 56", diff);
            // Countdown Time calculation for days, hours, minutes and seconds
            var days = Math.floor(diff / (1000 * 60 * 60 * 24));
            var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((diff % (1000 * 60)) / 1000);
            console.log("line 62", seconds);

            document.getElementById("counter").innerHTML = "Batas Waktu Pembayaran : " +
            minutes + "m " + seconds + "s ";
            // Display Expired, if the count down is over
            if (diff < 0) {
                clearInterval(interval);
                document.getElementById("counter").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
</body>

</html>