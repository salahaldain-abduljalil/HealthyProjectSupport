@extends('Backend.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="container">
        <section style="direction: rtl;">

            <br>
            <div class="row m-auto">
                <div class="col-lg-12">
                    <div class="card bg-info">
                        <div class="text-center">
                            <h6 style="  font-size: 25px;">يمكنك تعديل بياناتك الشخصية من هنا</h6>
                        </div>

                        <form method="POST" action="#" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">الإسم</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" placeholder="إسمك الأول" class="form-control"
                                            value="{{ $profileData->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">إسم المستحدم</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="username" placeholder="أدخل إسمك الأخر"
                                            class="form-control" value="{{ $profileData->user_name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">البريد الإلكتروني</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $profileData->email }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">رقم الهاتف</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $profileData->phone }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">العنوان</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $profileData->address }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">صورة الملف الشخصي</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="photo" class="form-control" id="image" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage"
                                            src="{{ !empty(Auth::user()->photo) ? url('upload/images/' . Auth::user()->photo) : url('upload/no_image.jpg') }}"
                                            alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="حفظ التغيرات" />
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card bg-info">
                        <div class="text-center">
                            <h6 style="  font-size: 25px;">يمكنك تعديل كلمة المرور الخاصة بك من هنا</h6>
                        </div>

                        <form method="POST" action="#" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">كلمة السر القديمة</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            id="old_password" />
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">كلمة السر الجديدة</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            id="new_password" />
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">تأكيد كلمة السر الجديدة</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            id="new_password_confirmation" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="حفظ" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>


            </div>

            <!-- Page Container -->
            {{-- <div class="w3-content w3-margin-top" style="max-width: 1400px;">

                <!-- The Grid -->
                <div class="w3-row-padding">

                    <!-- Left Column -->
                    <div class="w3-third">

                        <!-- End Left Column -->
                    </div>

                    <!-- Right Column -->
                    <div class="w3-twothird float-sm-end col-lg-7">

                        <div class="w3-container w3-card w3-white w3-margin-bottom">
                            <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work
                                Experience
                            </h2>
                            <div class="w3-container">
                                <h5 class="w3-opacity"><b>Front End Developer / w3schools.com</b></h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 -
                                    <span class="w3-tag w3-teal w3-round">Current</span>
                                </h6>
                                <p>Lorem ipsum dolor sit amet. Praesentium magnam consectetur vel in deserunt aspernatur est
                                    reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus
                                    iure,
                                    iste.</p>
                                <hr>
                            </div>
                            <div class="w3-container">
                                <h5 class="w3-opacity"><b>Web Developer / something.com</b></h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Mar 2012 -
                                    Dec
                                    2014
                                </h6>
                                <p>Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur
                                    est
                                    reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus
                                    iure,
                                    iste.</p>
                                <hr>
                            </div>
                            <div class="w3-container">
                                <h5 class="w3-opacity"><b>Graphic Designer / designsomething.com</b></h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2010 -
                                    Mar
                                    2012
                                </h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><br>
                            </div>
                        </div>

                        <div class="w3-container w3-card w3-white">
                            <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education
                            </h2>
                            <div class="w3-container">
                                <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                                <p>Web Development! All I need to know in one place</p>
                                <hr>
                            </div>
                            <div class="w3-container">
                                <h5 class="w3-opacity"><b>London Business School</b></h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015
                                </h6>
                                <p>Master Degree</p>
                                <hr>
                            </div>
                            <div class="w3-container">
                                <h5 class="w3-opacity"><b>School of Coding</b></h5>
                                <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013
                                </h6>
                                <p>Bachelor Degree</p><br>
                            </div>
                        </div>

                        <!-- End Right Column -->
                    </div>

                    <!-- End Grid -->
                </div>

                <!-- End Page Container -->
            </div>
            <br><br> --}}
            <div class="col-lg-4">
                <div class="w3-white w3-text-grey w3-card-4">
                    <div class="w3-display-container">
                        <img src="{{ !empty(Auth::user()->photo) ? url('upload/images/' . Auth::user()->photo) : url('upload/no_image.jpg') }}"
                            style="width:100%" alt="Avatar">
                        <div class="w3-display-bottomleft w3-container w3-text-black">
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <div class="w3-container">
                        <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Designer</p>
                        <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>London, UK</p>
                        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>ex@mail.com
                        </p>
                        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>1224435534</p>
                        <hr>

                        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b>
                        </p>
                        <p>Adobe Photoshop</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%
                            </div>
                        </div>
                        <p>Photography</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
                                <div class="w3-center w3-text-white">80%</div>
                            </div>
                        </div>
                        <p>Illustrator</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%
                            </div>
                        </div>
                        <p>Media</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%
                            </div>
                        </div>
                        <br>

                        <p class="w3-large w3-text-theme"><b><i
                                    class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>
                        <p>English</p>
                        <div class="w3-light-grey w3-round-xlarge">
                            <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
                        </div>
                        <p>Spanish</p>
                        <div class="w3-light-grey w3-round-xlarge">
                            <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
                        </div>
                        <p>German</p>
                        <div class="w3-light-grey w3-round-xlarge">
                            <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
                        </div>
                        <br>
                    </div>
                </div><br>
            </div>
        </section>
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
