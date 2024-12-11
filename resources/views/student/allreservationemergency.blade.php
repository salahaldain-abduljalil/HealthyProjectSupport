@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <br><br><br><br>
    <br>
    <div class="text-center font-bold">
        <h1>جميع الحجوزات الطارئة</h1>
    </div>
    <br><br>
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <h4 class="card-title"> <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#exampleModalStudentEmergency">
                            إنشاء حجز طارئ
                        </button>
                    </h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover" style="direction: rtl;">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center"> تاريخ إنشاء الحجز</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">التفاصيل</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center"> تاريخ إنشاء الحجز</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">التفاصيل</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allreservationsEmergency as $reservation)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->updated_at)->format('y - m - d') }}</td>
                                    <td>{{ $reservation->address }}</td>
                                    <td>
                                        @if ($reservation->status == '1')
                                            <span class="badge badge-success">مؤكد</span>
                                        @else
                                            <span class="badge badge-danger">غير مؤكد</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                            data-target="#exampleModalReservation{{ $reservation->id }}">إنقر لرؤية الموافقات</button>
                                    </td>
                                    <td>
                                        <a href="{{ route('delete.reservationemergency', $reservation->id) }}"
                                            class="btn btn-danger px-5" id="delete">حذف </a>
                                    </td>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @php
            $doctors = App\Models\User::where('role', 'psychologist')->get();
        @endphp
        <div class="modal fade container-fluid" id="exampleModalStudentEmergency" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info-gradient">
                        <h5 class="modal-title" id="exampleModalLongTitle">قم بحجز موعد طوارئ الطبيب هنا</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="direction: rtl;">
                        <form id="send" action="{{ route('create.reservationemergency') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label">أدخل إسمك</label>
                                    <input type="text" name="name" class="form-control" id="input1">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label">البريد الإلكتروني </label>
                                    <input type="email" name="email" class="form-control" id="input1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="number" class="form-label">رقم الهاتف</label>
                                    <input type="tel" name="phone" class="form-control" id="number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label">العنوان</label>
                                    <input type="text" name="address" class="form-control" id="input1">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="emergencyE" class="form-label">أدخل وصف حالتك للطبيب</label>
                                    <textarea id="emergencyE" class="form-control" name="description" placeholder="......يرجى إدخال الوصف هنا"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                                    </svg>إلغاء</button>
                                <button type="submit" class="btn btn-primary">إرسال</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#send').validate({
                    rules: {
                        name: {
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
                        name: {
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
    @endsection
