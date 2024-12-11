@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <br><br><br>
    <div class="row container-fluid" style="direction: rtl;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Add Blog Post</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">إضافة مقالة جديدة</h5>
                    <form id="myForm" action="{{ route('store.article') }}" method="post" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">العنوان</label>
                            <input type="text" name="post_title" placeholder="عنوان مختصر ومؤجز" class="form-control"
                                id="input1">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">إختار حالة المقال</label>
                            <select name="status" class="form-select mb-3" aria-label="Default select example">
                                <option selected="">إذا كانت مخفية لن يتمكن أحد من رؤية إسمك</option>
                                <option value="0">مخفية</option>
                                <option value="1">مرئية</option>

                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="article" class="form-label">المقالة</label>
                            <textarea id="article" name="long_descp" placeholder="إكتب مقالنك هنا" class="form-control"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Post Tags</label>
                            <input type="text" name="post_tags" class="form-control" data-role="tagsinput"
                                value="أضف المزيد هنا">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input2" class="form-label">لإضافة صورة</label>
                            <input class="form-control" name="post_image" type="file" id="image">
                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin"
                                class="rounded-circle p-1 bg-primary" width="80">

                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">حفظ </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
