<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
                <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pe-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Search ..." class="form-control" />
                </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                @php
                    $ncount = Auth::user()->unreadNotifications()->count();
                @endphp

                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification" id="notification-count">{{ $ncount }}</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">
                                <span class="text-primary"> من الإشعارات الجديدة {{ $ncount }} لديك
                                </span>
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">

                                    @php
                                        // $user = Auth::user();
                                        $user = Auth::user()->notifications()->limit(15)->get();
                                    @endphp
                                    @forelse ($user as $notification)
                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalStudent"
                                            onclick="markNotificationRead('{{ $notification->id }}')">
                                            <div class="notif-icon notif-primary">
                                                <i class="fa fa-user-plus"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">{{ $notification->data['message'] }} </span>
                                                <span
                                                    class="time text-bg-info">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="javascript:void(0);">See all notifications<i
                                    class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ !empty(Auth::user()->photo) ? url('upload/images/' . Auth::user()->photo) : url('upload/no_image.jpg') }}"
                                alt="..." class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">مرحبا</span>

                            <span class="fw-bold">
                                @if (Auth::user()->role == 'admin')
                                    مدير الموقع
                                @endif
                            </span>

                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ !empty(Auth::user()->photo) ? url('upload/images/' . Auth::user()->photo) : url('upload/no_image.jpg') }}"
                                            alt="image profile" class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p class="text-muted"></p>
                                        <a href="{{ route('profile.get', Auth::user()->id) }}"
                                            class="btn btn-xs btn-secondary btn-sm">عرض الملف</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('profile.get', Auth::user()->id) }}">ملفي
                                    الشخصي</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">تسجيل
                                        الخروج</a>
                                </form>

                            </li>
                        </div>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
    <!-- End Navbar -->
</div>

@php
    $doctors = App\Models\User::where('role', 'psychologist')->get();
@endphp

<div class="modal fade container-fluid" id="exampleModalStudent" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">قم بحجز موعد مع الطبيب هنا</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                </button>
            </div>
            <div class="modal-body" style="direction: rtl;">
                <form id="studentappointmentForm" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">أدخل إسمك</label>
                            <input type="text" name="patient_name" class="form-control" id="input1">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="weekdays" class="form-label">كل الأطباء</label>
                            <select id="weekdays" name="doctor_name" class="form-control" required>
                                <option selected="" disabled>إختار طبيب متاح للموعد
                                </option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->user_name }} {{ $doctor->name }}">
                                        {{ $doctor->user_name }} {{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="weekdays" class="form-label">كل الأوقات المتاحة للطبيب</label>
                            <select id="weekdays" name="doctor_name" class="form-control" required>
                                <option selected="" disabled> إختار الوقت
                                </option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->user_name }} {{ $doctor->name }}">
                                        {{ $doctor->user_name }} {{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weekdays" class="form-label">كل الأيام المتاحة للطبيب</label>
                            <select id="weekdays" name="doctor_name" class="form-control" required>
                                <option selected="" disabled> إختار اليوم
                                </option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->user_name }} {{ $doctor->name }}">
                                        {{ $doctor->user_name }} {{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="weekdays" class="form-label">كل الأطباء</label>
                            <select id="weekdays" name="doctor_name" class="form-control" required>
                                <option selected="" disabled>إختار طبيب متاح للموعد
                                </option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->user_name }} {{ $doctor->name }}">
                                        {{ $doctor->user_name }} {{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">البريد الإلكتروني </label>
                            <input type="email" name="email" class="form-control" id="input1">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control" id="input1">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">العنوان</label>
                            <input type="text" name="address" class="form-control" id="input1">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editor" class="form-label">أدخل وصف حالتك للطبيب</label>
                            <textarea id="editor" class="form-control" name="description" placeholder="......يرجى إدخال الوصف هنا"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                <path
                                    d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                            </svg>إلغاء</button>
                        <button type="submit" class="btn btn-primary">جفظ التغيرات</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<script>
    function markNotificationRead(notificationId) {
        fetch('/mark-notification-as-read/' + notificationId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/josn',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('notification-count').textContent = data.count;
            })
            .catch(error => {
                console.log('Error', error)
            });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#studentappointmentForm').validate({
            rules: {
                patient_name: {
                    required: true,
                },
                doctor_name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                address: {
                    required: true,
                },
                description: {
                    required: true,
                },
            },
            messages: {
                patient_name: {
                    required: 'هذا الحقل مطلوب للإدخال',
                },
                doctor_name: {
                    required: 'هذا الحقل مطلوب للإدخال',
                },
                email: {
                    required: 'هذا الحقل مطلوب للإدخال',
                },
                phone: {
                    required: 'هذا الحقل مطلوب للإدخال',
                },
                address: {
                    required: 'هذا الحقل مطلوب للإدخال',
                },
                description: {
                    required: 'هذا الحقل مطلوب للإدخال',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script>
    function playNotificationSound() {
        const sound = new Audio(`/default/message-sound.mp3`);
        sound.play();
    }
</script>
