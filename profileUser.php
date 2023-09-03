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
      padding-right: 120px;
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
    
  </div>
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
      <form action="./controller/user/updateProfile.php" method="POST" enctype="multipart/form-data">
        <?php
        $getDataUser = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUSer'");
        while ($dataUser = mysqli_fetch_array($getDataUser)) {

        ?>
          <div class="row">
            <div class="col-md-3 mb-4 ">
              <div class="card border-0 shadow-sm">
                <div class="card-body">
                  <div class="picture-container">
                    <div class="picture">
                      <img src="./assets/img/imageProfile/<?php echo $dataUser['photo'] ?>" class="picture-src " id="blah" title="">
                      <input type="file" id="wizard-picture" class="" onchange="readURL(this);" name="photo">
                    </div>
                    <h6 class="mt-2 pict-text">Pilih Photo</h6>
                  </div>
                  <!-- mini navigasi -->
                  <ul>
                    <li><a class="profile-link active" href="./profileUser.php">Profile</a></li>
                    <li class="profile-link "><a href="./myHistory.php">Riwayat</a></li>
                    <li class="profile-link "><a href="./myKost.php">Kamar Saya</a></li>
                  </ul>
                  <!-- end mini navigasi -->
                </div>
              </div>
            </div>

            <div class="col-md-9">
             <div class="row">
              <div class="col-md-12">
                
              </div>
             </div>
              <div class="card border-0 shadow-sm">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-4">
                      <div class="mb-2">
                        <label for="" class="mb-2">Nama</label>
                        <input type="text" name="nama" class="form-control" id="" value="<?php echo $dataUser['nama'] ?>">
                        <input hidden type="text" name="old_photo" class="form-control" id="" value="<?php echo $dataUser['photo'] ?>">
                        <input hidden type="text" name="old_ktp" class="form-control" id="" value="<?php echo $dataUser['photo_ktp'] ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-2">
                        <label for="" class="mb-2">Email</label>
                        <input type="text" name="email" class="form-control" id="" value="<?php echo $dataUser['email'] ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="md-2">
                        <label for="" class="mb-2">NO HP</label>
                        <input type="text" name="no_hp" class="form-control" id="" value="<?php echo $dataUser['no_telpon'] ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-2">
                        <label for="" class="mb-2">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="" value="<?php echo $dataUser['alamat'] ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-2">
                        <label for="" class="mb-2">Username</label>
                        <input type="text" name="username" class="form-control" id="" value="<?php echo $dataUser['username'] ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-2">
                        <label for="" class="mb-2">Password</label>
                        <input type="password" name="password" class="form-control" id="" value="<?php echo $dataUser['password'] ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-2">
                        <label for="" class="mb-2">Joined At</label>
                        <input type="text" name="" class="form-control" id="" value="<?php echo $dataUser['created_at'] ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-2">
                        <label for="" class="mb-2">Upload Photo KTP</label>
                        <input type="file" name="photo_ktp" class="form-control" id="">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-2">
                        <?php
                        if ($dataUser['photo_ktp']) {
                          echo '<img src="assets/img/imageKtp/' . $dataUser['photo_ktp'] . '" class="img-thumbnail" alt="" height="50">';
                        } else {
                          echo '<h3 class="text-center mt-4">Belum Ada KTP !</h3>';
                        }
                        ?>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-12  mt-4">
                      <button class="btn btn-cs-order" type="submit">Update</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </form>
    </section>
  </div>
  <!-- footer -->
  <?php include './include/footer.php' ?>
  <!-- end footer -->

  <!-- script bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- script fontawesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>