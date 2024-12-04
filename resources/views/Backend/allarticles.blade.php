@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <br><br>
    <br><br>
    <div class="row container-fluid">
        <div class="text-center">
            <h1 class="text-dark" style="font-size: 40px;">إدارة مقالاتي</h1>
        </div>
        <div class="ms-auto" style="direction: rtl;">
            <div class="btn-group">
                <a href="{{ route('create.article') }}" class="btn btn-primary px-5"> إنشاء مقالة
                </a>
            </div>
            <br><br>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover" style="direction: rtl;">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center"> العنوان</th>
                                    <th>الصورة</th>
                                    <th class="text-center"> الحالة</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center"> العنوان</th>
                                    <th class="text-center">الصورة</th>
                                    <th class="text-center"> الحالة</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                {{-- @foreach ($users as $user)
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
                                @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
@endsection
