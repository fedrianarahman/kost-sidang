<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand ">
                    <div class="collapse navbar-collapse justify-content-between">
                        <ul class="navbar-nav header-right main-notification ml-auto">
                            <li class="nav-item dropdown header-profile">
                                
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <img src="images/imageProfile/<?php echo $_SESSION['photo']?>" width="20" alt="">
                                    <div class="header-info">
                                        <span><?php echo $_SESSION['nama']?></span>
                                        <small><?php echo $_SESSION['level']?></small>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a href="profile.php" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./logout.php" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
