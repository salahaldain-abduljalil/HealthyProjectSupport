@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <br><br><br><br>
    <br>
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                            إنشاء إستبيان
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover" style="direction: rtl;">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">السؤال</th>
                                    <th>الخيار الأول</th>
                                    <th>الخيار الثاني</th>
                                    <th>الخيار الثالث</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">السؤال</th>
                                    <th>الخيار الأول</th>
                                    <th>الخيار الثاني</th>
                                    <th>الخيار الثالث</th>
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($questionnairs as $q)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $q->question }}</td>
                                        @php
                                            $choices = App\Models\Choice::where('question_id', $q->id)->get();
                                        @endphp
                                        @foreach ($choices as $choice)
                                            <td>{{ $choice->choice }}</td>
                                        @endforeach
                                        <td>
                                            <div class="form-button-action">
                                                <a href="#"> <button type="button" data-bs-toggle="tooltip"
                                                        title="" class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="تعديل السؤال" data-toggle="modal"
                                                        data-target="#exampleModalUpdate{{ $q->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button></a>
                                                <a href="{{ route('delete.question', $q->id) }}" id="delete"> <button
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

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">قم بإنشاء السؤال هنا</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="direction: rtl;">
                        <form id="myForm" action="{{ route('store.survey') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="input1" class="form-label">السؤال</label>
                                    <textarea name="question" placeholder="......إكتب السؤال هنا" class="form-control" required>{{ old('question') }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label"> الخيار الأول</label>
                                    <input type="text" name="choice[]" class="form-control" id="input1"
                                        value="{{ old('choice_one') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label"> عدد النقاط</label>
                                    <input type="number" min="1" name="points[]" class="form-control" id="input1"
                                        value="{{ old('points') }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label">الخيار الثاني </label>
                                    <input type="text" name="choice[]" class="form-control" id="input1"
                                        value="{{ old('choice') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label"> عدد النقاط</label>
                                    <input type="number" min="1" name="points[]" class="form-control" id="input1"
                                        value="{{ old('points') }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label">الخيار الثالث</label>
                                    <input type="text" name="choice[]" class="form-control" id="input1"
                                        value="{{ old('choice') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input1" class="form-label"> عدد النقاط</label>
                                    <input type="number" min="1" name="points[]" class="form-control"
                                        id="input1" value="{{ old('points') }}" required>
                                </div>
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

        @foreach ($questionnairs as $q)
            <!-- Modal For Update-->
            <div class="modal fade" id="exampleModalUpdate{{ $q->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">قم بتعديل السؤال هنا</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="direction: rtl;">
                            <form id="myForm" action="{{ route('update.survey') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $q->id }}">
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label for="input1" class="form-label">السؤال</label>
                                        <textarea name="question" placeholder="......إكتب السؤال هنا" class="form-control" required>{{ $q->question }}</textarea>
                                    </div>
                                    @php
                                        $choices = App\Models\Choice::where('question_id', $q->id)->get();

                                    @endphp
                                    @foreach ($choices as $choice)
                                        <div class="form-group col-md-6">
                                            <label for="input1" class="form-label">الخيارات</label>
                                            <input type="text" name="choice[]" class="form-control" id="input1"
                                                value="{{ $choice->choice }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="input1" class="form-label"> عدد النقاط</label>
                                            <input type="number" name="points[]" min="1" class="form-control"
                                                id="input1" value="{{ $choice->points }}" required>
                                        </div>
                                        <input type="hidden" name="question_id[]" value="{{ $choice->question_id }}">
                                    @endforeach
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z" />
                                </svg>إلغاء</button>
                            <button type="submit" class="btn btn-primary">حفظ التغيرات</button>
                        </div>
                        </form>

                    </div>

                </div>
            </div>
        @endforeach
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    question: {
                        required: true,
                    },
                    choice_one: {
                        required: true,
                    },
                    choice_two: {
                        required: true,
                    },
                    choice_three: {
                        required: true,
                    },
                    onechoice_point: {
                        required: true,
                    },
                    twochoice_point: {
                        required: true,
                    },
                    threechoice_point: {
                        required: true,
                    },
                },
                messages: {
                    question: {
                        required: 'هذا الحقل مطلوب للإدخال',
                    },
                    choice_one: {
                        required: 'هذا الحقل مطلوب للإدخال',
                    },
                    choice_two: {
                        required: 'هذا الحقل مطلوب للإدخال',
                    },
                    choice_three: {
                        required: 'هذا الحقل مطلوب للإدخال',
                    },
                    onechoice_point: {
                        required: 'هذا الحقل مطلوب للإدخال',
                    },
                    twochoice_point: {
                        required: 'هذا الحقل مطلوب للإدخال',
                    },
                    threechoice_point: {
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
