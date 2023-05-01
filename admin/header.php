<nav class="navbar navbar-expand-lg border-bottom mb-5">
                <div class="container-fluid">

                    <!-- Sidebar toggle -->
                    <button type="button" id="sidebarCollapse" class="btn primary-neutal-800">
                        <i class="bi bi-list"></i>
                        <span>Toggle Menu</span>
                    </button>

                    <nav class="navbar navbar-expand">

                        <!-- Navbar-->
                        <ul class="navbar-nav ml-auto">

                            <!-- Top Navbar items - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="primary-neutal-800 mr-2"><?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } ?></span>
                                    <img class="img-profile rounded-circle" src="../img/undraw_profile.svg"
                                        style="width: 32px; height: 32px;">
                                </a>

                                <!-- Top Navbar items Dropdown -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw primary-neutal-800 mr-2"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav> 