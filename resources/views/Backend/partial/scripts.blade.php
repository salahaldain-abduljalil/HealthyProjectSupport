   <!--   Core JS Files   -->
   <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
   <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
   <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"
       integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <!-- jQuery Scrollbar -->
   <script src="{{ asset('assets') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
   <script src="{{ asset('assets') }}/js/plugin/validate.min.js"></script>

   <!-- Chart JS -->
   <script src="{{ asset('assets') }}/js/plugin/chart.js/chart.min.js"></script>

   <!-- jQuery Sparkline -->
   <script src="{{ asset('assets') }}/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

   <!-- Chart Circle -->
   <script src="{{ asset('assets') }}/js/plugin/chart-circle/circles.min.js"></script>

   <!-- Datatables -->
   <script src="{{ asset('assets') }}/js/plugin/datatables/datatables.min.js"></script>

   <!-- Bootstrap Notify -->
   {{-- <script src="{{ asset('assets') }}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> --}}

   <!-- jQuery Vector Maps -->
   <script src="{{ asset('assets') }}/js/plugin/jsvectormap/jsvectormap.min.js"></script>
   <script src="{{ asset('assets') }}/js/plugin/jsvectormap/world.js"></script>

   <!-- Sweet Alert -->
   <script src="{{ asset('assets') }}/js/plugin/sweetalert/sweetalert.min.js"></script>

   <!-- Kaiadmin JS -->
   <script src="{{ asset('assets') }}/js/kaiadmin.min.js"></script>
   <!-- Kaiadmin DEMO methods, don't include it in your project! -->
   <script src="{{ asset('assets') }}/js/setting-demo.js"></script>
   <script src="{{ asset('assets') }}/js/demo.js"></script>
   {{-- <script src="{{ asset('assets') }}/js/core/jquery.js"></script> --}}
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
       integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
       integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
   </script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script>
       $(function() {
           $(document).on("click", "#delete", function(e) {
               e.preventDefault();
               var link = $(this).attr("href");

               Swal.fire({
                   title: "هل أنت متاكد؟",
                   text: "حذف هذه البيانات؟",
                   icon: "warning",
                   showCancelButton: true,
                   confirmButtonColor: "#3085d6",
                   cancelButtonColor: "#d33",
                   confirmButtonText: "Yes, delete it!",
               }).then((result) => {
                   if (result.isConfirmed) {
                       window.location.href = link;
                       Swal.fire("تم الحذف!", ".تم حذفها بنجاح", "success");
                   }
               });
           });
       });

       /////////// confirm

       $(function() {
           $(document).on("click", "#confirm", function(e) {
               e.preventDefault();
               var link = $(this).attr("href");

               Swal.fire({
                   title: "هل أنت متاكد؟",
                   text: "التأكيد على عملية الحجز؟",
                   icon: "warning",
                   showCancelButton: true,
                   confirmButtonColor: "#3085d6",
                   cancelButtonColor: "#d33",
                   confirmButtonText: "!نعم , تم التاكيد ",
               }).then((result) => {
                   if (result.isConfirmed) {
                       window.location.href = link;
                       Swal.fire("التأكيد!", ".تم تأكيد الحجز بنجاح", "success");
                   }
               });
           });
       });
   </script>

   <script>
       $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
           type: "line",
           height: "70",
           width: "100%",
           lineWidth: "2",
           lineColor: "#177dff",
           fillColor: "rgba(23, 125, 255, 0.14)",
       });

       $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
           type: "line",
           height: "70",
           width: "100%",
           lineWidth: "2",
           lineColor: "#f3545d",
           fillColor: "rgba(243, 84, 93, .14)",
       });

       $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
           type: "line",
           height: "70",
           width: "100%",
           lineWidth: "2",
           lineColor: "#ffa534",
           fillColor: "rgba(255, 165, 52, .14)",
       });
   </script>
   <script>
       $(document).ready(function() {
           let table = new DataTable('#example');
       });
   </script>
   <script>
       @if (Session::has('message'))
           var type = "{{ Session::get('alert-type', 'info') }}"
           switch (type) {
               case 'info':
                   toastr.info(" {{ Session::get('message') }} ");
                   break;

               case 'success':
                   toastr.success(" {{ Session::get('message') }} ");
                   break;

               case 'warning':
                   toastr.warning(" {{ Session::get('message') }} ");
                   break;

               case 'error':
                   toastr.error(" {{ Session::get('message') }} ");
                   break;
           }
       @endif
   </script>

   <!-- Include the Quill library -->
   <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

   <!-- Initialize Quill editor -->
   <script>
       const quill = new Quill('#editor', {
           theme: 'snow'
       });
   </script>
