<body>
    <!-- TOP NAVIGATION -->
    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md px-3">

            <!-- Logo Section -->
            <div class="navbar-header" data-logobg="skin6">
                <a class="navbar-brand" href="../dashboard/index.php">
                    <b class="logo-icon">
                        <img src="../assets/images/logo-icon-nav.png" alt="homepage" class="dark-logo" />
                    </b>
                    <span class="logo-text ms-2">
                        <img src="../assets/images/logo-text-navigation.png" alt="homepage" class="dark-logo" />
                    </span>
                </a>
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            </div>

            <!-- Navbar Right Side (Search & Profile) -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto align-items-center">

                    <!-- Search Bar -->
                    <form action="../search.php" method="GET" class="d-flex me-4 mb-0">
                        <input type="text" name="q" class="form-control form-control-sm" placeholder="Search students..." required style="border-radius: 4px 0 0 4px;">
                        <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 0 4px 4px 0;">Search</button>
                    </form>

                    <!-- User Dropdown Menu -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fw-bold">Welcome, <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Admin' ?></span>
                                <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown" style="position: absolute; right: 0;">
                                <!-- Change Password Link -->
                                <li>
                                    <a class="dropdown-item py-2" href="../change_password.php">
                                        <i class="fas fa-key text-muted me-2"></i> Change Password
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider my-2">
                                </li>

                                <!-- Styled Logout Button -->
                                <li>
                                    <a class="dropdown-item logout-btn" href="../Authentication/logout.php">
                                        <i class="fa-solid fa-arrow-right-from-bracket me-3"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <!-- SIDEBAR NAVIGATION -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../dashboard/index.php" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Features</span></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../rooms/index.php" aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span class="hide-menu">Manage Rooms</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../students/index.php" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu">Hostel Students</span></a></li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- TOP NAVIGATION -->
    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md px-3">

            <!-- Logo Section -->
            <div class="navbar-header" data-logobg="skin6">
                <a class="navbar-brand" href="../dashboard/index.php">
                    <b class="logo-icon">
                        <img src="../assets/images/logo-icon-nav.png" alt="homepage" class="dark-logo" />
                    </b>
                    <span class="logo-text ms-2">
                        <img src="../assets/images/logo-text-navigation.png" alt="homepage" class="dark-logo" />
                    </span>
                </a>
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            </div>

            <!-- Navbar Right Side (Search & Profile) -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto align-items-center">

                    <!-- Search Bar -->
                    <form action="../search.php" method="GET" class="d-flex me-4 mb-0">
                        <input type="text" name="q" class="form-control form-control-sm" placeholder="Search students..." required style="border-radius: 4px 0 0 4px;">
                        <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 0 4px 4px 0;">Search</button>
                    </form>

                    <!-- User Dropdown Menu -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fw-bold">Welcome, <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Admin' ?></span>
                                <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown" style="position: absolute; right: 0;">

                                <li>
                                    <a class="dropdown-item py-2" href="../change_password.php">
                                        <i class="fas fa-key text-muted me-2"></i> Change Password
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider my-2">
                                </li>


                                <li>
                                    <a class="dropdown-item logout-btn" href="../Authentication/logout.php">
                                        <i class="fa-solid fa-arrow-right-from-bracket me-3"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <!-- SIDEBAR NAVIGATION -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../dashboard/index.php" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Features</span></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../rooms/index.php" aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span class="hide-menu">Manage Rooms</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../students/index.php" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu">Hostel Students</span></a></li>
                </ul>
            </nav>
        </div>
    </aside>