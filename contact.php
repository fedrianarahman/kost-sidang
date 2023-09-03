<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
  // header("Location: ./auth/login.php");
  // exit();
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
  <link rel="stylesheet" href="./assets/css/style.css">
  <style>
    .btn-login-top {
      border-radius: 4px;
      background: #3572EF;
      box-shadow: 0px 8px 15px 0px rgba(53, 114, 239, 0.30);
      color: #FFF;
      padding-left: 10px;
      padding-right: 10px;
      padding-top: 5px;
      padding-bottom: 5px;
      text-align: center;
      /* margin-top: 5px; */
      text-decoration: none;
    }
    .kontak-kami{
        font-size: 18px;
    }
    .img {
    padding-top: 15px;
    right: 0;
    padding-left: 10px;
}

.image-wrapper {
    max-width: 498px;
    max-height: 421.875px;
    position: relative;
    z-index: 1;
}

.image-wrapper img {
    width: 100%;
    border-radius: 100px 15px 15px 15px;
    object-fit: fill;
    height: 400px;
}
  </style>
</head>

<body>
  <!-- navigasi -->
  <?php
  include './include/navbar.php';
  ?>
  <!-- end navigasi -->
  <br />
  <br />
  <br />
  <br />
  <br />
  <div class="container">
    <!-- whatsapp icon -->
   <!-- <a class="whats-app" href="#" target="_blank">
    <i class="fa-brands  fa-whatsapp my-float"></i>
  </a> -->
  <!-- whatsapp icon -->
    <!-- about -->
    <section class="hero">
      <div class="row">
       
        <div class="col-md-6">
          <div class="about-content">
            <h1>Contact</h1>
            <div class="contact-item">
            <h2 class="kontak-kami">Kontak Kami : </h2>
            <p style="font-size: 15px; margin-bottom :5px;"> Admin 1 : 08122122998</p>
            <p style="font-size: 15px; margin-bottom :5px;"> Admin 2 : 085105495678</p>
            <h2 class="kontak-kami">Lokasi : </h2>
            <p style="font-size: 15px; margin-bottom :5px;">Jln. Sekeloa Tengah No. 101 Kelurahan Lebakgede Kecamatan Coblong Kota Bandung.</p>
        </div>

          </div>
        </div>
        <div class="col-md-6">
        <div class="img ">
                            <div class="image-wrapper">
                                <img src="./assets/img/buida.jpeg" alt="">
                            </div>
                            <div class="bg-hero-image"></div>
                        </div>
        </div>
      </div>
    </section>
    <!-- end about -->
    <!-- footer -->
    <?php
    include './include/footer.php';
    ?>
    <!-- end footer -->

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- script fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>