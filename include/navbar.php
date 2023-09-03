<?php
$route = basename($_SERVER['PHP_SELF']);
print_r($route)
?>
<nav
      class="navbar navbar-expand-lg justify-content-between shadow-sm bg-white fixed-top mb-4"
    >
      <div class="container">
        <a class="navbar-brand" href="#"
          ><img src="./assets/img/logo.png"  alt=""
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link <?php if ($route==='index.php') {
										# code...
										echo 'active';
									} else {
										# code...
										echo '';
									}
									?>" href="index.php">Beranda </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if ($route==='about.php') {
										# code...
										echo 'active';
									} else {
										# code...
										echo '';
									}
									?>" href="about.php">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if ($route==='room.php') {
										# code...
										echo 'active';
									} else {
										# code...
										echo '';
									}
									?>" href="room.php">Kamar Kost</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if ($route==='contact.php') {
										# code...
										echo 'active';
									} else {
										# code...
										echo '';
									}
									?>" href="contact.php">Kontak </a>
            </li>
            <li class="nav-item">
            </li>
            <?php
          if (!empty($_SESSION['nama'])) {
            
             ?>
             <li class="nav-item">
              <a class="nav-link <?php if ($route==='profileUser.php') {
										# code...
										echo 'active';
									} elseif ($route==='myKost.php') {
                    echo 'active';
                  } elseif($route==='myHistory.php'){
										echo 'active';
									}else{
                    echo '';
                  }
									?>" href="profileUser.php">My Profile</a>
            </li>
             <?php }else{?>
              
              <?php }?>
            
          </ul>
          <?php
          if (!empty($_SESSION['nama'])) {
            
              echo '<a class="btn-login-top" href="./logout.php">Logout</a>';
          } else {
            echo '<a class="btn-login-top" href="./auth/login.php">Sign In</a>';
          }
          
          ?>
          
        </div>
      </div>
    </nav>