<div class="app-main">
    <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="scrollbar-sidebar" style="overflow: scroll;">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading">Teras</li>
                    <li>
                        <a href="{{ route('guru.beranda') }}" class="{{ request()->path() == "guru" ? "mm-active" : ""}}">
                            <i class="metismenu-icon fas fa-tachometer-alt"></i>
                            Beranda
                        </a>
                        <a href="{{ route('guru.pengumuman') }}" class="{{ request()->path() == "guru/pengumuman" ? "mm-active" : ""}}">
                            <i class="metismenu-icon fas fa-bullhorn"></i>
                            Pengumuman
                        </a>
                    </li>
                    <li class="app-sidebar__heading">PEMBLAJARAN</li>
                    <li>
                        <a href="{{ route('guru.kelasonline') }}" class="{{ request()->path() == "guru/kelasonline" ? "mm-active" : ""}}">
                            <i class="metismenu-icon fas fa-chalkboard-teacher"></i>
                            Kelas Online
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guru.tugas') }}" class="{{ request()->path() == "guru/tugas" ? "mm-active" : ""}}">
                            <i class="metismenu-icon fas fa-tasks"></i>
                            Tugas
                        </a>
                    </li>
                    <li class="app-sidebar__heading">BANKSOAL</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="app-main__outer">
        <div class="app-main__inner">
