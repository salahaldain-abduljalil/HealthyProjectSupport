 <!DOCTYPE html>
 <html dir="rtl" lang="ar">

 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Survey Form</title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link
         href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
         rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css"
         integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz" crossorigin="anonymous">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
         integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>


     <style>
         .button {
             display: inline-block;
             padding: 10px 20px;
             font-size: 20px;
             cursor: pointer;
             text-align: center;
             text-decoration: none;
             outline: none;
             color: #fff;
             background-color: #04AA6D;
             border: none;
             border-radius: 15px;
             box-shadow: 0 9px #999;
         }

         .button:hover {
             background-color: #3e8e41
         }

         .button:active {
             background-color: #3e8e41;
             box-shadow: 0 5px #666;
             transform: translateY(4px);
         }
     </style>

 </head>

 <body>
     <main>

         <div class="container">
             <header class="text-center">
                 <h1 id="title">نموذج الإستبيان</h1>
                 <p id="description">يرجى مل هذه الإستمارة قبل الدخول إلى الموقع</p>

                 @if (Session::has('Error'))
                     <div class="alert alert-danger text-center">
                         <p>{{ Session::get('Error') }}</p>
                     </div>
                 @endif
             </header>
             <form id="myForm" action="{{ route('store.entry') }}" method="POST" class="border rounded-bottom"
                 enctype="multipart/form-data">
                 @csrf
                 @foreach ($quessionnairs as $item => $question)
                     <div class="form-group m-4">
                         <label class="form-check-label">{{ $question->question }}</label>
                     </div>
                     @php
                         $choices = App\Models\Choice::where('question_id', $question->id)->get();
                     @endphp
                     @foreach ($choices as $choice)
                         <div class="form-check d-flex ml-4">
                             <input type="checkbox" class="form-check-input" value="{{ $choice->points }}"
                                 id="exampleCheck1" name="counts[]">
                             <label class="form-check-label" for="exampleCheck1">{{ $choice->choice }}</label>
                         </div>
                     @endforeach
                 @endforeach
                 <br><br><br><br>
                 <div class="text-center mb-3">
                     <button type="submit" class="btn btn-primary button"
                         onsubmit="playNotificationSound();">إرسال</button>

                 </div>
             </form>
         </div>
     </main>

     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
         integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
         integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
     </script>
     <script src="https://cdn.rtlcss.com/bootstrap/v4.0.0/js/bootstrap.min.js"
         integrity="sha384-54+cucJ4QbVb99v8dcttx/0JRx4FHMmhOWi4W+xrXpKcsKQodCBwAvu3xxkZAwsH" crossorigin="anonymous">
     </script>

     <script type="text/javascript">
         $(document).ready(function() {
             $('#myForm').validate({
                 rules: {
                     'counts': {
                         required: true,
                     },
                 },
                 messages: {
                     'counts': {
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
         function playNotificationSound() {
             const sound = new Audio(`/default/message-sound.mp3`);
             sound.play();
         }
     </script>

 </body>

 </html>
