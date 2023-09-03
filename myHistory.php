<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
  header("Location: ./auth/login.php");
  exit();
}
date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu ke WIB (Waktu Indonesia Bagian Barat)
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

  .badge-custom {
    background-color: #ecfae4;
    color: #68CF29;
    padding: 3px 10px;
  }

  .badge-custom-proses {
    background-color: #ffefee;
    color: #FF4C41;
    padding: 7px 10px;
  }

  .badge-custom-done {
    background-color: #fff0da;
    color: #FFAB2D;
    padding: 3px 10px;
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
  <div class="mb-4">
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
                        <strong>Gagal!</strong>' . $_SESSION['status-fail'] . '.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                        </div>';
                unset($_SESSION['status-fail']);
              }
              ?>
    </div>
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
                <li><a class="profile-link active" href="./myHistory.php">Riwayat</a></li>
                <li class="profile-link "><a href="./myKost.php">Kamar Saya</a></li>
              </ul>
              <!-- end mini navigasi -->
            </div>
          </div>
        </div>

        <div class="col-md-9 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  <?php
                  $getDataPemesanan = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE userId = '$idUSer'");
                  $i = 1;
                  if (mysqli_num_rows($getDataPemesanan) > 0) {


                  ?>
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <tr>
                          <th>#</th>
                          <th>Tanggal Pemesanan</th>
                          <th>Status Pemesanan </th>
                          <th>Status Pembayaran</th>
                          <th>Nama Kamar</th>
                          <th>Aksi</th>
                        </tr>
                        <?php
                        while ($dataPemesanan = mysqli_fetch_array($getDataPemesanan)) {
                          date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu ke WIB (Waktu Indonesia Bagian Barat)
                        ?>
                          <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php
                                $created_old = strtotime($dataPemesanan['created_at']);
                                echo date('F d Y', $created_old) ?></td>
                            <td><?php if ($dataPemesanan['status_pemesanan'] == 'P') {
                                  echo '<span class="btn btn-warning btn-sm text-white">Menunggu Konfirmasi</span>';
                                }elseif($dataPemesanan['status_pemesanan']=='B'){
                                  echo '<span class="btn btn-danger btn-sm text-white">Pemesanan Dibatalkan</span>';
                                }else{
                                  echo '<span class="btn btn-sm btn-success text-white">Pemesanan Terkonfirmasi</span>';
                                }?></td>
                            <td><?php if ($dataPemesanan['status_pembayaran'] == 'L') {
                                  echo '<span class="badge badge-custom">Lunas</span>';
                                } else {
                                  echo '<a href=""><span class="badge badge-custom-proses">Menunggu Pelunasan</span></a>';
                                }
                                ?></td>
                            <td><?php echo $dataPemesanan['nama_kost'] ?></td>
                            <td>
                              <?php
                              if ($dataPemesanan['status_pemesanan'] == 'P') {
                                echo '<a href="detailHistory.php?id_pemesanan=' . $dataPemesanan['id'] . '" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fa fa-eye" data-toggle="tooltip" title="Detail"></i></a>';
                              }
                              if ($dataPemesanan['status_pemesanan'] == 'A') {
                                echo '<a href="detailHistory.php?id_pemesanan=' . $dataPemesanan['id'] . '" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fa fa-eye" data-toggle="tooltip" title="Detail"></i></a>';
                              }
                              // if ($dataPemesanan['status_pemesanan'] == 'B') {
                              //   echo '<a href="detailHistory.php?id_pemesanan=' . $dataPemesanan['id'] . '" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fa fa-eye" data-toggle="tooltip" title="Detail"></i></a>';
                              // }
                              // if ($dataPemesanan['status_pemesanan'] == 'P') {
                              //   echo '
                              //   <a href="./controller/booking/cancel.php?id_pemesanan=' . $dataPemesanan['id'] . '" class="btn ml-4 btn-danger shadow btn-xs sharp" data-toggle="tooltip" title="Batalkan"><i class="fa fa-xmark"></i></a>';
                              // }
                              // if ($dataPemesanan['status_pemesanan'] == 'A') {
                              //   echo '
                              //   <a href="myKost.php" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fa fa-eye" data-toggle="tooltip" title="Detail"></i></a>';
                              // }
                              ?>
                            </td>
                          </tr>
                        <?php } ?>

                      </table>
                    </div>
                  <?php } else {
                    echo ' <p class="fw-bold text-center text-danger">Tidak Ada Riwayat</p>';
                  } ?>
                </div>
              </div>
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