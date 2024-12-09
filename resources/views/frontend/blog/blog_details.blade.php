<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.partial.head')

    <style>
        #comments-section {
            margin: 20px 0;
        }

        .comment {
            border: 1px solid #ccc;
            margin: 10px 0;
            padding: 10px;
        }

        .reply {
            margin-left: 20px;
        }

        button {
            margin-left: 10px;
        }
    </style>

</head>

<body>
    <!-- Topbar Start -->
    @include('frontend.partial.topbar')

    <!-- Topbar End -->
    <!-- Navbar Start -->
    @include('frontend.partial.navbar')
    <!-- Navbar End -->

    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5" style="direction: rtl;">
                    <img class="img-fluid w-100 rounded mb-5" src="img/blog-2.jpg" alt="">
                    <h1 class="mb-4">{{ $blog->post_title }}
                    </h1>
                    @php
                        $user = \App\Models\User::where('id', $blog->user_id)->first();
                    @endphp
                    <p>{!! $blog->long_descp !!}</p>
                    <div class="d-flex justify-content-between bg-light rounded p-4 mt-4 mb-4">
                        <div class="d-flex align-items-center">
                            @if ($blog->status == '1')
                                <img class="rounded-circle me-2"
                                    src="{{ !empty($user->photo) ? url('upload/images/' . $user->photo) : url('upload/no_image.jpg') }}"
                                    width="25" height="25" alt="">
                                <small>{{ $user->name }}</small>
                            @else
                                <small>لايمكنك رؤية إسم صاحب المقال <span class="text-danger">مخفية </span> </small>
                            @endif
                        </div>
                        @php
                            $comments = \App\Models\Comment::where('post_id', $blog->id)->get();
                        @endphp
                        <div class="d-flex align-items-center">
                            <span class="ms-3"><i class="far fa-eye text-primary me-1"></i>12345</span>
                            <span class="ms-3" id="comments-count"><i class="far fa-comment text-primary me-1"></i>
                                {{ count($comments) }}</span>
                        </div>
                    </div>
                </div>
                <!-- Blog Detail End -->


                <!-- Comment List Start -->
                <div class="mb-5" style="direction: rtl;">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">
                        {{ count($comments) }} تعليقات</h4>
                    @foreach ($comments as $key => $item)
                        <div class="d-flex mb-4">
                            <img src="{{ !empty($item->user->photo) ? url('images/' . $item->user->photo) : url('upload/no_image.jpg') }}"
                                class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="">{{ $item->user->name }}</a>
                                    <small><i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</i></small>
                                </h6>
                                <p>{{ $item->long_descp }}</p>
                                <button class="btn btn-sm btn-light" onclick="toggleElement();">رد</button>
                            </div>
                        </div>
                    @endforeach

                    <div class="general-comments">
                        <div class="d-flex mb-4">
                        </div>
                    </div>
                    <div id="for-reply-input" style="display: none">
                        <div class="mb-4">
                            <p>
                                <textarea class="form-control bg-white border-0" rows="5" placeholder="إكتب ردك هنا ..."></textarea>
                            </p>
                            <button class="btn btn-sm btn-light">رد</button>
                            <button class="btn btn-sm btn-danger" onclick="hideElement();">إلغاء</button>
                        </div>

                    </div>

                    <div class="main_comment--container"></div>
                </div>
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                @guest
                    <p><b>لإنشاء تعليق يرجى تسجبل الدخول أولا<a href="{{ route('login') }}"> تسجيل الدخول هنا</a> </b> </p>
                @else
                    <div class="bg-light rounded p-5" style="direction: rtl;">
                        <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-white mb-4">
                            إنشاء تعليق</h4>
                        {{-- here start form --}}
                        <form class="comment-form" action="#" enctype="multipart/form-data">
                            <input type="hidden" name="post_id" id="post_id" value="{{ $blog->id }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            {{-- <input type="hidden" name="photo" id="photo" value="{{ Auth::user()->photo }}"> --}}
                            {{-- <img src="{{ !empty(Auth::user()->photo) ? url('upload/instructor_images/' . Auth::user()->photo) : url('upload/no_image.jpg') }}"
                                alt="" id="photo"> --}}
                            <div class="row g-3">
                                <div class="col-12">
                                    <textarea class="form-control bg-white border-0 comment-input" name="long_descp" rows="5"
                                        placeholder="إكتب هنا ..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" id="comment-btn" type="submit">إرسال
                                        تعليقك</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endguest
                <!-- Comment Form End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-3"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">Categories</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i
                                class="fa fa-angle-right me-2"></i>Web
                            Design</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i
                                class="fa fa-angle-right me-2"></i>Web
                            Development</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i
                                class="fa fa-angle-right me-2"></i>Web
                            Development</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i
                                class="fa fa-angle-right me-2"></i>Keyword Research</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i
                                class="fa fa-angle-right me-2"></i>Email Marketing</a>
                    </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                @foreach ($posts as $post)
                    <div class="mb-5" style="direction: rtl;">
                        <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">أخر المقالات
                        </h4>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ asset($post->post_image) }}"
                                style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href=""
                                class="h5 d-flex align-items-center bg-light px-3 mb-0">{{ $post->post_title }}
                            </a>
                        </div>
                    </div>
                @endforeach
                <!-- Recent Post End -->

                <!-- Image Start -->
                <div class="mb-5">
                    <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
                </div>
                <!-- Image End -->

                <!-- Tags Start -->
                <div class="mb-5" style="direction: rtl;">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">Tag Cloud</h4>
                    <div class="d-flex flex-wrap m-n1">
                        @foreach ($tags_all as $tag)
                            <a href="#" class="btn btn-primary m-1">{{ ucwords($tag) }}</a>
                        @endforeach
                    </div>
                </div>
                <!-- Tags End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    @include('frontend.partial.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    @include('frontend.partial.scripts')

</body>

</html>
