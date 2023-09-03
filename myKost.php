<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
  header("Location: ./auth/login.php");
  exit();
}
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
  <link rel="stylesheet" href="./assets/css/style2.css" />
</head>
<style>
   span{
    
    background-color: #fff0da;
    color: #FFAB2D;
    padding: 2px 5px;
    border-radius: 12px;
    font-size: 15px;
  }
  .badge-custom {
    background-color: #ecfae4;
    color: #68CF29;
    padding: 3px 10px;
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

  .profile-link {
    padding: 4px;

  }

  .profile-link.active {
    background-color: #FEB500;
    color: white;
    padding-right: 100px;
    text-decoration: none;
    border-radius: 4px;
  }

  .profile-link.active a {
    color: white;
  }

  ul li {
    list-style: none;
  }

  .profile-link a {
    text-decoration: none;
    font-weight: 600;
    color: #999999;
  }

  /* picture container */
  .picture-container {
    position: relative;
    cursor: pointer;
    text-align: center;
  }

  .picture {
    width: 106px;
    height: 106px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
  }

  .picture:hover {
    border-color: #2ca8ff;
  }

  .content.ct-wizard-green .picture:hover {
    border-color: #05ae0e;
  }

  .content.ct-wizard-blue .picture:hover {
    border-color: #3472f7;
  }

  .content.ct-wizard-orange .picture:hover {
    border-color: #ff9500;
  }

  .content.ct-wizard-red .picture:hover {
    border-color: #ff3b30;
  }

  .picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
  }

  .pict-text {
    font-size: small;
    color: #999999;
    /* background: red; */
  }

  .picture-src {
    width: 100%;
    object-fit: fill;

  }

  /*Profile Pic End*/
</style>

<body>
  <!-- navigasi -->
  <?php include './include/navbar.php' ?>
  <!-- end navigasi -->
  <br />
  <br />
  <br />
  <br />
  <br />
  <!-- whatsapp icon -->
  <a class="whats-app" href="#" target="_blank">
    <i class="fa-brands  fa-whatsapp my-float"></i>
  </a>
  <!-- whatsapp icon -->
  <div class="container">
    <section class="profile">
      <div class="row">
        <div class="col-md-3 mb-4 ">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="picture-container">
                <div class="picture">
                  <?php
                  $getDataPhoto = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUSer'");
                  while ($dataUser = mysqli_fetch_array($getDataPhoto)) {

                  ?>
                    <img src="./assets/img/imageProfile/<?php echo $dataUser['photo'] ?>" class="picture-src" width="114px" alt="">
                  <?php } ?>

                </div>
                <!-- <h6 class="mt-2 pict-text">Pilih Photo</h6> -->
              </div>
              <!-- mini navigasi -->
              <ul>
                <li class="profile-link "><a href="./profileUser.php">Profile</a></li>
                <li class="profile-link "><a href="./myHistory.php">Riwayat</a></li>
                <li><a class="profile-link active" href="./myKost.php">Kamar Saya</a></li>
              </ul>
              <!-- end mini navigasi -->
            </div>
          </div>
        </div>

        <div class="col-md-9 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <?php
              $getDataKamar = mysqli_query($conn, "SELECT tb_pemesanan.nama_pemesan AS nama_pemesan,tb_pemesanan.email_pemesan AS email_pemesan,tb_pemesanan.total_bulan_sewa AS total_bulan_sewa,tb_pemesanan.nama_kost AS nama_kost,tb_pemesanan.harga_kost AS harga_kost, tb_pemesanan.jumlah AS jumlah,tb_pemesanan.status_pembayaran AS status_pembayaran,tb_pemesanan.status_pemesanan AS status_pemesanan,tb_pemesanan.tgk_dari AS tgk_dari,tb_pemesanan.tgl_hingga AS tgl_hingga,tb_pemesanan.created_at AS created_at,tb_pemesanan.sisa_bayar AS sisa_bayar, gambar_kost.photo_kost AS photo_kost FROM tb_pemesanan INNER JOIN gambar_kost ON gambar_kost.nama_kost = tb_pemesanan.nama_kost WHERE  userId = '$idUSer' AND tb_pemesanan.status_pemesanan='A'");
              $i = 1;
              while ($dataKamar = mysqli_fetch_array($getDataKamar)) {
                $waktuLama = strtotime($dataKamar['tgk_dari']);
                $currentDari = date("d F  Y", $waktuLama);
                $waktuHinggaLama = strtotime($dataKamar['tgl_hingga']);
                $currentHingga = date(" d F  Y", $waktuHinggaLama);
              ?>
                <div class="row mb-4">
                  <div class="col-md-4">
                    <img src="./assets/img/hero.jpg" class="img-thumbnail" alt="">
                  </div>
                  <div class="col-md-8">
                    <table>
                      <tr>
                        <td>Nama Kamar</td>
                        <td>:</td>
                        <td><?php echo $dataKamar['nama_kost'] ?></td>
                      </tr>
                      <tr>
                        <td>Lama Sewa</td>
                        <td>:</td>
                        <td><?php echo  $currentDari ?> - <?php echo $currentHingga ?></td>
                      </tr>
                      <tr>
                        <td>Status Pembayaran</td>
                        <td>:</td>
                        <td>
                          <?php if ($dataKamar['status_pembayaran'] == 'L') {
                            echo '<span class="badge badge-custom">Lunas</span>';
                          } else {
                            echo '<span class="light">Belum Lunas</span>';
                          }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa Pembayaran</td>
                        <td>:</td>
                        <td>Rp.<?php echo number_format($dataKamar['sisa_bayar'], 0, ',', '.');?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
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