@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <br><br><br><br>
    <br>
    <div class="text-center font-bold">
        <h1>جميع المواعيد المتوفرة</h1>
    </div>
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                            إنشاء موعد
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover" style="direction: rtl;">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">تاريخ الدوام</th>
                                    <th>وقت الحضور</th>
                                    <th class="text-center"> وقت المغادرة</th>
                                    <th class="text-center">اليوم</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">تاريخ الدوام</th>
                                    <th>وقت الحضور</th>
                                    <th class="text-center"> وقت المغادرة</th>
                                    <th class="text-center">اليوم</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $appointment->dateofwork }}</td>
                                        <td>{{ $appointment->attendancetime }}</td>
                                        <td>{{ $appointment->departuretime }}</td>
                                        <td>{{ $appointment->day }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="#"> <button type="button" data-bs-toggle="tooltip"
                                                        title="" class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="تعديل الموعد" data-toggle="modal"
                                                        data-target="#exampleModalUpdate{{ $appointment->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button></a>
                                                <a href="{{ route('delete.appointment', $appointment->id) }}"
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
        <!-- Modal -->

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">قم بإنشاء الموعد هنا</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="direction: rtl;">
                        <form id="appointmentForm" action="{{ route('create.appointment') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="doctor_id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="input2" class="form-label">تاريخ الدوام</label>
                                    <input class="form-control" name="dateofwork" type="date"
                                        min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                </div>

                                <div class="form-group col-md-6">

                                    <label for="time" class="form-label">إختار وقت بداية الدوام</label>
                                    <input type="time" id="time" name="attendancetime" class="form-control"
                                        value="12:00" step="3600" required>
                                </div>
                                <div class="form-group col-md-6">

                                    <label for="time" class="form-label">إختار وقت المغادرة</label>
                                    <input type="time" id="time" name="departuretime" class="form-control"
                                        value="12:00" step="3600" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="weekdays" class="form-label"> أيام الأسبوع</label>
                                    <select id="weekdays" name="day" class="form-control" required>
                                        <option selected="" disabled>إختار اليوم للموعد</option>
                                        <option value="saturday">السبت</option>
                                        <option value="sunday">الأحد</option>
                                        <option value="monday">الإثنين</option>
                                        <option value="tuesday">الثلاثاء</option>
                                        <option value="wednesday">الأربعاء</option>
                                        <option value="thursday">الخميس</option>
                                        <option value="friday">الجمعة</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                                    </svg>إلغاء</button>
                                <button type="submit" class="btn btn-primary">حفظ التغيرات</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        @foreach ($appointments as $appointment)
            <div class="modal fade" id="exampleModalUpdate{{ $appointment->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">قم بتعديل الموعد هنا</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="direction: rtl;">
                            <form id="appointmentForm" action="{{ route('update.appointment') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="doctor_id" value="{{ Auth::user()->id }}">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="input2" class="form-label">تاريخ الدوام</label>
                                        <input class="form-control" name="dateofwork"
                                            value="{{ $appointment->dateofwork }}" type="date"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for="time" class="form-label">تعديل وقت بداية الدوام</label>
                                        <input type="time" id="time" name="attendancetime"
                                            value="{{ $appointment->attendancetime }}" class="form-control"
                                            value="12:00" step="3600" required>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <label for="time" class="form-label">تعديل وقت المغادرة</label>
                                        <input type="time" id="time" name="departuretime"
                                            value="{{ $appointment->departuretime }}" class="form-control"
                                            value="12:00" step="3600" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="weekdays" class="form-label"> أيام الأسبوع</label>
                                        <select id="weekdays" name="day" class="form-control" required>
                                            <option selected="" value="{{ $appointment->day }}">إختار اليوم للموعد
                                            </option>
                                            <option value="saturday">السبت</option>
                                            <option value="sunday">الأحد</option>
                                            <option value="monday">الإثنين</option>
                                            <option value="tuesday">الثلاثاء</option>
                                            <option value="wednesday">الأربعاء</option>
                                            <option value="thursday">الخميس</option>
                                            <option value="friday">الجمعة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                                        </svg>إلغاء</button>
                                    <button type="submit" class="btn btn-primary">حفظ التغيرات</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        <script type="text/javascript">
            $(document).ready(function() {
                $('#appointmentForm').validate({
                    rules: {
                        dateofwork: {
                            required: true,
                            date: true
                        },
                        day: {
                            required: true,
                        },
                        attendancetime: {
                            required: true,
                            date: true
                        },
                        departuretime: {
                            required: true,
                            date: true
                        },
                    },
                    messages: {
                        dateofwork: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        day: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        attendancetime: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        departuretime: {
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
            document.getElementById('time').addEventListener('change', function() {
                const timeValue = this.value.split(':');
                this.value = `${timeValue[0]}:00`; // تعيين الدقائق إلى 00
            });
        </script>
    @endsection
