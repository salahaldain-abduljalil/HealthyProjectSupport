<div class="container-fluid sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
            <a href="index.html" class="navbar-brand">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>الرعاية النفسية
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-item nav-link active">لوحة التحكم</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-item nav-link active">تسجيل الدخول</a>

                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>
