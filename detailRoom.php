<?php
session_start();
include './controller/conn.php';

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
  <link rel="stylesheet" href="./assets/css/style.css">
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
  <div class="container">
    <!-- detail room -->
    <section class="detail-room">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./room.php">Kamar</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Kamar</li>
        </ol>
      </nav>
      <div class="detail-room-title">
        <?php
        $getNamaRoom = mysqli_query($conn, "SELECT * FROM kost WHERE nama = '$nama_kost' GROUP BY kost.nama");
        while ($dataNama = mysqli_fetch_array($getNamaRoom)) {

        ?>
          <h1> <?php echo $dataNama['nama'] ?></h1>
        <?php } ?>
        <!-- <span>Bogor, Indonesia</span> -->
      </div>
      <div class="row mb-4">
        <div id="carouselExample" class="carousel slide">
          <div class="image-carousel-custom">
            <div class="carousel-inner">
              <?php
              $getDataGambar = mysqli_query($conn, "SELECT * FROM gambar_kost WHERE nama_kost = '$nama_kost' ");
              while ($dataGambar = mysqli_fetch_array($getDataGambar)) {
              
              ?>
              <div class="carousel-item active">
                <img style="object-fit: fill;" src="./admin/images/imageKost/<?php echo $dataGambar['photo_kost']?>" class="d-block w-100" alt="...">
              </div>
              <?php }?>
            </div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="detail-room-desc">
            <h2>Tentang Kamar</h2>
            <?php
            $getTentangRoom = mysqli_query($conn, "SELECT * FROM kost WHERE nama = '$nama_kost' GROUP BY kost.nama");
            while ($dataTentang = mysqli_fetch_array($getTentangRoom)) {
            ?>
              <p><?php echo $dataTentang['tentang_kost'] ?></p>
            <?php } ?>
            <!-- <h2>*Fasilitas</h2> -->
            <div class="fasilitas" style="display: none;">

              <?php
              $getDataFasilitas = mysqli_query($conn, "SELECT * FROM kost INNER JOIN fasilitas ON fasilitas.id = kost.fasilitas WHERE kost.nama = '$nama_kost'");
              while ($dataFasilitas = mysqli_fetch_array($getDataFasilitas)) {

              ?>
                <div class="fasilitas-item">
                  <img src="./admin/images/image-content/<?php echo $dataFasilitas['photo'] ?>" alt="">
                  <p><span class="active"><?php echo $dataFasilitas['jumlah_fasilitas'] ?></span> <?php echo $dataFasilitas['nama_fasilitas'] ?></p>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="start-booking">
            <div class="start-booking-box">
              <h3>Harga Kamar</h3>
              <div class="start-booking-text">
                <span class="active">Rp <?php echo number_format($harga_kost, 0, ',', '.') ?></span>/bulan
              </div>
                
                 <a class="btn-contact-now btn" href="./bookingPage.php?nama_kost=<?php echo $nama_kost?>&harga_kost=<?php echo $harga_kost?>">Pesan Sekarang</a>
              
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end detail room -->
    <!-- room with beautiful yeard -->
    <!-- <section class="room-with-beauty-backyeard">
      <h2>Room With Beauty Backyeard</h2>
      <div class="row">
        <div class="col-md-3">
          <div class="room-with-beauty-backyeard-image">
            <img src="./assets/img/most-picked-2.jpg" alt="" srcset="">
            <span>Diskon</span>
            <p class="room-with-beauty-backyeard-title">Arjuna Room</p>
            <p class="room-with-beauty-backyeard-location">Bali, Indonesia</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="room-with-beauty-backyeard-image">
            <img src="./assets/img/most-picked-2.jpg" alt="" srcset="">
            <span>Diskon</span>
            <p class="room-with-beauty-backyeard-title">Arjuna Room</p>
            <p class="room-with-beauty-backyeard-location">Bali, Indonesia</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="room-with-beauty-backyeard-image">
            <img src="./assets/img/most-picked-2.jpg" alt="" srcset="">
            <span>Diskon</span>
            <p class="room-with-beauty-backyeard-title">Arjuna Room</p>
            <p class="room-with-beauty-backyeard-location">Bali, Indonesia</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="room-with-beauty-backyeard-image">
            <img src="./assets/img/most-picked-2.jpg" alt="" srcset="">
            <span>Diskon</span>
            <p class="room-with-beauty-backyeard-title">Arjuna Room</p>
            <p class="room-with-beauty-backyeard-location">Bali, Indonesia</p>
          </div>
        </div>
      </div>
    </section> -->
    <!-- end room with beautiful yeard -->
    <!-- testimonial -->
    <!-- <section class="testimonial">
      <div class="row">
        <div class="col-md-6">
          <div class="image-testimonial">
            <div class="img-testimonial-bg">
            </div>
            <div class="img-testimonial">
              <img src="./assets/img/testimonial-img.jpg" alt="">
            </div>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="testimonial-content">
            <h2>Testimonial</h2>
            <div class="icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <div class="testimonial-text">What a great trip with my family and i should
              try again next time soon...</div>
            <p>Salsabila, collage student</p>
            <alass="btn btn-custom">Read His Story</butta>
          </div>
        </div>
      </div>
    </section> -->
    <!-- testimonial -->
  </div>
  <!-- footer -->
  <?php include './include/footer.php' ?>
  <!-- end footer -->

  <!-- script bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- script fontawesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>