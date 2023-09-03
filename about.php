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
    .about-image-img {
    position: relative;
    width: 503px;
    height: 396px;
    z-index: 1;
    margin-left: 30px;
}

.about-image-img img {
    width: 100%;
    object-fit: fill;
    border-radius: 15px 100px 15px 15px;
    height: 406px;
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
    <!-- about -->
    <section class="about">
      <div class="row">
        <div class="col-md-6">
          <div class="about-image-img">
            <img src="./assets/img/buida.jpeg" alt="" >
          </div>
          <div class="about-bg-image"></div>
        </div>
        <div class="col-md-6">
          <div class="about-content">
            <h1>Tentang</h1>
            <p>Kost Bu Ida adalah tempat yang bergerak di bidang penyewaan kamar yang di dirikan pada tahun 1990 yang dipelopori oleh Ibu Ida Syarif yang berlokasi di Jln. Sekeloa Tengah No. 101 Kelurahan Lebakgede Kecamatan Coblong Kota Bandung.
              Kost Bu Ida yang awalnya hanya rumah pribadi saja, unutk memanfaatkan kamar kosong yang di tempati keluarga besar, sekarang berubah menjadi kos-kosan dengan jumlah kamar yang ada sudah mencapai 9 kamar yang selalu terisi penuh, dikarenakan kost Bu Ida ini memiliki keunggulan dibanding tempat kost lain yang ada di bandung, seperti memiliki lahan parkit motor dan tidak jauh dari pusat perbelanjaan.</p>

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