
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo">
                <img src="{{ asset('frontend/img/university.jpg') }}" alt="navbar brand" class="navbar-brand"
                    height="65" width="150">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="/dashboard" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>لوحة التحكم</p>
                        <span class="caret"></span>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @can('admin-user')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>الأسئلة</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('create.survey') }}">
                                        <span class="sub-item">كل الأسئلة</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#doctors">
                            <i class="fas fa-layer-group"></i>
                            <p>الأطباء</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="doctors">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('all.doctors') }}">
                                        <span class="sub-item"> كل الأطباء</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('doctor-user')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#appointments">
                            <i class="fas fa-layer-group"></i>
                            <p>المواعيد</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="appointments">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('get.appointments') }}">
                                        <span class="sub-item"> كل المواعيد المتوفرة</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#reservationsappointment">
                            <i class="fas fa-layer-group"></i>
                            <p>جميع المواعيد المحجوزة</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="reservationsappointment">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('get.reservationsappointment') }}">
                                        <span class="sub-item"> كل مواعيدك المحجوزة </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('student-user')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#reservations">
                            <i class="fas fa-layer-group"></i>
                            <p>جميع حجوزات الطالب</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="reservations">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('get.reservations') }}">
                                        <span class="sub-item"> كل حجوزاتك </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#articles">
                        <i class="fas fa-layer-group"></i>
                        <p>إدارة المقالات</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="articles">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('get.allarticles') }}">
                                    <span class="sub-item">مقالاتي</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

<script src="{{ asset('assets') }}/js/core/jquery-3.7.1.min.js"></script>
