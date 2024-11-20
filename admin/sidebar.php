<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Proje 0</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/admin/?p=profile" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <!-- Kullanıcı Menusü -->
                <li class="nav-item <?= (strpos($page, 'user') !== false) ? 'menu-open' : ''; ?>""> <!-- menu-open sınıfı dropdown menünün açık olmasını sağlıyor-->
                    <a href="#" class="nav-link <?= (strpos($page, 'user') !== false) ? 'active' : ''; ?>"> <!-- sayfa user kelimesini içeriyorsa ektif olur-->
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Kullanıcı İşlemleri
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?p=user_list" class="nav-link <?= ($page == 'user_list') ? 'active' : ''; ?>">
                                <i class="far fa-address-book nav-icon"></i>
                                <p>Kullanıcı Listesi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=new_user" class="nav-link <?= ($page == 'new_user') ? 'active' : ''; ?>">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p>Kullanıcı Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /Kullanıcı Menusü -->
                <!-- Haber Menusü -->
                <li class="nav-item <?= (strpos($page, 'news') !== false) ? 'menu-open' : ''; ?>"> <!-- menu-open sınıfı dropdown menünün açık olmasını sağlıyor-->
                    <a href="#" class="nav-link <?= (strpos($page, 'news') !== false) ? 'active' : ''; ?>"> <!-- sayfa user kelimesini içeriyorsa ektif olur-->
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Haber İşlemleri
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?p=news_list" class="nav-link <?= ($page == 'news_list') ? 'active' : ''; ?>">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Haber Listesi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=new_news" class="nav-link <?= ($page == 'new_news') ? 'active' : ''; ?>">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Haber Ekle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /Haber Menusü -->
                <li class="nav-item">
                    <a href="index.php?p=simple_link" class="nav-link <?= ($page == 'simple_link') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
