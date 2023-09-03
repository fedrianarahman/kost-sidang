<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
    header("Location: ./auth/login.php");
    exit();
}
$idUSer = $_SESSION['user_id'];
$idPemesanan = $_GET['id_pemesanan'];
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
  .detail-history{
    margin-bottom: 50px;

  }
  .card-custom{
    box-shadow: 0px 4px 14px 0px rgba(209, 224, 255, 0.30);
  }
  .img-detail-history-wrapper{
    width: 400px;
    margin: auto;
    /* height: 350px; */
    /* background: #000; */
  }
  td{
    font-size: 18px;
    font-weight: 500;
    color: #999;
  }
  tr{
    margin-bottom: 10px;
  }
  span{
    
    background-color: #fff0da;
    color: #FFAB2D;
    padding: 2px 5px;
    border-radius: 12px;
    font-size: 15px;
  }
  .note {
            color: red;
            font-weight: bold;
            font-style: normal;
            font-size: 14px;
            /* line-height: 150%; */
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
                        <strong>Success!</strong>' . $_SESSION['status-fail'] . '.
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
    <section class="detail-history">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body">
                            <?php
                            $getDataPemesanan = mysqli_query($conn, "SELECT tb_pemesanan.nama_pemesan AS nama_pemesan,tb_pemesanan.email_pemesan AS email_pemesan,tb_pemesanan.total_bulan_sewa AS total_bulan_sewa,tb_pemesanan.nama_kost AS nama_kost,tb_pemesanan.harga_kost AS harga_kost, tb_pemesanan.jumlah AS jumlah,tb_pemesanan.status_pembayaran AS status_pembayaran,tb_pemesanan.status_pemesanan AS status_pemesanan,tb_pemesanan.tgk_dari AS tgk_dari,tb_pemesanan.tgl_hingga AS tgl_hingga,tb_pemesanan.created_at AS created_at,tb_pemesanan.sisa_bayar AS sisa_bayar, gambar_kost.photo_kost AS photo_kost FROM tb_pemesanan INNER JOIN gambar_kost ON gambar_kost.nama_kost = tb_pemesanan.nama_kost WHERE  userId = '$idUSer' AND tb_pemesanan.id = '$idPemesanan' GROUP BY tb_pemesanan.nama_kost");
                            while ($dataHistory = mysqli_fetch_array($getDataPemesanan)) {
                                $waktuLama = strtotime($dataHistory['tgk_dari']);
                                $currentDari = date("d F  Y", $waktuLama);
                                $waktuHinggaLama = strtotime($dataHistory['tgl_hingga']);
                                $currentHingga = date(" d F  Y", $waktuHinggaLama);
                            ?>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="img-detail-history-wrapper">
                                        <img src="./admin/images/imageKost/<?php echo $dataHistory['photo_kost']?>" class="circle-3 img-thumbnail" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                       <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td><?php echo $dataHistory['nama_pemesan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><?php echo $dataHistory['email_pemesan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Sewa</td>
                                            <td>:</td>
                                            <td><?php echo $dataHistory['total_bulan_sewa']?> bulan</td>
                                        </tr>
                                        <tr>
                                            <td>Lama Sewa</td>
                                            <td>:</td>
                                            <td><?php echo  $currentDari ?> - <?php echo $currentHingga?></td>
                                        </tr>
                                        <tr>
                                            <td>Kamar</td>
                                            <td>:</td>
                                            <td><?php echo $dataHistory['nama_kost']?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Kamar</td>
                                            <td>:</td>
                                            <td>Rp.<?php echo number_format($dataHistory['harga_kost'], 0, ',', '.');?></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Pemesanan</td>
                                            <td>:</td>
                                            <td><?php 
                                            $created_old = strtotime($dataHistory['created_at']);
                                            echo date('F d, Y', $created_old)?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Pemesanan</td>
                                            <td>:</td>
                                            <td><?php if ($dataHistory['status_pemesanan']== 'P') {
                                                echo '<span class="light">Menunggu Konfirmasi</span>';
                                            } elseif($dataHistory['status_pemesanan']== 'B'){
                                                echo '<span class="badge badge-custom-proses">Pemesanan Dibatalkan</span>';
                                            }elseif($dataHistory['status_pemesanan'=='A']){
                                               echo '<span class=" badge badge-custom">Pemesanan Terkonfirmasi</span>';
                                            }?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Pembayaran</td>
                                            <td>:</td>
                                            <td><?php if ($dataHistory['status_pembayaran']=='L') {
                                                echo '<span class="badge badge-custom">Lunas</span>';
                                            } else {
                                                echo '<span class="light">Belum Lunas</span>';
                                            }
                                              ?></td>
                                        </tr>
                                        <tr>
                                            <td>Uang Yang Sudah dibayarkan</td>
                                            <td>:</td>
                                            <td>Rp.<?php echo number_format($dataHistory['jumlah'], 0, ',', '.');?></td>
                                        </tr>
                                        <tr>
                                            <td>Sisa Bayar</td>
                                            <td>:</td>
                                            <td>Rp.<?php echo number_format($dataHistory['sisa_bayar'], 0, ',', '.');?></td>
                                        </tr>
                                        <?php
                                        if ($dataHistory['status_pembayaran']== 'D') {
                                       ?>    
                                       <tr>
                                            <td class="note">*Note</td>
                                            <td class="note">:</td>
                                            <td class="note">Sisa Pembayaran Diselesaikan Sebelum Tanggal <?php echo $currentHingga ?></td>
                                        </tr> 
                                        <?php }
                                        ?>
                                       </table>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-cs-order" href="./myHistory.php">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php
    include './include/footer.php';
    ?>
    <!-- end footer -->
    <script>
        // window.print();
    </script>
    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- script fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>