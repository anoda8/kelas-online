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
                                <a href="{{ route('admin.beranda') }}" class="{{ request()->path() == "admin" ? "mm-active" : ""}}">
                                    <i class="metismenu-icon fas fa-tachometer-alt"></i>
                                    Beranda
                                </a>
                                <a href="{{ route('admin.setting') }}" class="{{ request()->path() == "admin/setting" ? "mm-active" : ""}}">
                                    <i class="metismenu-icon fas fa-cog"></i>
                                    Pengaturan
                                </a>
                            </li>
                            <li class="app-sidebar__heading">DATABASE</li>
                            <li>
                                <a href="#" class="{{ request()->segment(2) == "users" ? "mm-active" : ""}}">
                                    <i class="metismenu-icon pe-7s-diamond"></i>
                                    Pengguna
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.users.admin')}}" class="{{ request()->path() == "admin/users/admin" ? "mm-active" : ""}}">
                                            <i class="metismenu-icon"></i>Administrator
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.users.guru')}}" class="{{ request()->path() == "admin/users/guru" ? "mm-active" : ""}}">
                                            <i class="metismenu-icon"></i>Guru
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.users.siswa')}}" class="{{ request()->path() == "admin/users/siswa" ? "mm-active" : ""}}">
                                            <i class="metismenu-icon"></i>Siswa
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="elements-dropdowns.html">
                                            <i class="metismenu-icon"></i>Wali Murid
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-car"></i>
                                    Biodata
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.biodata.guru')}}" class="{{ request()->path() == "admin/biodata/guru" ? "mm-active" : ""}}">
                                            <i class="metismenu-icon">
                                            </i>Guru
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.biodata.siswa')}}" class="{{ request()->path() == "admin/biodata/siswa" ? "mm-active" : ""}}">
                                            <i class="metismenu-icon">
                                            </i>Guru
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-car"></i>
                                    Pembelajarn
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="components-tabs.html">
                                            <i class="metismenu-icon">
                                            </i>Jurusan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-tabs.html">
                                            <i class="metismenu-icon">
                                            </i>Kelas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-accordions.html">
                                            <i class="metismenu-icon">
                                            </i>Mapel
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="tables-regular.html">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Tables
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Widgets</li>
                            <li>
                                <a href="dashboard-boxes.html">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Dashboard Boxes
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Forms</li>
                            <li>
                                <a href="forms-controls.html">
                                    <i class="metismenu-icon pe-7s-mouse">
                                    </i>Forms Controls
                                </a>
                            </li>
                            <li>
                                <a href="forms-layouts.html">
                                    <i class="metismenu-icon pe-7s-eyedropper">
                                    </i>Forms Layouts
                                </a>
                            </li>
                            <li>
                                <a href="forms-validation.html">
                                    <i class="metismenu-icon pe-7s-pendrive">
                                    </i>Forms Validation
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Charts</li>
                            <li>
                                <a href="charts-chartjs.html">
                                    <i class="metismenu-icon pe-7s-graph2">
                                    </i>ChartJS
                                </a>
                            </li>
                            <li class="app-sidebar__heading">PRO Version</li>
                            <li>
                                <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                                    <i class="metismenu-icon pe-7s-graph2">
                                    </i>
                                    Upgrade to PRO
                                </a>
                            </li>
                            <li class="app-sidebar__heading">PRO Version</li>
                            <li>
                                <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                                    <i class="metismenu-icon pe-7s-graph2">
                                    </i>
                                    Upgrade to PRO
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
