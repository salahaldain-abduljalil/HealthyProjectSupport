@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <br><br><br><br>
    <br>

    <div class="text-center">
        <h1 class="text-warning">جميع الأطباء المتوفرين</h1>
    </div>
    <br><br>
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                            إنشاء طبيب
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover" style="direction: rtl;">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">الأسم الكامل</th>
                                    <th> رقم الهاتف</th>
                                    <th class="text-center"> العنوان</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">الأسم الكامل</th>
                                    <th> رقم الهاتف</th>
                                    <th class="text-center"> العنوان</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->user_name }} {{ $user->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="#"> <button type="button" data-bs-toggle="tooltip"
                                                        title="" class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="تعديل الطبيب" data-toggle="modal"
                                                        data-target="#exampleModalUpdate{{ $user->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button></a>
                                                <a href="{{ route('delete.doctor', $user->id) }}" id="delete"> <button
                                                        type="button" data-bs-toggle="tooltip" title=""
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





        <div class="modal fade container-fluid" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">قم بإنشاء الطبيب هنا</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="direction: rtl;">
                        <form id="myForm" action="{{ route('create.doctor') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label"> الإسم الأول</label>
                                    <input type="text" name="user_name" class="form-control" id="input1">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label">الإسم الأخير</label>
                                    <input type="text" name="name" class="form-control" id="input1">
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
                                    <label for="input1" class="form-label">كلمة المرور</label>
                                    <input type="password" name="password" class="form-control" id="input1">
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


        @foreach ($users as $user)
            <div class="modal fade" id="exampleModalUpdate{{ $user->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">قم بتعديل الطبيب هنا</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="direction: rtl;">
                            <form id="updateForm" action="{{ route('update.doctor') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label"> الإسم الأول</label>
                                        <input type="text" name="user_name" value="{{ $user->user_name }}"
                                            class="form-control" id="input1">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">الإسم الأخير</label>
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="form-control" id="input1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">البريد الإلكتروني </label>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control" id="input1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">رقم الهاتف</label>
                                        <input type="text" name="phone" value="{{ $user->phone }}"
                                            class="form-control" id="input1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">العنوان</label>
                                        <input type="text" name="address" value="{{ $user->address }}"
                                            class="form-control" id="input1">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="input1" class="form-label">كلمة المرور</label>
                                        <input type="password" name="password" value="{{ $user->password }}"
                                            class="form-control" id="input1">
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
                $('#myForm').validate({
                    rules: {
                        user_name: {
                            required: true,
                        },
                        name: {
                            required: true,
                        },
                        phone: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        email: {
                            required: true,
                        },
                    },
                    messages: {
                        user_name: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        name: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        phone: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        address: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        password: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        email: {
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
                $('#updateForm').validate({
                    rules: {
                        user_name: {
                            required: true,
                        },
                        name: {
                            required: true,
                        },
                        phone: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        email: {
                            required: true,
                        },
                    },
                    messages: {
                        user_name: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        name: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        phone: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        address: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        password: {
                            required: 'هذا الحقل مطلوب للإدخال',
                        },
                        email: {
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
