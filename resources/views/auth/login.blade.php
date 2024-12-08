<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>صفحة تسجيل الدخول</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <section class="vh-100" style="background-color:#FFFAF0;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">تسجيل الدخول</h3>
                            <form method="POST" id="myForm" action="{{ route('login') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div data-mdb-input-init class="form-group mb-4">
                                    <input type="email" name="email" id="typeEmailX-2"
                                        placeholder="Enter Your Email" class="form-control form-control-lg" required />
                                    <label class="form-label" for="typeEmailX-2">البريد الإلكتروني</label>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div data-mdb-input-init class="form-group mb-4">
                                    <input type="password" name="password" id="typePasswordX-2"
                                        placeholder="Enter Your password" class="form-control form-control-lg"
                                        required />
                                    <label class="form-label" for="typePasswordX-2">كلمة السر</label>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="form-outline mb-4">
                                    <select id="role" name="role"
                                        class="form-control form-control-lg form-group">
                                        <option selected="" disabled>إختار</option>
                                        <option value="admin">مدير الموقع</option>
                                        <option value="student">طالب</option>
                                        <option value="psychologist">طبيب نفسي</option>
                                        <option value="faculty_member">عضو هيئة تدريس</option>
                                    </select>
                                    <label class="form-label" for="role"> إختار الدور</label>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                                </div>
                                <!-- Checkbox -->
                                @if (Route::has('password.request'))
                                    <div class="form-check d-flex justify-content-start mb-4">
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                            href="#"> هل نسيت كلمة المرور؟
                                        </a>
                                    </div>
                                @endif
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary btn-lg btn-block" type="submit">تسجيل الدخول</button>
                            </form>

                            <hr class="my-4">

                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-block btn-primary"
                                style="background-color: #dd4b39;" type="submit"><i class="fab fa-google me-2"></i>
                                Sign in
                                with google</button>
                            <button data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"
                                type="submit"><i class="fab fa-facebook-f me-2"></i>Sign
                                in with facebook</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    role: {
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
                    role: {
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
</body>

</html>
