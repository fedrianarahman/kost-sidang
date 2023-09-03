<div class="deznav">
            <div class="deznav-scroll">
				<div class="main-profile">
					<div class="">
						<img src="./images/logoKost.jpeg" width="150" alt="">
						
					</div>
					<!-- <h5 class="name"><span class="font-w400">Hello,</span> Marquez</h5>
					<p class="email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="95f8f4e7e4e0f0efefefefd5f8f4fcf9bbf6faf8">[email&#160;protected]</a></p> -->
				</div>
				<ul class="metismenu" id="menu">
					<li class="nav-label first">Main Menu</li>
                    <li class="mm-active"><a class=" ai-icon" href="index.php" aria-expanded="false">
							<i class="flaticon-144-layout"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
					<li class="nav-label">Apps</li>
					<li ><a class=" ai-icon" href="dataAkunBank.php" aria-expanded="false">
							<i class="fa fa-university"></i>
							<span class="nav-text">Akun Bank</span>
						</a>
                    </li>
					<li ><a class=" ai-icon" href="dataFasilitas.php" aria-expanded="false">
							<i class="flaticon-381-network"></i>
							<span class="nav-text">Fasilitas Kost</span>
						</a>
                    </li>
					<li ><a class=" ai-icon" href="dataGallery.php" aria-expanded="false">
					<i class="fa fa-camera" aria-hidden="true"></i>
							<span class="nav-text">Gallery Kost</span>
						</a>
                    </li>
					<li ><a class=" ai-icon" href="dataKost.php" aria-expanded="false">
					<i class="fa fa-tasks"></i>
							<span class="nav-text">Kamar Kost</span>
						</a>
                    </li>
					<li ><a class=" ai-icon" href="dataPemesanan.php" aria-expanded="false">
							<i class="fa fa-address-book-o"></i>
							<span class="nav-text">Data Pemesanan</span>
						</a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="fa fa-users"></i>
							<span class="nav-text">Users</span>
						</a>
                        <ul aria-expanded="false">
							<?php
							if ($_SESSION['level'] =='admin') {
							?>
							<li><a href="dataUser.php">Data Users</a></li>
							<li><a href="dataRole.php">Data Role</a></li>
							<?php }?>
                            
							<li><a href="dataPenyewa.php">Data Penyewa</a></li>
							<!-- <li><a href="dataRole.php">Data Penghuni</a></li> -->
                        </ul>
                    </li>
                </ul>
			</div>
        </div>