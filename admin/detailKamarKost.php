<?php
session_start();
include './controller/conn.php';
// Cek apakah sesi login telah diatur
if (!isset($_SESSION['nama'])) {
    header("Location: ./auth/login.php");
    exit();
}
$idKost = $_GET['id'];
$namaKost = $_GET['nama_kost'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:title" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:description" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <title>Zenix - Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include './include/navHeader.php' ?>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <?php include './include/navbar.php' ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php
        include './include/sidebar.php';
        ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                        <!-- Tab panes -->
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <?php
                                            $getGambar1 = mysqli_query($conn, "SELECT * FROM gambar_kost WHERE nama_kost = '$namaKost'");
                                            $firstImage = true; // Untuk mengatur elemen pertama sebagai aktif

                                            while ($dataGambar1 = mysqli_fetch_array($getGambar1)) {
                                                $tabId = 'tab-' . $dataGambar1['id'];
                                                $photoKost = $dataGambar1['photo_kost'];
                                                $activeClass = $firstImage ? 'show active' : ''; // Tambahkan kelas 'show active' pada elemen pertama
                                            ?>

                                                <div role="tabpanel" class="tab-pane fade <?php echo $activeClass; ?>" id="<?php echo $tabId; ?>">
                                                    <img class="img-fluid" src="images/imageKost/<?php echo $photoKost ?>" alt="">
                                                </div>

                                            <?php
                                                $firstImage = false; // Setel menjadi false setelah elemen pertama
                                            }
                                            ?>
                                        </div>

                                        <div class="tab-slide-content new-arrival-product mb-4 mb-xl-0">
                                            <!-- Nav tabs -->
                                            <ul class="nav slide-item-list mt-3" role="tablist">
                                                <?php
                                                $getGambar2 = mysqli_query($conn, "SELECT * FROM gambar_kost WHERE nama_kost = '$namaKost'");
                                                $firstTab = true; // Untuk mengatur tautan pertama sebagai aktif

                                                while ($dataGambar2 = mysqli_fetch_array($getGambar2)) {
                                                    $tabId = 'tab-' . $dataGambar2['id'];
                                                    $photoKost = $dataGambar2['photo_kost'];
                                                    $activeClass = $firstTab ? 'active' : ''; // Tambahkan kelas 'active' pada tautan pertama
                                                ?>

                                                    <li role="presentation">
                                                        <a href="#<?php echo $tabId; ?>" role="tab" data-toggle="tab" class="tab-link <?php echo $activeClass; ?>">
                                                            <img class="img-fluid" src="images/imageKost/<?php echo $photoKost ?>" alt="" width="50">
                                                        </a>
                                                    </li>

                                                <?php
                                                    $firstTab = false; // Setel menjadi false setelah tautan pertama
                                                }
                                                ?>
                                            </ul>
                                        </div>

                                    </div>
                                    <!--Tab slider End-->
                                    <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                        <div class="product-detail-content">
                                            <!--Product details-->
                                            <?php
                                            $getDataKost = mysqli_query($conn, "SELECT * FROM kost INNER JOIN fasilitas ON fasilitas.id = kost.fasilitas WHERE kost.nama  = '$namaKost' GROUP BY kost.nama");
                                            while ($dataKost = mysqli_fetch_array($getDataKost)) {

                                            ?>
                                                <div class="new-arrival-content pr">
                                                    <h3> <?php echo ucwords($dataKost['nama']) ?></h4>
                                                        <div class="comment-review star-rating">
                                                            <span class="font-weight-bold">*Fasilitas</span>
                                                            <ul>
                                                                <?php
                                                                $getFasilitas = mysqli_query($conn, "SELECT * FROM kost INNER JOIN fasilitas ON fasilitas.id = kost.fasilitas WHERE kost.nama = '$namaKost' GROUP BY kost.fasilitas");
                                                                while ($dataFasilits = mysqli_fetch_array($getFasilitas)) {
                                                                ?>
                                                                    <li><img src="./images/image-content/<?php echo $dataFasilits['photo'] ?>" alt="" width="20"><span class="ml-2">
                                                                            <?php echo $dataFasilits['jumlah_fasilitas'] ?>
                                                                            <?php echo $dataFasilits['nama_fasilitas'] ?>
                                                                        </span></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                        <span class="font-weight-bold">*Harga</span>
                                                        <div class="d-table mb-2">
                                                            <p class="price float-left d-block">Rp.<?php echo number_format($dataKost['harga'], 0, ',', '.') ?></p>
                                                        </div>
                                                        <span class="font-weight-bold">*Status Kamar</span>
                                                        <div class="d-table mb-2">
                                                            <p class=" float-left "> <?php
                                                                                        if ($dataKost['status'] == 'Y') {
                                                                                            echo '<span class="badge light badge-success">Kosong</span>';
                                                                                        } else {
                                                                                            echo '<a href="#" class="badge light badge-warning"><span>Terisi</span></a>';
                                                                                        }
                                                                                        ?>
                                                            </p>
                                                        </div>
                                                        <span class="font-weight-bold">*Tentang Kamar</span>
                                                        <div class="d-table mb-2">
                                                            <p class=""><?php echo $dataKost['tentang_kost'] ?>.</p>
                                                        </div>



                                                        <!--Quanatity End-->
                                                        <div class="shopping-cart mt-3">
                                                            <a class="btn btn-warning btn-sm" href="dataKost.php">Kembali</a>
                                                        </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- review -->
                    <div class="modal fade" id="reviewModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Review</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="text-center mb-4">
                                            <img class="img-fluid rounded" width="78" src="images/avatar/1.jpg" alt="DexignZone">
                                        </div>
                                        <div class="form-group">
                                            <div class="rating-widget mb-4 text-center">
                                                <!-- Rating Stars Box -->
                                                <div class="rating-stars">
                                                    <ul id="stars">
                                                        <li class="star" title="Poor" data-value="1">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Fair" data-value="2">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Good" data-value="3">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="Excellent" data-value="4">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star" title="WOW!!!" data-value="5">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Comment" rows="5"></textarea>
                                        </div>
                                        <button class="btn btn-success btn-block">RATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <?php include './include/footer.php' ?>
        <!--**********************************
            Footer end
        ***********************************-->





        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mengganti gambar saat tab di bawah diklik
            $('.tab-link').click(function(e) {
                e.preventDefault();
                var targetTab = $(this).attr('href');
                $('.tab-content .tab-pane').removeClass('show active');
                $(targetTab).addClass('show active');
            });
        });
    </script>
</body>

</html>