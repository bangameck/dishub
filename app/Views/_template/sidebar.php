<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/home" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/anggota" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Daftar Anggota</span>
                </a>
            </li>
            <li class="nav-item nav-category">Data Kompleks</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">User</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/user" class="nav-link">User Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/bb_u" class="nav-link">User Bidang dan Bagian</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?= base_url(); ?>/usr_dapri" class="nav-link">User Data Pribadi</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/usr_dapen" class="nav-link">User Data Pendidikan</a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item">
                <a href="<?= base_url(); ?>/user" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Data Master</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/bidang" class="nav-link">Bidang</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/bagian" class="nav-link">Bagian</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">Sidebar:</h6>
        <div class="form-group border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item active" href="demo_1/dashboard-one.html">
                <img src="assets/images/screenshots/light.jpg" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item" href="demo_2/dashboard-one.html">
                <img src="assets/images/screenshots/dark.jpg" alt="light theme">
            </a>
        </div>
    </div>
</nav>