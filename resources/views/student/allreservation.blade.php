@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <br><br><br><br>
    <br>
    <div class="text-center font-bold">
        <h1>جميع حجوزاتك</h1>
    </div>
    <br><br>
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover" style="direction: rtl;">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center"> إسم الطبيب</th>
                                    <th class="text-center">تاريخ الحجز</th>
                                    <th class="text-center"> تاريخ إنشاء الحجز</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center"> إسم الطبيب</th>
                                    <th class="text-center">تاريخ الحجز</th>
                                    <th class="text-center"> تاريخ إنشاء الحجز</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allreservations as $reservation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $reservation->doctor_name }}</td>
                                        <td>{{ $reservation->doctor_date }}</td>
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
                                            <div class="form-button-action">
                                                <a href="#"> <button type="button" data-bs-toggle="tooltip"
                                                        title="" class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="تعديل الحجز" data-toggle="modal"
                                                        data-target="#exampleModalUpdate{{ $reservation->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button></a>
                                                <a href="{{ route('delete.reservation', $reservation->id) }}"
                                                    id="delete">
                                                    <button type="button" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-danger" data-original-title="حذف">
                                                        <i class="fa fa-times"></i>
                                                    </button></a>
                                            </div>
                                        </td>
                                    </tr>
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
        <!-- Modal -->
        @foreach ($allreservations as $reservation)
            <div class="modal fade" id="exampleModalUpdate{{ $reservation->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info-gradient">
                            <h5 class="modal-title" id="exampleModalLongTitle">قم بتعديل حجزك هنا</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="direction: rtl;">
                            <form id="studentappointmentForm" action="{{ route('update.reservation') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="id" value="{{ $reservation->id }}">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">تعديل إسمك</label>
                                        <input type="text" name="name" value="{{ $reservation->name }}"
                                            class="form-control" id="input1">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">تعديل الإلكتروني </label>
                                        <input type="email" name="email" value="{{ $reservation->email }}"
                                            class="form-control" id="input1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="number" class="form-label">رقم الهاتف</label>
                                        <input type="tel" name="phone" value="{{ $reservation->phone }}"
                                            class="form-control" id="number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">تعديل العنوان</label>
                                        <input type="text" name="address" value="{{ $reservation->address }}"
                                            class="form-control" id="input1">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="weekdays" class="form-label">كل الأطباء المتاحين</label>
                                        <select id="weekdays" name="doctor_name" class="form-control" required>
                                            <option selected="" disabled>إختار طبيب متاح للموعد
                                            </option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">
                                                    {{ $doctor->user_name }} {{ $doctor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php
                                        $appointments = \App\Models\Appointment::get();
                                    @endphp
                                    <div class="form-group col-md-12">
                                        <label for="weekdays" class="form-label">تعديل الوقت مع الطبيب</label>
                                        <select id="weekdays" name="doctor_date" class="form-control" required>
                                            <option selected="" disabled> إختار الوقت ليتم الحجز
                                            </option>
                                            @foreach ($appointments as $appointment)
                                                <option value="{{ $appointment->date_formatting }}">
                                                </option>
                                            @endforeach
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="editor" class="form-label">تعديل وصف حالتك للطبيب</label>
                                        <textarea id="editor" class="form-control" name="description" placeholder="......يرجى إدخال الوصف هنا">{{ $reservation->description }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
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
        @endforeach
        <script type="text/javascript">
            $(document).ready(function() {
                $('#studentappointmentForm').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        doctor_name: {
                            required: true,
                        },
                        doctor_date: {
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
                        doctor_name: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        doctor_date: {
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
        <script type="text/javascript">
            $(document).ready(function() {
                $('select[name="doctor_name"]').on('change', function() {
                    var doctor_name = $(this).val();
                    if (doctor_name) {
                        $.ajax({
                            url: "{{ url('/getdoctor/data') }}/" + doctor_name,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('select[name="doctor_date"]').html('');
                                var d = $('select[name="doctor_date"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="doctor_date"]').append(
                                        '<option value="' + value.date_formatting +
                                        '">' + value
                                        .date_formatting + '</option>');
                                });
                            },
                        });

                    } else {
                        alert('danger');
                    }
                });
            });
        </script>
    @endsection
