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
                                    <th class="text-center">الصورة</th>
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
                                @foreach ($blogposts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $post->post_title }}</td>
                                        <td class="text-center"> <img src="{{ asset($post->post_image) }}" alt=""
                                                style="width: 70px; height:40px;"></td>
                                        <td class="text-center">
                                            @if ($post->status == '0')
                                                مخفية
                                            @else
                                                مرئية
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('edit.article', $post->id) }}" class="btn btn-info px-5">تعديل
                                            </a>
                                            <a href="{{ route('delete.article', $post->id) }}" class="btn btn-danger px-5"
                                                id="delete">حذف </a>
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
    @endsection
