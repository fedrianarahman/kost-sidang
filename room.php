<?php
session_start();
include './controller/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link bootstrap css -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />

    <!-- font awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <!-- link css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <style>
      .custom-map {
        height: 500px;
    width: 500px;
    position: fixed;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    background-color: #f2f2f2;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    z-index: 1;
    padding-top: 40px;
  }
      #map {
        width: 100%;
        height: 500px;
      }
    </style>
  </head>
  <body>
    <!-- navigasi -->
    <?php include './include/navbar.php'?>
    <!-- end navigasi -->
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class="container">
          

            <!-- room with beautiful yeard -->
            <section class="room-with-beauty-backyeard">
              <h2>Kamar Kost </h2>
              <!-- <div class="row">
                <?php
                $getDataKost = mysqli_query($conn, "SELECT * FROM kost INNER JOIN fasilitas ON fasilitas.id = kost.fasilitas INNER JOIN gambar_kost ON gambar_kost.nama_kost  = kost.nama GROUP BY kost.nama");
                while ($dataKost = mysqli_fetch_array($getDataKost)) {
                 
                ?>
               <?php
               if ($dataKost['status']=='Y') {
               ?> 
                <div class="col-md-3">
                  <a href="./detailRoom.php?nama_kost=<?php echo $dataKost['nama']?>&harga_kost=<?php echo $dataKost['harga']?>" class="text-room">
                    <div class="room-with-beauty-backyeard-image">
                      <img src="./admin/images/imageKost/<?php echo $dataKost['photo_kost']?>" alt="" srcset="">
                      <span class="diskon">New Arrival</span>
                      <p class="room-with-beauty-backyeard-title"><?php echo $dataKost['nama']?></p>
                      <p class="room-with-beauty-backyeard-location badge badge-success">
                        <span class=" <?php if ($dataKost['status']=='Y') {
                          echo 'badge light badge-custom-success';
                        } else {
                          echo 'badge light badge-custom-warning';
                        }
                         ?>"><?php if ($dataKost['status']=='Y') {
                          echo 'kosong';
                        } else {
                          echo 'Penuh';
                        }
                         ?></span></p>
                    </div>
                  </a>
                </div>
               <?php } else {
               ?>
                <div class="col-md-3">
                 <span>
                 <div class="room-with-beauty-backyeard-image">
                      <img src="./admin/images/imageKost/<?php echo $dataKost['photo_kost']?>" alt="" srcset="">
                      <span class="diskon">New Arrival</span>
                      <p class="room-with-beauty-backyeard-title"><?php echo $dataKost['nama']?></p>
                      <p class="room-with-beauty-backyeard-location badge badge-success">
                        <span class=" <?php if ($dataKost['status']=='Y') {
                          echo 'badge light badge-custom-success';
                        } else {
                          echo 'badge light badge-custom-warning';
                        }
                         ?>"><?php if ($dataKost['status']=='Y') {
                          echo 'kosong';
                        } else {
                          echo 'Penuh';
                        }
                         ?></span></p>
                    </div>
                 </span>
                </div>
               <?php }?>
               <?php }?>
              </div> -->
              <div class="row">
                <div class="col-md-6 ">
                  <div class="row">
                  <?php
                $getDataKost = mysqli_query($conn, "SELECT * FROM kost INNER JOIN fasilitas ON fasilitas.id = kost.fasilitas INNER JOIN gambar_kost ON gambar_kost.nama_kost  = kost.nama GROUP BY kost.nama");
                while ($dataKost = mysqli_fetch_array($getDataKost)) {
                 
                ?>
               <?php
               if ($dataKost['status']=='Y') {
               ?> 
                <div class="col-md-5">
                  <a href="./detailRoom.php?nama_kost=<?php echo $dataKost['nama']?>&harga_kost=<?php echo $dataKost['harga']?>" class="text-room">
                    <div class="room-with-beauty-backyeard-image">
                      <img src="./admin/images/imageKost/<?php echo $dataKost['photo_kost']?>" alt="" srcset="">
                      <!-- <span class="diskon">New Arrival</span> -->
                      <p class="room-with-beauty-backyeard-title"><?php echo $dataKost['nama']?></p>
                      <p class="room-with-beauty-backyeard-location badge badge-success">
                        <span class=" <?php if ($dataKost['status']=='Y') {
                          echo 'badge light badge-custom-success';
                        } else {
                          echo 'badge light badge-custom-warning';
                        }
                         ?>"><?php if ($dataKost['status']=='Y') {
                          echo 'kosong';
                        } else {
                          echo 'Penuh';
                        }
                         ?></span></p>
                    </div>
                  </a>
                </div>
               <?php } else {
               ?>
                <div class="col-md-6">
                 <span>
                 <div class="room-with-beauty-backyeard-image">
                      <img src="./admin/images/imageKost/<?php echo $dataKost['photo_kost']?>" alt="" srcset="">
                      <!-- <span class="diskon">New Arrival</span> -->
                      <p class="room-with-beauty-backyeard-title"><?php echo $dataKost['nama']?></p>
                      <p class="room-with-beauty-backyeard-location badge badge-success">
                        <span class=" <?php if ($dataKost['status']=='Y') {
                          echo 'badge light badge-custom-success';
                        } else {
                          echo 'badge light badge-custom-warning';
                        }
                         ?>"><?php if ($dataKost['status']=='Y') {
                          echo 'kosong';
                        } else {
                          echo 'Penuh';
                        }
                         ?></span></p>
                    </div>
                 </span>
                </div>
               <?php }?>
               <?php }?>
                  </div>
                </div>
                <div class="col-md-6 ">
                  <div class="custom-map">
                      <div id="map"></div>
                  </div>
                </div>
              </div>
            </section>
            <!-- end room with beautiful yeard -->
          </div>
          <!-- footer -->
          
          <!-- end footer -->

    <!-- script bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
    <!-- script fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     <script>
        // Inisialisasi peta Leaflet
        var map = L.map('map').setView([0, 0], 13);

        // Tambahkan peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

         // Tambahkan control zoom in dan zoom out di sebelah kanan peta
    // L.control.zoom({ position: 'topright' }).addTo(map);
    
        // Ambil data dari database dengan PHP dan MySQL
        <?php
           
            // Query untuk mengambil data dari tabel dengan kolom latitude dan longitude
            $query = "SELECT * FROM kost INNER JOIN fasilitas ON fasilitas.id = kost.fasilitas INNER JOIN gambar_kost ON gambar_kost.nama_kost  = kost.nama GROUP BY kost.nama";
            // $conn2 = mysqli_connect("localhost","root","","map");
            $result = mysqli_query($conn, $query);

            // Loop untuk membentuk array data dari hasil query
            $locations = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $locations[] = array(
                    'nama' => $row['nama'],
                    'latitude' => $row['latitude'],
                    'longitude' => $row['longitude'],
                    'photo_kost' => $row['photo_kost'],
                    'harga' => $row['harga']
                );
            }

            // Konversi array data menjadi format JSON
            $locations_json = json_encode($locations);
        ?>

        // Tambahkan marker ke peta berdasarkan data yang diambil dari database
        var locations = <?php echo $locations_json; ?>;
        locations.forEach(function(location) {
            var marker = L.marker([location.latitude, location.longitude]).addTo(map);
            marker.bindPopup(`<div><a style='text-decoration:none; color:#152C5B;' href='./detailRoom.php?nama_kost=${location.nama}&harga_kost=${location.harga}'><img src='./assets/img/buida.jpeg' style='margin-bottom:10px;' width='150px'/><br/><b>Kost Bu Ida</b></a></div>`);
        });
         // Fungsi untuk menampilkan marker pada lokasi pengguna
    function showUserLocation(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      // L.marker([latitude, longitude]).addTo(map).bindPopup('Lokasi Anda').openPopup();
      map.setView([latitude, longitude], 13);
    }

    // Fungsi yang akan dipanggil jika ada masalah dalam mendapatkan lokasi pengguna
    function showError(error) {
      console.log('Error:', error.message);
    }

    // Periksa apakah browser mendukung geolocation API
    if ('geolocation' in navigator) {
      // Panggil geolocation API untuk mendapatkan lokasi pengguna
      navigator.geolocation.getCurrentPosition(showUserLocation, showError);
    } else {
      console.log('Geolocation tidak didukung oleh browser ini.');
    }
    var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);
    </script>       
  </body>
</html>
